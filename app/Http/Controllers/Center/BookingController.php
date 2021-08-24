<?php

namespace App\Http\Controllers\Center;

use App\Booking;
use App\BookingCenter;
use App\BookingService;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessSmsSending;
use App\Jobs\SendSmsJob;
use App\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Models\Media;

class BookingController extends Controller
{
    /**
     * Display list of bookings.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $centers = ServiceCategory::orderBy('name')->get();
    	$user = $request->user();
        $center = $user->center();
        if(request('center')) {
            $assignedCenter = [0=>request('center')];
        } else {
            $assignedCenter = $user->assignedCentersArr();
        }
        $search = $request->search;
    	$query = Booking::with([
            'bookingCenters' => function($q) use ($assignedCenter) {
                $q->whereIn('service_category_id', $assignedCenter);
            }
        ])->ofCenters($assignedCenter);

        if ($request->filled('search')) {
            $search = $request->search;
            $query = $query->where(function($q) use ($search) {
                $q->whereHas('patient', function($q) use ($search) {
                    $q->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%");
                })
                ->orWhereHas('bookingServices', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhere('booking_reference_no', 'LIKE', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query = $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query = $query->whereHas('bookingCenters', function($q) use ($request) {
                $q->whereDate('available_date', $request->date);
            });
        }

        $bookings = $query->latest()->paginate(50);

    	return view('center.bookings.index', compact('bookings','centers'));
    }

    /**
     * Show specified booking.
     * 
     * @param  \App\Booking  $booking
     * @param  \Illuminate\Http\Request  $request
     */
    public function show(Booking $booking, Request $request)
    {

        // \App\Jobs\RedoScreening::dispatch();
        $user = $request->user();
    	// $bookingCenter = $booking->bookingCenters()->ofCenters($user->center())
        //                             ->firstOrFail();

        $assignedCenters = $user->assignedCentersArr();
        $bookingCenters = $booking->bookingCenters()->ofCenters($assignedCenters)->latest()->get();

        $otherCenters = $booking->bookingCenters()->notOfCenters($assignedCenters)
                                ->get();

        $totalAmount = 0;
        $amountPaid = 0;
        $subTotal = 0;
        $discount = 0;
        foreach($bookingCenters as $key => $bookingC) {
            $subTotal = $subTotal + $bookingC->center_total_amount;
            if($booking->patient->pwd_senior) {
                $totalAmount = $totalAmount + $bookingC->center_discounted_total_amount;
                $discount = $discount + $bookingC->center_discount;
            } else {
                $totalAmount = $totalAmount + $bookingC->center_total_amount;
            }
            $amountPaid = $amountPaid + $bookingC->amount_paid;
            // if($bookingC->isWithin5Days()) {
            // }
        }

        if($booking->is_home_visit) {
            $totalAmount = $booking->package->price ?? 0.00;
        }
        
    	return view('center.bookings.details', compact('booking', 'bookingCenters', 'otherCenters', 'totalAmount', 'amountPaid', 'subTotal', 'discount'));
    }

    /**
     * Reschedule specified booking.
     * 
     * @param  \App\Booking  $booking
     * @param  \App\BookingCenter  $bCenter
     * @param  \Illuminate\Http\Request  $request
     */
    public function changeDate(Booking $booking, BookingCenter $bCenter, Request $request)
    {
        $actualDateTime = new Carbon($request->date. ' ' .$request->time);

        $bCenter->available_date = $actualDateTime;
        $bCenter->available_time = $request->time;
        $bCenter->remarks = $request->remarks;
        $bCenter->save();

        return redirect()->back()
                         ->with('Successfully updated date and time.');
    }

    /**
     * Change status of specfied booking to approved.
     * 
     * @param  \App\Booking  $booking
     * @param  \App\BookingService  $bService
     */
    public function approve(Booking $booking, BookingService $bService)
    {
        $user = auth()->user();
        $patient = $booking->patient;
    	$bService->status = BookingService::APPROVED;
    	$bService->save(); 
        $emails = $user->center()->email_to_receive_notifications;
        $emailsArr = explode(",", $emails);

    	$this->statusChanges($booking, BookingService::APPROVED, $bService);

        Mail::to($patient->email)->queue(new \App\Mail\BookingApproved3($booking));

        foreach ($emailsArr as $email) {
            Mail::to($email)->queue(new \App\Mail\BookingApproved4($booking));
        }
        
        SendSmsJob::dispatch('centeradmin_approved_appointment_request', $patient->mobile, [
            'first_name' => $patient->first_name,
            'last_name' => $patient->last_name,
            'reference_no' => $booking->booking_reference_no,
        ]);
        

    	return redirect()->back()
    					 ->with('Successfully updated status.');
    }

    /**
     * Change status of specified booking to confirmed.
     * 
     * @param  \App\Booking  $booking
     * @param  \App\BookingService  $bService
     */
    public function confirm(Booking $booking, BookingService $bService)
    {
        $bService->status = BookingService::CONFIRMED;
        $bService->save();

        $this->statusChanges($booking, BookingService::CONFIRMED, $bService);

        return redirect()->back()
                         ->with('Successfully updated status.');
    }

    /**
     * Change status of specified booking to completed.
     * 
     * @param  \App\Booking  $booking
     * @param  \App\BookingService  $bService
     */
    public function complete(Booking $booking, BookingService $bService)
    {
        $bService->status = BookingService::COMPLETED;
        $bService->save();

        $this->statusChanges($booking, BookingService::COMPLETED, $bService);

        return redirect()->back()
                         ->with('Successfully updated status.');
    }

    /**
     * Cancel specified booking.
     * 
     * @param  \App\Booking  $booking
     * @param  \App\BookingService  $bService
     * @param  \Illuminate\Http\Request  $request
     */
    public function cancel(Booking $booking, BookingService $bService, Request $request)
    {
        $request->validate([
            'reason' => 'required'
        ]);

    	$bService->status = BookingService::CANCELLED;
        $bService->remarks = $request->reason;
    	$bService->save();

    	$this->statusChanges($booking, BookingService::CANCELLED, $bService);

    	return redirect()->back()
    					 ->with('Successfully updated status.');
    }

    /**
     * Change status of specified booking.
     * 
     * @param  \App\Booking  $booking
     */
    public function statusChanges(Booking $booking, $status, $bookingService = null)
    {
        $this->changeCenterStatus($booking, $bookingService);

    	$booking = $booking->fresh('bookingServices');
    	$mayPendingPa = $booking->bookingServices->first(function($bService) {
    		return $bService->isPending();
    	});

        if ($mayPendingPa) return;

        $prevStatus = $booking->status;
        // $prevStatus should be before @changeBookingStatus
        $this->changeBookingStatus($booking);

        if ($prevStatus != $booking->status) {
            if ($booking->isApproved()) {
                if ($booking->mode_of_payment != Booking::CREDITCARD) {
                    Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApproved2($booking));
                    if ($booking->patient->mobile) {
                        // ProcessSmsSending::dispatch('patient_service_approved2', $booking->patient->mobile , [
                        //     'first_name' => $booking->patient->first_name,
                        //     'last_name' => $booking->patient->last_name,
                        //     'misc_shortcodes' => json_encode([
                        //         'reference_no' => $booking->booking_reference_no,
                        //     ])
                        // ]);
                    }
                } else {
                    $booking->expiration = now()->addDays(1);
                    $booking->save();

                    // if($booking->allCentersAreAfter5Days()) {
                    //     Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApprovedNoService($booking));
                    // } else {
                    //     Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApproved($booking));
                    // }

                    Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApproved($booking));

                    if ($booking->patient->mobile) {
                        // ProcessSmsSending::dispatch('patient_service_approved', $booking->patient->mobile , [
                        //     'first_name' => $booking->patient->first_name,
                        //     'last_name' => $booking->patient->last_name,
                        //     'misc_shortcodes' => json_encode([
                        //         'reference_no' => $booking->booking_reference_no,
                        //     ])
                        // ]);
                    }
                }
            }
            elseif($booking->isCancelled()) {
                Mail::to($booking->patient->email)->queue(
                    new \App\Mail\BookingCancelled($booking)
                );
            }
            // else if ($booking->isConfirmed()) {
                // Mail::to($booking->patient->email)->queue(
                //     new \App\Mail\BookingConfirmed($booking)
                // );

                // Sms send for confirm
                // if ($booking->patient->mobile) {
                //     ProcessSmsSending::dispatch('patient_service_confirmed', $booking->patient->mobile , [
                //         'first_name' => $booking->patient->first_name,
                //         'last_name' => $booking->patient->last_name,
                //         'misc_shortcodes' => json_encode([
                //             'reference_no' => $booking->booking_reference_no,
                //         ])
                //     ]);
                // }
            // }
        }

    }

    /**
     * Resend payment email of the specified booking.
     * 
     * @param  \App\Booking  $booking
     */
    public function resendPaymentEmail(Booking $booking)
    {
        if($booking) {
            if ($booking->mode_of_payment != Booking::CREDITCARD) {
                Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApproved2($booking));
                if ($booking->patient->mobile) {
                    // ProcessSmsSending::dispatch('patient_service_approved2', $booking->patient->mobile , [
                    //     'first_name' => $booking->patient->first_name,
                    //     'last_name' => $booking->patient->last_name,
                    //     'misc_shortcodes' => json_encode([
                    //         'reference_no' => $booking->booking_reference_no,
                    //     ])
                    // ]);
                }
            } else {
                $booking->expiration = now()->addDays(1);
                $booking->save();

                Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApproved($booking));

                // if($booking->allCentersAreAfter5Days()) {
                //     Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApprovedNoService($booking));
                // } else {
                //     Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApproved($booking));
                // }

                if ($booking->patient->mobile) {
                    ProcessSmsSending::dispatch('patient_service_approved', $booking->patient->mobile , [
                        'first_name' => $booking->patient->first_name,
                        'last_name' => $booking->patient->last_name,
                        'misc_shortcodes' => json_encode([
                            'reference_no' => $booking->booking_reference_no,
                        ])
                    ]);
                }
            }
        } else {
            return redirect()->back()
                         ->with('error', 'Failed to send email.');
        }
        return redirect()->back()
                         ->with('success','Email Sent!');
    }

    /**
     * Change status of the specified booking in specified cented.
     * 
     * @param  \App\Booking  $booking
     */
    public function changeCenterStatus(Booking $booking, $bookingService = null)
    {
        $user = auth()->user();
        if($bookingService != null) {
            $bookingCenter = $bookingService->bookingCenter;
        } else {
            $bookingCenter = $booking->bookingCenters()
                                     ->with(['bookingServices'])
                                     ->ofCenter($user->center())
                                     ->firstOrFail();
        }

        $mayPendingPa = $bookingCenter->bookingServices->first(function($bService) {
            return $bService->isPending();
        });

        if ($mayPendingPa) return;

        $prevStatus = $bookingCenter->status;

        $mayApproved = $bookingCenter->bookingServices->first(function($bService) {
            return $bService->isApproved();
        });

        // if at least 1 is approved, then approved narin ung booking
        if ($mayApproved) {
            $bookingCenter->status = BookingCenter::APPROVED;
            return $bookingCenter->save();
        }

        $mayConfirmed = $bookingCenter->bookingServices->first(function($bService) {
            return $bService->isConfirmed();
        });

        if ($mayConfirmed) {
            $bookingCenter->status = BookingCenter::CONFIRMED;
            $bookingCenter->save();

            if ($bookingCenter->status == BookingCenter::CONFIRMED) {
                $totalAmount = 0;
                $amountPaid = 0;
                $discount = 0;
                foreach($booking->bookingCenters as $key => $bookingC) {
                    if($booking->patient->pwd_senior) {
                        $totalAmount = $totalAmount + $bookingC->center_discounted_total_amount;
                        $discount = $discount + $bookingC->center_discount;
                    } else {
                        $totalAmount = $totalAmount + $bookingC->center_total_amount;
                    }
                    $amountPaid = $amountPaid + $bookingC->amount_paid;
                    // if($bookingC->isWithin5Days()) {
                    // }
                }
                Mail::to($booking->patient->email)->queue(
                    new \App\Mail\BookingConfirmed($booking, $totalAmount, $amountPaid, $discount)
                );
                // Sms send for confirm
                if ($booking->patient->mobile) {
                    ProcessSmsSending::dispatch('patient_service_confirmed', $booking->patient->mobile , [
                        'first_name' => $booking->patient->first_name,
                        'last_name' => $booking->patient->last_name,
                        'misc_shortcodes' => json_encode([
                            'reference_no' => $booking->booking_reference_no,
                        ])
                    ]);
                }
            }
            return;
        }

        $mayCompleted = $bookingCenter->bookingServices->first(function($bService) {
            return $bService->isCompleted();
        });

        if ($mayCompleted) {
            $bookingCenter->status = BookingCenter::COMPLETED;
            return $bookingCenter->save();
        }

        $notCancelled = $bookingCenter->bookingServices->first(function($bService) {
            return !$bService->isCancelled();
        });

        // if walang kahit isa na hindi cancelled, meaning cancelled lahat
        if (!$notCancelled) {
            $bookingCenter->status = BookingCenter::CANCELLED;
            $bookingCenter->save();

            return;
        }

        // if ($prevStatus != $bookingCenter->status) {
        //     if ($bookingCenter->isConfirmed()) {
        //         Mail::to($booking->patient->email)->queue(
        //             new \App\Mail\BookingConfirmed($booking)
        //         );
        //         // Sms send for confirm
        //         if ($booking->patient->mobile) {
        //             ProcessSmsSending::dispatch('patient_service_confirmed', $booking->patient->mobile , [
        //                 'first_name' => $booking->patient->first_name,
        //                 'last_name' => $booking->patient->last_name,
        //                 'misc_shortcodes' => json_encode([
        //                     'reference_no' => $booking->booking_reference_no,
        //                 ])
        //             ]);
        //         }
        //     }
        // }
    }

    /**
     * Change status for specified booking.
     * 
     * @param  \App\Booking  $booking
     */
    public function changeBookingStatus(Booking $booking)
    {
        $mayApproved = $booking->bookingServices->first(function($bService) {
            return $bService->isApproved();
        });

        // if at least 1 is approved, then approved narin ung booking
        if ($mayApproved) {
            $booking->status = Booking::APPROVED;
            return $booking->save();
        }

        $mayConfirmed = $booking->bookingServices->first(function($bService) {
            return $bService->isConfirmed();
        });

        if ($mayConfirmed) {
            $booking->status = Booking::CONFIRMED;
            return $booking->save();
        }

        $mayCompleted = $booking->bookingServices->first(function($bService) {
            return $bService->isCompleted();
        });

        if ($mayCompleted) {
            $booking->status = Booking::COMPLETED;
            return $booking->save();
        }

        $notCancelled = $booking->bookingServices->first(function($bService) {
            return !$bService->isCancelled();
        });

        // if walang kahit isa na hindi cancelled, meaning cancelled lahat
        if (!$notCancelled) {
            $booking->status = Booking::CANCELLED;
            return $booking->save();
        }
    }

    /**
     * Send documents to patient in specified booking.
     * 
     * @param  \App\Booking  $booking
     * @param  \Illuminate\Http\Request  $request
     */
    public function sendPatientDocuments(Booking $booking, Request $request)
    {
        $request->validate([
            'message' => 'required',
            'attachments.*.file' => 'file|max:5000'
        ]);

        $files = array();
        /* $userLogged = auth()->user();
        $userCenter = $userLogged->center(); */
        $patientId = $booking->patient_id;

        // upload attachments here ...
        if($request->has('attachments')) {
            $attachments = $request->attachments;
            if(count((array)$attachments) > 0){
                foreach($attachments as $key => $attach){
                    if(isset($attach['file']) && !empty($attach['file'])){
                        $title = $attach['title'] ? $attach['title'].".".$attach['file']->getClientOriginalExtension() : $attach['file']->getClientOriginalName();
                        $uploadedFile = $booking->addMedia($attach['file'])->usingName($title)->toMediaCollection('service-booking-'.$patientId/* $userCenter->id */);
                        $files[] = $uploadedFile;

                        if ($attach['file']->isValid()) {
                            $message = $request->message;

                            Mail::to($booking->patient->email)->send(
                                new \App\Mail\PatientDocument($booking, $message, $files)
                            );
                        }
                    }
                }
            }
        }

        return redirect()->back()
                         ->with('success', 'Successfully sent documents!');
    }

    /**
     * Removed media from a specified booking.
     * 
     * @param  \App\Booking  $booking
     * @param  Media $media
     */
    public function removeMedia(Booking $booking, Media $media)
    {
        $media->delete();

        return redirect()->back()
                         ->with('success', 'Successfully removed file!');
    }
}

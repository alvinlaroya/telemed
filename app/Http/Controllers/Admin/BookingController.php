<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Booking;
use App\Service;
use Carbon\Carbon;
use App\ServiceForm;
use App\Consultation;
use App\BookingCenter;
use App\BookingService;
use App\ServiceCategory;
use Illuminate\Http\Request;
use App\Jobs\ProcessSmsSending;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a list of services booking.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $centers = ServiceCategory::get();

        $search = $request->filled('search') ? $request->search : null;
        $status = $request->filled('status') ? $request->status : null;
        $center = $request->filled('center') ? $request->center : null;

        $bookings = Booking::when($search, function($query) use($search) {
            $query->where('booking_reference_no', 'LIKE', "%$search%")
                ->orWhereHas('patient', function($q) use($search) {
                $q->where(\DB::raw('concat(first_name, " ", last_name, " ", middle_name)'), 'like', "%$search%");
            });
        })
        ->when($center, function($query) use($center){
            $query->whereHas('service', function($q) use($center) {
                $q->where('category_id', $center);
            });
        })
        ->when($status, function($query) use($status){
            $query->where('status', $status);
        })
        ->latest()->paginate(15);

		return view('admin.services-booking.index', compact('bookings', 'centers'));
    }

    /**
     * Show the form for creating a new booking.
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created booking in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified booking.
     *
     * @param  int  $id
     */
    public function show(Booking $booking)
    {
        // \App\Jobs\RedoScreening::dispatch();
        $user = request()->user();
        // $bookingCenter = $booking->bookingCenters()->ofCenters($user->center())
        //                             ->firstOrFail();

        $assignedCenters = $user->assignedCentersArr();
        $bookingCenters = $booking->bookingCenters;

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

        return view('admin.services-booking.show', compact('booking', 'bookingCenters', 'totalAmount', 'amountPaid', 'subTotal', 'discount'));
    }

    /**
     * Approved service booking.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
	public function approve(Request $request)
	{
        $todayDate = Carbon::now();
        $booking = Booking::find((int)$request->booking_id);
        $booking->status = Booking::APPROVED;
        $booking->available_date = $request->available_date;
        $booking->available_time = $request->available_time;
        $booking->comment = $request->comment;
        $booking->expiration = $todayDate->addDays(1);
		$booking->save();

		Mail::to($booking->patient->email)->send(new \App\Mail\BookingApproved($booking));

		if ($booking->patient->mobile) {
            // ProcessSmsSending::dispatch('patient_service_approved', $booking->patient->mobile , [
            //     'first_name' => $booking->patient->first_name,
            //     'last_name' => $booking->patient->last_name,
            //     'misc_shortcodes' => json_encode([
            //         'service' => $booking->service ? $booking->service->name : '--',
            //         'booking_date' => Carbon::parse($booking->available_date . ' ' . $booking->available_time)->copy()->toDayDateTimeString()
            //     ])
            // ]);
        }
		return redirect()->back()
						 ->with('success', 'Successfully approved the booking!');
    }

    public function serviceApprove(Booking $booking, BookingService $bService)
    {
        $bService->status = BookingService::APPROVED;
        $bService->save();

        $this->statusChanges($booking, BookingService::APPROVED, $bService);

        return redirect()->back()->with('Successfully updated status.');
    }

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
                    // if ($booking->patient->mobile) {
                    //     ProcessSmsSending::dispatch('patient_service_approved2', $booking->patient->mobile , [
                    //         'first_name' => $booking->patient->first_name,
                    //         'last_name' => $booking->patient->last_name,
                    //         'misc_shortcodes' => json_encode([
                    //             'reference_no' => $booking->booking_reference_no,
                    //         ])
                    //     ]);
                    // }
                } else {
                    $booking->expiration = now()->addDays(1);
                    $booking->save();

                    // if($booking->allCentersAreAfter5Days()) {
                    //     Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApprovedNoService($booking));
                    // } else {
                    //     Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApproved($booking));
                    // }

                    Mail::to($booking->patient->email)->queue(new \App\Mail\BookingApproved($booking));

                    // if ($booking->patient->mobile) {
                    //     ProcessSmsSending::dispatch('patient_service_approved', $booking->patient->mobile , [
                    //         'first_name' => $booking->patient->first_name,
                    //         'last_name' => $booking->patient->last_name,
                    //         'misc_shortcodes' => json_encode([
                    //             'reference_no' => $booking->booking_reference_no,
                    //         ])
                    //     ]);
                    // }
                }
            }
            elseif($booking->isCancelled()) {
                Mail::to($booking->patient->email)->queue(
                    new \App\Mail\BookingCancelled($booking)
                );
            }
        }

    }

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

    public function serviceBookingComplete(Booking $booking, BookingService $bService)
    {
        $bService->status = BookingService::COMPLETED;
        $bService->save();

        $this->statusChanges($booking, BookingService::COMPLETED, $bService);

        return redirect()->back()
                         ->with('Successfully updated status.');
    }

    public function serviceBookingCancel(Booking $booking, BookingService $bService, Request $request)
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
                    // ProcessSmsSending::dispatch('patient_service_confirmed', $booking->patient->mobile , [
                    //     'first_name' => $booking->patient->first_name,
                    //     'last_name' => $booking->patient->last_name,
                    //     'misc_shortcodes' => json_encode([
                    //         'reference_no' => $booking->booking_reference_no,
                    //     ])
                    // ]);
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
    }

    public function changeDate(Booking $booking, BookingCenter $bCenter, Request $request)
    {
        $actualDateTime = new Carbon($request->date. ' ' .$request->time);

        $bCenter->available_date = $actualDateTime;
        $bCenter->available_time = $request->time;
        $bCenter->remarks = $request->remarks;
        $bCenter->save();

        return redirect()->back()->with('Successfully updated date and time.');
    }

    /**
     * Cancel service booking.
     * 
     * @param  \App\Booking  $booking
     */
    public function cancel(Booking $booking)
    {
        $booking->status = Booking::CANCELLED;
        $booking->save();

        Mail::to($booking->patient->email)->send(new \App\Mail\BookingCancelled($booking));

		return redirect()->back()
						 ->with('success', 'Successfully cancelled the booking!');
    }

    /**
     * Confirm service booking.
     * 
     * @param  \App\Booking  $booking
     */
    public function confirm(Booking $booking)
	{
		$booking->status = Booking::CONFIRMED;
        $booking->save();

		Mail::to($booking->patient->email)->send(
			new \App\Mail\BookingConfirmed($booking)
		);

		// Sms send for confirm
        if ($booking->patient->mobile) {
            // ProcessSmsSending::dispatch('patient_service_confirmed', $booking->patient->mobile , [
            //     'first_name' => $booking->patient->first_name,
            //     'last_name' => $booking->patient->last_name,
            //     'misc_shortcodes' => json_encode([
            //         'service' => $booking->service ? $booking->service->name : '--',
            //         'booking_date' => Carbon::parse($booking->available_date . ' ' . $booking->available_time)->copy()->toDayDateTimeString()
            //     ])
            // ]);
        }

		return redirect()->back()
						 ->with('success', 'Successfully confirmed booking!');
	}

    /**
     * Change status of service booking to completed.
     * 
     * @param  \App\Booking  $booking
     */
	public function complete(Booking $booking)
	{
		$booking->status = Booking::COMPLETED;
		$booking->save();

		return redirect()->back()
						 ->with('success', 'Successfully completed booking!');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking $booking
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'services' => 'required',
            'prefDate' => 'required',
            'birthDate' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
        ]);

        $patient = $booking->patient;
        $patient->first_name = $request->firstname;
        $patient->last_name = $request->lastname;
        $patient->middle_name = $request->middlename;
        $patient->mobile = $request->mobile;
        $patient->email = $request->email;
        $patient->birthdate = Carbon::parse($request->birthDate)->copy()->toDateString();
        $patient->save();

        $booking->patient_id = $patient->id;
        $booking->preferred_date = $request->prefDate ? Carbon::parse($request->prefDate)->copy()->toDateString() : null;

        if($booking->save()) {
            if($request->services) {
                $tmpBookingServices = BookingService::where('booking_id', $booking->id)->get();
                if($tmpBookingServices) {
                    foreach($tmpBookingServices as $tmpBS) {
                        $tmpBS->delete();
                    }
                }
                foreach($request->services as $key => $service) {
                    $bookingService = new BookingService;
                    $bookingService->booking_id = $booking->id;
                    $bookingService->service_id = $service;

                    $bookingService->save();
                }
            }
        }

        return redirect()->back()
                        ->with('success', 'Successfully updated the booking!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Geneate booking reference number.
     * 
     */
    public function generateUniqueBookingRef()
    {
        $number = mt_rand(1000000, 9999999);

        if($this->isBookingRefExists($number))
        {
            return generateUniqueBookingRef();
        }

        return $number;
    }

    /**
     * Check if booking reference number already exists.
     * 
     * @param  int $number
     */
    public function isBookingRefExists($number)
    {
        return Booking::where('booking_reference_no', $number)->exists();
    }

}

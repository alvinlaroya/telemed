<?php

namespace App\Http\Controllers\Patient;

use PDF;
use App\Booking;
use App\Service;
use Carbon\Carbon;
use App\ServiceForm;
use App\BookingService;
use App\ServiceCategory;
use Illuminate\Http\Request;
use App\Jobs\ProcessSmsSending;
use App\Jobs\SendSmsJob;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Controllers\Controller;


class BookingController extends Controller
{
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
        

		return view('patient.services-booking.index', compact('bookings', 'centers'));
    }

    public function show(Booking $booking)
    {
        $services = Service::latest()->get();
        $serviceCategories = ServiceCategory::orderBy('name')->get();
        $customFields = ServiceForm::orderBy('order')->get();

        return view('patient.services-booking.show', compact('booking', 'services', 'serviceCategories', 'customFields'));
    }

    public function sendPatientDocuments(Booking $booking, Request $request)
    {
        $request->validate([
            'message' => 'required',
            'attachments.*.file' => 'file|max:5000'
        ]);

        $files = array();
        $userLogged = auth()->user();
        $userCenter = $userLogged->patient;
        $patientName = $booking->patient->first_name.' '.$booking->patient->last_name;

        $centerAdminMobile = '';

        foreach($booking->bookingCenters as $key => $bookingCenter) {
            foreach($bookingCenter->serviceCenter->mobile_recepients as $mobile) {
               $centerAdminMobile .= $mobile.',';
            }
        }

        $centerAdminMobile = substr($centerAdminMobile, 0, -1);

        // upload attachments here ...
        if($request->has('attachments')){
            $attachments = $request->attachments;
            if(count((array)$attachments) > 0){
                foreach($attachments as $key => $attach) {
                    if(isset($attach['file']) && !empty($attach['file'])){
                        $title = $attach['title'] ? $attach['title'].".".$attach['file']->getClientOriginalExtension() : $attach['file']->getClientOriginalName();
                        $uploadedFile = $booking->addMedia($attach['file'])->usingName($title)->toMediaCollection('service-booking-'.$userCenter->id);
                        $files[] = $uploadedFile;

                        if ($attach['file']->isValid()) {
                            Mail::to($booking->patient->email)->queue(
                                new \App\Mail\PatientUploadedFileOnLabs($booking, $patientName)
                            );
                            

                            if ($centerAdminMobile !== '') {
                                $bCenter = $booking->bookingCenters->first();
                                SendSmsJob::dispatch('patient_uploaded_lab_file', $centerAdminMobile, [
                                    'id'           => $booking->id,
                                    'first_name'   => $booking->patient->first_name,
                                    'last_name'    => $booking->patient->last_name,
                                    'reference_no' => $booking->booking_reference_no,
                                    'booking_date' => $bCenter->preferred_date->format(self::DATE_FORMAT)
                                ]);
                            }

                        }
                    }
                }
            }
        }

        /* $patient = $booking->patient;
        $message = $request->message;

        Mail::to($patient->email)->send(
            new \App\Mail\PatientDocument($patient, $message, $files)
        ); */

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

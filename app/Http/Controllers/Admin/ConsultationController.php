<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Doctor;
use App\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Models\Media;

class ConsultationController extends Controller
{
	/**
	 * Display a list of consultations.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function index(Request $request)
	{
		$consultations = Consultation::paginate(15);

		return view('admin.consultations.index', compact('consultations'));
	}

	/**
	 * Show a specified consultation.
	 * 
	 * @param  \App\Consultation  $consultation
	 */
	public function show(Consultation $consultation)
	{
		return view('admin.consultations.show', compact('consultation'));
	}

	/**
	 * Update the specified consultation data from storage.
	 * 
	 * @param  \App\Consultation  $consultation
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function update(Consultation $consultation, Request $request)
	{
		// $request->validate([
  //           'remarks' => 'required',
  //       ]);

        $consultation->remarks = $request->remarks;
        $consultation->save();

        // upload attachments here ...
        if ($request->has('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $consultation->addMedia($file)->toMediaCollection('doctor');
            }
        }

        return redirect()->back()
                         ->with('success', 'Successfully updated appointment!');
	}

	/**
	 * Remove media from specified consultation.
	 * 
	 * @param  \App\Consultation  $consultation
	 * @param  Media  $media
	 */
	public function removeMedia(Consultation $consultation, Media $media)
    {        
        $media->delete();

        return redirect()->back()
                         ->with('success', 'Successfully removed file!');
    }    

	/**
	 * Change status of specified consultation to approved.
	 * 
	 * @param  \App\Consultation  $consultation
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function approve(Consultation $consultation, Request $request)
	{
		$rescheduled = $request->has('reschedule');
		$actualDateTime = $consultation->date_time;
		if ($rescheduled) {
			$actualDateTime = $request->date. ' ' .$request->time;
		}

		$consultation->paid = 1;
		$consultation->status = Consultation::APPROVED;
		$consultation->actual_datetime = $actualDateTime;
		$consultation->save();

		Mail::to($consultation->email)->send(
			new \App\Mail\AppointmentApproved($consultation, $rescheduled)
		);

		return redirect()->back()
						 ->with('success', 'Successfully approved appointment!');
	}

	/**
	 * Change status of specified consultation to confirmed.
	 * 
	 * @param  \App\Consultation  $consultation
	 */
	public function confirm(Consultation $consultation)
	{
		$consultation->status = Consultation::CONFIRMED;
		$consultation->save();

		Mail::to($consultation->email)->send(
			new \App\Mail\AppointmentConfirmed($consultation)
		);

		return redirect()->back()
						 ->with('success', 'Successfully confirmed appointment!');
	}

	/**
	 * Change status of specified consultation to completed.
	 * 
	 * @param  \App\Consultation  $consultation
	 */
	public function complete(Consultation $consultation)
	{
		$consultation->status = Consultation::COMPLETED;
		$consultation->save();

		return redirect()->back()
						 ->with('success', 'Successfully completed appointment!');
	}

}
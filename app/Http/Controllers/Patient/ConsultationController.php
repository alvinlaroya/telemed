<?php

namespace App\Http\Controllers\Patient;

use App\User;
use App\Doctor;
use App\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Jobs\ProcessSmsSending;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Spatie\MediaLibrary\Models\Media;
use Zoom;
use MacsiDigital\API\Support\Authentication\JWT;

class ConsultationController extends Controller
{
    public function index(Request $request)
	{
        $search = $request->filled('search') ? $request->search : null;
        $status = $request->filled('status') ? $request->status : null;
        $sortBy = $request->filled('sort_by') ? $request->sort_by : null;
        $patientLogged = auth()->user()->patient;
        $query = Consultation::where('patient_id', $patientLogged->id)
	        ->when($search, function($query) use($search) {
                $query->whereHas('patient', function($q) use ($search) {
    	        	$q->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%")
    	        		  ->orWhere('reference_no', 'LIKE', "%$search%")
    	        		  ->orWhere('complaint', 'LIKE', "%$search%")
    	        		  ->orWhere('email', 'LIKE', "%$search%");
                });
	        })
	        ->when($status, function($query) use($status){
	            $query->where('status', $status);
	        });

        switch ($sortBy) {
            case 'appointment_date':
                $query = $query->orderBy('actual_datetime', 'desc');
                break;
            default:
                $query = $query->latest();
                break;
        }

	    $consultations = $query->paginate(15);

		return view('patient.consultations.index', compact('consultations'));
    }

    public function show(Consultation $consultation)
	{
        $patient = auth()->user()->patient;
        abort_if($consultation->patient_id != $patient->id, 403);

        $logs = $consultation->logs;
		return view('patient.consultations.show', compact('consultation', 'logs'));
	}
}

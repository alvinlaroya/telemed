<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceForm;
use App\DoctorForm;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DynamicForm extends Controller
{
    /**
     * Display a list of dynamic form for service.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function service(Request $request)
    {
        $questions = ServiceForm::orderBy('order')->get();

        return view('admin.dynamic-forms.services', compact('questions'));
    }

    /**
     * Display a list of dynamic form for doctors.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function doctors(Request $request)
    {
        $questions = DoctorForm::orderBy('order')->get();

        return view('admin.dynamic-forms.doctors', compact('questions'));
    }

    /**
     * Save question data in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function saveQuestion(Request $request)
    {
        if (count($request->items) > 0) {
            $toSave = [];
            foreach($request->items as $key => $item) {
                $i = [
                    'order' => $key,
                    'required' => $item['required'] ?: false,
                    'question' => $item['question'],
                    'type' => $item['type'],
                    'options' => in_array($item['type'], ['radio','checkbox']) && count($item['options']) > 0 ? (array) $item['options'] : null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                $toSave[] = $i;
            }

            if($request->saving_type == 'service') {
                ServiceForm::truncate();
                DB::table('form_service')->insert($toSave);
            } else if($request->saving_type == 'doctor') {
                DoctorForm::truncate();
                DB::table('form_doctors')->insert($toSave);
            }

        }

        return response()->json(['message' => 'Nothing to save!'], 200);
    }
}

<?php

namespace App\Http\Controllers\Center;

use App\Booking;
use App\BookingCenter;
use App\BookingService;
use App\ServiceForm;
use App\ServiceCategory;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomFieldsController extends Controller
{
    /**
     * Display center custom fields.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
	public function index(Request $request)
	{
        $center = ServiceCategory::find($request->center);
		$questions = ServiceForm::ofCenter($center)->orderBy('order')->get();

        return view('center.custom-fields', compact('questions', 'center'));
    }

    /**
     * Display list of centers.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function centerLists(Request $request)
    {
        $user = $request->user();
        $assignedCenter = $user->assignedCentersArr();
        $centers = ServiceCategory::whereIn('id', $assignedCenter)->latest()->paginate(20);

        return view('center.cf-centers', compact('centers'));
    }

    /**
     * Save specified custom field.
     * 
     * @param  \App\ServiceCategory  $center
     * @param  \Illuminate\Http\Request  $request
     */
	public function save(ServiceCategory $center, Request $request)
	{
		$items = (array) $request->items;

		if (count($items) === 0) {
			return response()->json(['message' => 'Nothing to save!'], 200);
		}

        $customFields = [];
        $center->load('customFields');
        foreach ($items as $key => $item) {
        	$id = $item['id'] ?? null;
        	$existCField = null;
        	if ($id) {
        		$existCField = $center->customFields->first(function($field) use ($id) {
        			return $field->id == $id;
        		});
        	}
        	$cField = $existCField ?? new ServiceForm;
        	$cField->fill([
                'order' => $key,
                'required' => (isset($item['required']) && $item['required']) ?: false,
                'question' => $item['question'] ?? '',
                'type' => $item['type'] ?? '',
                'options' => in_array($item['type'], ['radio','checkbox']) && count($item['options']) > 0
                	? (array) $item['options'] : null,
        	]);
            $customFields[] = $cField;
        }

        if (count($customFields) > 0) {
        	$center->customFields()->saveMany($customFields);
        }

        // delete existings fields not in the array
        $center->customFields->each(function($field) use ($customFields) {
        	$first = Arr::first($customFields, function ($c, $key) use ($field) {
			    return $c->id == $field->id;
			});
        	if (!$first) $field->delete();
        });

        $center = $center->fresh('customFields');
        return $center->customFields;
	}
}

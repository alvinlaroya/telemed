<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const TIME_FORMAT = 'h:i A';
    const DATE_FORMAT = 'M-j-Y';
    const DATETIME_FORMAT = 'M-j-Y h:i A';

	/**
	 * Custom method to throw json error
	 */
    public function throwJsonError($msg = null, $errors = []) 
	{
		return response()->json([
			'errors' => $errors,
			'message' => $msg ?? 'The given data was invalid.',
		], 422);
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class EmergencyController extends Controller
{
    //

    public function location(Request $request)
    {
        if ($position = Location::get()) {
            // Successfully retrieved position.
            return ['position'=>$position];
        } else {
            // Failed retrieving position.
            return ['position'=>'error'];
        }
    }
}

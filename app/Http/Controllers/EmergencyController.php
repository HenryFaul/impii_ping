<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use App\Models\SecurityDetail;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

    public function store(Request $request){

        $user_id = Auth::id();

        $request->validate([
            'type' => ['required'],
            'address' => ['required'],
            'emergency_details' => ['required'],
            'browser_lat' => ['required'],
            'browser_long' => ['required'],
        ]);

         $emergency = Emergency::create([
             'client_id'=>$user_id,
             'type'=>$request->get('type'),
             'address'=>$request->get('address'),
             'emergency_details'=>$request->get('emergency_details'),
             'browser_lat'=>$request->get('browser_lat'),
             'browser_long'=>$request->get('browser_long'),
         ]);


        return Redirect::route('sos')->with('success', 'Emergency created. We will call you ASAP.');




    }
}

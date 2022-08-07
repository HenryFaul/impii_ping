<?php

namespace App\Http\Controllers;

use App\Mail\NewEmegencyMarkdown;
use App\Mail\NewRegistrationMarkdown;
use App\Models\Emergency;
use App\Models\SecurityDetail;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Stevebauman\Location\Facades\Location;

class EmergencyController extends Controller
{
    //



    public function index()
    {
        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        return Inertia::render('Emergency/Index', [

            'emergencies' => Emergency::all()

        ]);
    }

    public function edit( $emergency_id)
    {
        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        $emergency = Emergency::find($emergency_id);
        $emergency_user = User::find($emergency->client_id);


        return Inertia::render('Emergency/Edit', [
            'emergency' => $emergency,
            'emergency_user'=>$emergency_user
        ]);
    }

    public function update(Request $request, $emergency_id)
    {

        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        $emergency = Emergency::find($emergency_id);

        \Illuminate\Support\Facades\Request::validate([
            'admin_comments' => ['required'],
            'emergency_closed' => ['required'],

        ]);

        $emergency->update($request->only('admin_comments', 'emergency_closed'));

        return Redirect::back()->with('success', 'Emergency updated.');
    }



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

        $user = User::find($user_id);

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

         $mail= new NewEmegencyMarkdown($user,$emergency);
         Mail::to($user->email)->send($mail);



        return Redirect::route('sos')->with('success', 'Emergency created. We will call you ASAP.');




    }
}

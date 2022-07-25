<?php

namespace App\Http\Controllers;

use App\Models\SecurityDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::id();

        $security_details = SecurityDetail::where('client_id',$user_id)->get();

        return Inertia::render('Admin/Index',['security_details'=>$security_details]);


    }
}

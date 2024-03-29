<?php

namespace App\Http\Controllers;

use App\Models\SecurityDetail;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $security_details = SecurityDetail::where('client_id',$user_id)->get();

        return Inertia::render('Dashboard/Index',['security_details'=>$security_details]);


    }
}

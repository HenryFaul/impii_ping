<?php

namespace App\Http\Controllers;

use App\Models\SecurityDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        $security_details = SecurityDetail::all();

        return Inertia::render('Admin/Index',['security_details'=>$security_details]);


    }
}

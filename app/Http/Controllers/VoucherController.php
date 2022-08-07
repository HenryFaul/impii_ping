<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use App\Models\SecurityDetail;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class VoucherController extends Controller
{
    //
    public function index(){

        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        return Inertia::render('Vouchers/Index', [
            'vouchers' => Voucher::all()
        ]);
    }

    public function edit( $voucher_id)
    {
        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        $emergency = Voucher::find($voucher_id);
        $security_details = SecurityDetail::where('voucher_id',$voucher_id);

        return Inertia::render('Emergency/Edit', [
            'emergency' => $emergency,
            'security_details'=>$security_details
        ]);
    }

    public function voucher(Request $request){

        $voucher_key= $request->voucher_key;
        return Voucher::where('voucher_key',$voucher_key)->get();
    }
}

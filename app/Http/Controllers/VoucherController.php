<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //
    public function index(){

        return Voucher::all();
    }

    public function voucher(Request $request){

        $voucher_key= $request->voucher_key;
        $voucher = Voucher::where('voucher_key',$voucher_key)->get();

        return $voucher;
    }
}

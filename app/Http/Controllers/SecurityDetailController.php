<?php

namespace App\Http\Controllers;

use App\Models\SecurityDetail;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class SecurityDetailController extends Controller
{
    //

    public function index(SecurityDetail $detail)
    {

      //  dd($detail);

      //  $this->authorize('edit-user',$user);

        return Inertia::render('Detail/View', [
            'detail' => $detail,
        ]);
    }

    public function indexAdmin(SecurityDetail $detail)
    {
        //  $this->authorize('edit-user',$user);

        $agent_users = User::role('agent')->with('agentdetail')->get();

        return Inertia::render('Admin/View', [
            'detail' => $detail,
            'agent_users'=>$agent_users
        ]);
    }

    public function update(Request $request,SecurityDetail $detail)
    {

        //if agent id
        if ($request->get('agent_id')){
            $detail->update(['agent_id'=>$request->get('agent_id'),'agent_accepted'=>1]);
        }

        //if detail_started
        if ($request->get('detail_started')){
            $detail->update(['detail_started'=>$request->get('detail_started')]);
        }

        //if detail ended
        if ($request->get('detail_ended')){
            if ($detail->detail_started){
                $detail->update(['detail_ended'=>$request->get('detail_ended')]);
            }
        }

        if ($request->get('actual_end_date')) {
            $actual_end_date= $request->get('actual_end_date');
            $conv_actual_end_date = Carbon::parse($actual_end_date)->toDateTimeString();
            $detail->update(['actual_end_date'=>$conv_actual_end_date]);
            //update charge
            $diff = Carbon::parse($detail->start_date)->diff(Carbon::parse($detail->actual_end_date));
            $hours = $diff->h;
            $hours = $hours + ($diff->days*24);
            $calc_total_charge = $hours*$detail->hourly_rate;

            //Final charge

            $final_charge_calc = $calc_total_charge-$detail->deposit_received-$detail->voucher_max;
            $final_charge = max($final_charge_calc, 0);

            //Update detail
            $detail->update(['calc_total_hours'=>$hours,'calc_total_charge'=>$calc_total_charge,'final_charge'=>$final_charge]);
        }

        return Redirect::back()->with('success', 'User updated.');
    }




}
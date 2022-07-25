<?php

namespace App\Http\Controllers;

use App\Models\PaymentHistory;
use App\Models\SecurityDetail;
use App\Models\Voucher;
use Billow\Contracts\PaymentProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class PaymentController extends Controller
{

    public function depositPayment(PaymentProcessor $payfast, Request $request)
    {
        //deposit const
        $dep_amnt = 1000;

        //amnt of security details to be used in unique payment ref
        $max_id = SecurityDetail::count() + 1;

        // validator
        $validator = Validator::make($request->all(), [
            'security_type_id' => 'required',
            'client_briefing' => 'required',
            'address' => 'required',
            'city' => 'required',
            'start_date' => 'required',
            'planned_end_date' => 'required',
            'hourly_rate' => 'required',
        ], [
            'security_type_id.required' => 'Security type required',
            'client_briefing.required' => 'Security briefing required',
            'address.required' => 'Address required',
            'city.required' => 'City required.',
            'start_date.required' => 'Start date required',
            'planned_end_date.required' => 'End date required',
            'hourly_rate.required' => 'Hourly rate required',

        ]);

        // check validation
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->messages()
            ];
            return ['result' => 'val_failed', 'data' => "Something in your data is weird.", 'custom_val' => $response];
        }

        // Get all data points
        $user = Auth::user();
        $user_id = Auth::id();
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $email = $user->email;
        $franchise_id = 1;
        $deposit_reference = "dep_" . $max_id;
        $final_reference = "final_" . $max_id;
        $currency = 'ZAR';
        $payment_type = 'EFF';
        $security_type_id = $request->get('security_type_id');
        $client_briefing = $request->get('client_briefing');
        $address = $request->get('address');
        $city = $request->get('city');
        $start_date = $request->get('start_date');
        $planned_end_date = $request->get('planned_end_date');
        $hourly_rate = $request->get('hourly_rate');
        $voucher_id = $request->get('voucher_id');
        $voucher_max = $request->get('voucher_max');

        //Convert the dates to suite laravel
        $conv_start_date = Carbon::parse($start_date)->toDateTimeString();
        $conv_planned_end_date = Carbon::parse($planned_end_date)->toDateTimeString();

        //hours between two dates
        $diff = Carbon::parse($planned_end_date)->diff(Carbon::parse($start_date));

        $hours = $diff->h;
        $hours = $hours + ($diff->days * 24);
        $calc_total_charge = $hours * $hourly_rate;

        // Make security detail
        $securityDetail = SecurityDetail::create([
            'client_id' => $user_id,
            'security_type_id' => 1,
            'franchise_id' => $franchise_id,
            'client_briefing' => $client_briefing,
            'address' => $address,
            'city' => $city,
            'start_date' => $conv_start_date,
            'planned_end_date' => $conv_planned_end_date,
            'actual_end_date' => $conv_planned_end_date,
            'deposit_reference' => $deposit_reference,
            'final_reference' => $final_reference,
            'currency' => $currency,
            'payment_type' => $payment_type,
            'hourly_rate' => $hourly_rate,
            'voucher_id' => $voucher_id,
            'voucher_max' => $voucher_max,
            'calc_total_hours' => $hours,
            'calc_total_charge' => $calc_total_charge
        ]);

        //check if a deposit payment is needed
        $max_amount = 0;
        $dep_payable = $dep_amnt;

        if ($voucher_max > 0) {
            $voucher = Voucher::find($voucher_id);
            $max_amount = $voucher->$max_amount;

            if (!isEmpty($voucher)) {

                if ($voucher->active == 1) {
                    //set actual max amount
                    $securityDetail->voucher_max = $max_amount;
                    $securityDetail->save();

                    //increment voucher use
                    $voucher->uses = $voucher->uses + 1;

                    //check to make inactive
                    if ($voucher->uses >= $voucher->max_uses) {
                        $voucher->active = 0;
                    }

                    $voucher->save();

                }
            }
        }

        //if total charge is more than the voucher
        if ($calc_total_charge > $max_amount) {

            //create a payment history object

            $paymentHistory = PaymentHistory::create([
                'detail_id' => $securityDetail->id,
                'reference' => $deposit_reference,
                'status' => 'pending',
                'type' => 'deposit',
                'value' => $dep_amnt,
            ]);

            $payfast->setBuyer($first_name, $last_name, $email);
            $payfast->setAmount($dep_amnt);
            $payfast->setItem('Impii Protection (Deposit)', 'Impii Connected Protection Service deposit.');
            $payfast->setMerchantReference($deposit_reference);

            // Optionally send confirmation email to seller
            // $payfast->setEmailConfirmation();
            // $payfast->setConfirmationAddress(env('PAYFAST_CONFIRMATION_EMAIL'));

            return ['result' => 'success', 'data' => $payfast->paymentForm('Pay Deposit')];

        }

        return ['result' => 'no_dep', 'data' => 'none'];

    }

    public function finalPayment(PaymentProcessor $payfast, Request $request, SecurityDetail $securityDetail)
    {
        // Get all data points
        $user = Auth::user();
        $user_id = Auth::id();
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $email = $user->email;

        //if total charge is more than 0
        if ($securityDetail->final_charge > 0) {

            //create a payment history object

            $paymentHistory = PaymentHistory::create([
                'detail_id' => $securityDetail->id,
                'reference' => $securityDetail->final_reference,
                'status' => 'pending',
                'type' => 'final',
                'value' => $securityDetail->final_charge,
            ]);

            $payfast->setBuyer($first_name, $last_name, $email);
            $payfast->setAmount($securityDetail->final_charge);
            $payfast->setItem('Impii Protection (Final)', 'Impii Connected Protection Service final.');
            $payfast->setMerchantReference($securityDetail->final_reference);

            // Optionally send confirmation email to seller
            // $payfast->setEmailConfirmation();
            // $payfast->setConfirmationAddress(env('PAYFAST_CONFIRMATION_EMAIL'));

            return ['result' => 'success', 'data' => $payfast->paymentForm('Pay Final')];

        }

        return ['result' => 'no_charge', 'data' => 'none'];

    }

    public function itn(Request $request, PaymentProcessor $payfast)
    {
        // Retrieve the Order from persistance. Eloquent Example.
        $paymentHistory = PaymentHistory::where('reference', $request->get('m_payment_id'))->firstOrFail(); // Eloquent Example

        // Verify the payment status.
        $status = $payfast->verify($request, $paymentHistory->value, $paymentHistory->reference)->status();
        $paymentHistory->status = $status;
        $paymentHistory->save();

        //match payments with security details

        this.$this->paymentRecon();

        // Handle the result of the transaction.
        switch ($status) {
            case 'COMPLETE': // Things went as planned, update your order status and notify the customer/admins.
                break;
            case 'FAILED': // We've got problems, notify admin and contact Payfast Support.
                break;
            case 'PENDING': // We've got problems, notify admin and contact Payfast Support.
                break;
            default: // We've got problems, notify admin to check logs.
                break;
        }
    }

    public function paymentRecon()
    {

        //get all payments not updated
        $payments = PaymentHistory::where('is_updated', '0')->get();

        foreach ($payments as $payment) {

            $reference = $payment->reference;
            $status = $payment->status;
            $value = $payment->value;
            $type = $payment->type;

            if ($status === 'COMPLETE') {

                if ($type === 'deposit') {
                    $SecurityDetailDep = SecurityDetail::where('deposit_reference', $reference)->first();
                    $SecurityDetailDep->deposit_received = $value;
                    $SecurityDetailDep->save();
                } else {
                    $SecurityDetailFin = SecurityDetail::where('final_reference', $reference)->first();
                    $SecurityDetailFin->deposit_received = $value;
                    $SecurityDetailFin->save();
                }

                $payment->is_updated = 1;
                $payment->save();

            }


        }


    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewRegistrationMarkdown;
use App\Models\User;
use App\Models\Voucher;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'cell_no' => 'required|digits:10',
            'terms' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cell_no' => $request->cell_no,
            'email' => $request->email,
            'primary_role' => 'client',
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole(['name' => 'client']);


        $voucher = Voucher::create([
            'max_uses' => '1',
            'active' => '1',
            'currency' => 'ZAR',
            'max_amount' => '400',
            'description' => $user->first_name.' is awesome',
            'voucher_key' => $user->email,
        ]);


        $mail= new NewRegistrationMarkdown($user,$voucher);
        Mail::to($user->email)->send($mail);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


}

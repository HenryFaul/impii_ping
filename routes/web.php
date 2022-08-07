<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SecurityDetailController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VoucherController;
use App\Mail\NewAgentMarkdown;
use App\Mail\NewDetailMarkdown;
use App\Mail\NewEmegencyMarkdown;
use App\Mail\NewRegistrationMarkdown;
use App\Models\Emergency;
use App\Models\SecurityDetail;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Security Detail

Route::get('/detail/new', function () {
    return Inertia::render('Detail/Create');
})->middleware(['auth'])->name('detail.create');


Route::get('detail/{detail}/view', [SecurityDetailController::class, 'index'])
    ->name('detail.view')
    ->middleware('auth');


//Payment

Route::post('/pay', [PaymentController::class, 'depositPayment'])
    ->name('payment')
    ->middleware('auth');

Route::post('/pay/update/tip', [PaymentController::class, 'updateTip'])
    ->name('payment.tip.update')
    ->middleware('auth');

Route::get('/pay/final', [PaymentController::class, 'finalPayment'])
    ->name('payment.final')
    ->middleware('auth');

Route::get('/pay/success', function () {
    return Inertia::render('Payments/Success');
})->middleware(['auth'])->name('payment.success');

Route::get('/pay/cancel', function () {
    return Inertia::render('Payments/Cancel');
})->middleware(['auth'])->name('payment.cancel');

Route::get('/pay/history', function () {
    return Inertia::render('Payments/Index');
})->middleware(['auth'])->name('payment.history');

Route::post('/pay/notify', [PaymentController::class, 'itn'])
    ->name('payment.notification');

//Vouchers

Route::get('/vouchers', [VoucherController::class, 'index'])
    ->name('vouchers')
    ->middleware('auth');


Route::get('/voucher/{voucher_key}', [VoucherController::class, 'voucher'])
    ->name('voucher.key')
    ->middleware('auth');

//SOS

Route::get('/sos', function () {
    return Inertia::render('Emergency/Create');
})->middleware(['auth'])->name('sos');

Route::get('/emergencies', [EmergencyController::class, 'index'])
    ->name('emergencies')
    ->middleware('auth');

Route::get('emergency/{emergency_id}/edit', [EmergencyController::class, 'edit'])
    ->name('emergency.edit')
    ->middleware('auth');

Route::put('emergency/{emergency_id}/update', [EmergencyController::class, 'update'])
    ->name('emergency.update')
    ->middleware('auth');

/*Route::get('/help', [EmergencyController::class, 'location'])
    ->name('help')
    ->middleware('auth');*/

Route::post('/help', [EmergencyController::class, 'store'])
    ->name('help')
    ->middleware('auth');

//Admin

/*Route::get('/admin', function () {
    return Inertia::render('Admin/Index');
})->middleware(['auth'])->name('admin');*/

Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin')
    ->middleware('auth');


Route::get('admin/detail/{detail}/view', [SecurityDetailController::class, 'indexAdmin'])
    ->name('admin.detail.view')
    ->middleware('auth');

Route::put('admin/detail/{detail}/update', [SecurityDetailController::class, 'update'])
    ->name('detail.update')
    ->middleware('auth');


//Client

/*Route::get('/client', function () {
    return Inertia::render('Client/Index');
})->middleware(['auth'])->name('client');*/

//Agent

Route::get('/agent', function () {
    return Inertia::render('Agent/Index');
})->middleware(['auth'])->name('agent');

Route::get('agent/{user}/profile', [AgentController::class, 'profile'])
    ->name('agent.profile')
    ->middleware('auth');


Route::get('agent/{user}/edit', [AgentController::class, 'index'])
    ->name('agent.edit')
    ->middleware('auth');

Route::put('agent/{user}/update', [AgentController::class, 'update'])
    ->name('agent.update')
    ->middleware('auth');

// Auth

Route::get('/landing', function () {
    return Inertia::render('Auth/Landing');
})->middleware(['guest'])->name('landing');

Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register')
    ->middleware('guest');

Route::post('register', [RegisteredUserController::class, 'store'])
    ->name('register.store')
    ->middleware('guest');

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users


Route::put('users/make/admin/{user_id}', [UsersController::class, 'makeAdmin'])
    ->name('users.makeAdmin')
    ->middleware('auth');

Route::put('users/make/agent/{user_id}', [UsersController::class, 'makeAgent'])
    ->name('users.makeAgent')
    ->middleware('auth');


Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations

Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');


// Welcome template

Route::get('test/welcome', function (){

    $user_id = Auth::id();
    $user = User::find($user_id);
    $voucher= Voucher::find(1);
    return new NewRegistrationMarkdown($user,$voucher);

})->name('test.welcome');

Route::get('test/emergency', function (){

    $user_id = Auth::id();
    $user = User::find($user_id);
    $emergency= Emergency::find(1);

    return new NewEmegencyMarkdown($user, $emergency);

})->name('test.emergency');

Route::get('test/detail', function (){

    $user_id = Auth::id();
    $user = User::find($user_id);

    $detail= SecurityDetail::find(1);

    return new NewDetailMarkdown($user, $detail);

})->name('test.details');

Route::get('test/agent', function (){

    $user_id = Auth::id();
    $user = User::find($user_id);
    $detail= SecurityDetail::find(1);
    $agent_user = User::role('agent')->with('agentdetail')->where('id','=',1)->get();

    return new NewAgentMarkdown($user, $detail,$agent_user);

})->name('test.agent');



<?php

namespace App\Http\Controllers;

use App\Models\AgentDetail;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;


class UsersController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        return Inertia::render('Users/Index', [
            'filters' => Request::all('search', 'role'),
            'users' => User::where('primary_role','!=',null)
                ->filter(Request::only('search', 'role'))
                ->get()
                ->transform(function ($user) {
                    return [
                        'id' => $user->id,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'primary_role' => $user->primary_role,
                        'email' => $user->email,
                        'cell_no' => $user->cell_no,
                        'roles'=>(null !== $user) ? ($user->roles->pluck('name')) : (['none']),
                        'permissions'=>(null !== $user) ? ($user->permissions->pluck('name')) : (['none']),
                        'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
                        'deleted_at' => $user->deleted_at,
                    ];
                }),
        ]);
    }

    public function makeAdmin($user_id){

        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        $user_find = User::find($user_id);

        $user_find->assignRole('admin');

        return Redirect::back()->with('success', 'Role updated.');


    }

    public function makeAgent($user_id){

        $user = Auth::user();
        $this->authorize('adminOnly',$user);

        $user_find = User::find($user_id);

        $agent_detail = AgentDetail::find($user_id);

        if ($agent_detail === null){
                 AgentDetail::create([
                'user_id'=>$user_find->id
            ]);

            $user_find->assignRole('agent');

        }


        return Redirect::back()->with('success', 'Role updated.');


    }


    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        Request::validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['nullable'],
            'cell_no' => ['required','digits:10'],
            'photo' => ['nullable', 'image'],
        ]);

        Auth::user()->account->users()->create([
            'first_name' => Request::get('first_name'),
            'last_name' => Request::get('last_name'),
            'email' => Request::get('email'),
            'password' => Request::get('password'),
            'cell_no' => Request::get('cell_no'),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
        ]);

        return Redirect::route('users')->with('success', 'User created.');
    }

    public function edit(User $user)
    {

        $this->authorize('edit-user',$user);


       /* if (Gate::denies('edit-user',$user)){
            abort(403);
        }*/



        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'cell_no' => $user->cell_no,
                'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(User $user)
    {
        if (App::environment('demo') && $user->isDemoUser()) {
            return Redirect::back()->with('error', 'Updating the demo user is not allowed.');
        }

        Request::validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
            'cell_no' => ['required', 'digits:10'],
            'photo' => ['nullable', 'image'],
        ]);

        $user->update(Request::only('first_name', 'last_name', 'email', 'cell_no'));

        if (Request::file('photo')) {
            $user->update(['photo_path' => Request::file('photo')->store('users')]);
        }

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return Redirect::back()->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        if (App::environment('demo') && $user->isDemoUser()) {
            return Redirect::back()->with('error', 'Deleting the demo user is not allowed.');
        }

        $user->delete();

        return Redirect::back()->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }
}

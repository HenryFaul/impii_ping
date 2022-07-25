<?php

namespace App\Http\Controllers;

use App\Models\AgentDetail;
use App\Models\SecurityDetail;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AgentController extends Controller
{
    //

    public function index($user)
    {
        $agent_user = User::role('agent')->with('agentdetail')->where('id','=',$user)->get();

        return Inertia::render('Agent/Edit', [
            'agent_user'=>$agent_user
        ]);
    }

    public function profile($user)
    {
        $agent_user = User::role('agent')->with('agentdetail')->where('id','=',$user)->get();
        $photo_path= $agent_user[0]->photo_path;

        return Inertia::render('Agent/Profile', [
            'agent_user'=>$agent_user,
            'photo' => $photo_path ? URL::route('image', ['path' => $photo_path, 'w' => 200, 'h' => 200, 'fit' => 'crop']) : null,]);
    }

    public function update(Request $request,User $user)
    {

        $agent_detail = $user->agentdetail();

        \Illuminate\Support\Facades\Request::validate([
            'tag_line' => ['required'],
            'accreditations' => ['required'],
            'about_summary' => ['required'],
            'is_available' => ['required'],

        ]);

        $agent_detail->update($request->only('tag_line', 'accreditations', 'about_summary', 'is_available'));

        return Redirect::back()->with('success', 'User updated.');
    }
}

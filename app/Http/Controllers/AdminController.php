<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function index() : View
    {
        $users= User::where('is_admin',0)->get();
        // dd($users);
        return view('users.index',[
            'users'=>User::where('is_admin',0)->get()
        ]);
    }
    public function block(User $user){
        $user->update(['banned_at' => now()-> addMonth()]);
        return redirect()->back()->with('success', 'User is blocked!');
    }
    public function unblock(User $user){
        $user->update(['banned_at' => null]);
        return redirect()->back()->with('success', 'User is unblocked!');
    }

}

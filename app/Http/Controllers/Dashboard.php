<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Dashboard extends Controller
{
    public function index(){
        return view('home');
    }
    function users(){
        $users = User::all();
        return view('pages.user.user',compact('users'));
    }
    function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password_confirmation);
        $user->save();
        return back()->with('succ', 'Content added successfully');

    }
}

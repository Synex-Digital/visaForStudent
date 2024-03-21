<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.profile',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' =>'required',
           ]);
       if($request->old_password){
        if(Hash::check($request->old_password, Auth::user()->password)){
            $request->validate([
                'old_password' => 'required',
                'password' =>'required|confirmed',
                'password_confirmation' =>'required ',
           ]);
           $user->password = Hash::make($request->password_confirmation);
           $user->save();
           return back();
        }
        else{
            return back()->with('notMatch',  'Password Not Match!');
        }
       }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return back()->with('succ', 'User Added Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

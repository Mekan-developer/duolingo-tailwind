<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('pages.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function profileUpdate(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required_with:password_confirmation|min:5|confirmed',
        ]);
        
        if ($request->has('password')) {
            $request->merge(['password' => bcrypt($request->get('password_confirmation'))]);
        }
 
        auth()->user()->update($request->all());
        return redirect()->route('profile.edit')->with('success', trans('profile updated successfully!'));
    }
}

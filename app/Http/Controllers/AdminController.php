<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index(){
        $users = User::where('role',0)->get();
        return view("pages.admin.index",compact("users"));
    }

    public function edit(User $user){
        $users = User::where('role',0)->get();

        $user_edit["edit_user"] = true;
        
        return view("pages.admin.index",compact("user","users","user_edit"));

    }

    public function update(Request $request, User $user){
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::min(5)],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        
        return redirect()->route('admin.controll')->with('success','User updated successfully!');
    }

    public function destroy(User $user){
        $user = $user->delete();
        return redirect()->route('admin.controll')->with('message','Admin deleted successfully!');
    }
}

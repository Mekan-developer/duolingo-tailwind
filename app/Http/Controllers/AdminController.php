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
        $users = User::all();
        return view("pages.admin.index",compact("users"));
    }

    public function edit(User $use){
        $users = User::all();

        $use["edit_user"] = true;
        
        return view("pages.admin.index",compact("use","users"));

    }

    public function update(Request $request, User $user){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        
        return redirect()->route('admin.controll');
    }

    public function destroy(User $user){
        $user = $user->delete();
        return redirect()->route('admin.controll')->with('message','Admin deleted successfully!');
    }
}

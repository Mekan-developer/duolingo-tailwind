<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        return view("pages.admin.index",compact("users"));
    }

    public function destroy(User $user){
        $user = $user->delete();
        return redirect()->route('admin.controll')->with('message','Admin deleted successfully!');
    }
}

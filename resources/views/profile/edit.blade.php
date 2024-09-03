@extends('layouts.main')
@section('content')
<div class="bg-white p-8 rounded-sm shadow-lg w-full">
    <h2 class="text-2xl font-bold text-center mb-6 text-black">Edit profile</h2>
    <form action="#" method="POST" class="w-full">
        <div class="grid grid-cols-2 gap-2 w-full">
            <div class="mb-4 ">
                <label for="username" class="block text-black font-medium mb-2">Username</label>
                <input type="text" id="username" name="username" value="{{auth()->user()->name}}" class="w-full h-[80px] pl-6 p-3 bg-white text-black rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-black font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{auth()->user()->email}}" class="h-[80px] pl-6  w-full p-3 bg-white text-black rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-black font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" class="h-[80px] pl-6 w-full p-3 bg-white text-black rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <label for="confirm_password" class="block text-black font-medium mb-2 text-nowrap">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="h-[80px] pl-6 w-full p-3 bg-white text-black rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>           
        </div>
        <div class="flex justify-center">
            <button type="submit" class="w-full bg-[var(--bg-color-active)] hover:bg-[#43b189] text-white font-bold py-4 px-4 rounded-sm focus:outline-none focus:ring-2">Save Changes</button>
        </div>
    </form>
</div>

@endsection
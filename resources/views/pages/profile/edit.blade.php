@extends('layouts.main')
@section('content')
<div class="bg-white p-8 rounded-sm shadow-lg w-full relative">
    <div class="flex justify-end  gap-4">
        <a href="{{ route('download.database') }}">
            <div class="flex items-center gap-1 p-4 hover:p-[14px] hover:m-[2px] bg-[var(--bg-color-active)] text-white rounded-sm cursor-pointer">
                <span>Backup database</span>
                <i class='bx bxs-download text-[20px]' ></i>
            </div>
        </a>
        <a href="{{ route('download.files') }}">
            <div class="flex items-center gap-1 p-4 hover:p-[14px] hover:m-[2px] bg-[var(--bg-color-active)] text-white rounded-sm">
                <span>Backup files</span>
                <i class='bx bxs-download text-[20px]' ></i>
            </div>
        </a>
    </div>
    <x-form.success/>
    <h2 class="text-2xl font-bold  mb-6 text-[var(--bg-color-active)]">Edit profile</h2>
    <form action="{{route('profile.update')}}" method="POST" class="w-full">
        @csrf
        <div class="grid grid-cols-2 gap-2 w-full">
            <div class="mb-4 ">
                <label for="username" class="block text-black font-medium mb-2">Username</label>
                <input type="text" id="username" name="name" value="{{auth()->user()->name}}" class="w-full h-[80px] pl-6 p-3 bg-white text-black rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <span class="text-xs text-red-600"> {{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-black font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{auth()->user()->email}}" class="h-[80px] pl-6  w-full p-3 bg-white text-black rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <span class="text-xs text-red-600"> {{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-black font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="******" class="h-[80px] pl-6 w-full p-3 bg-white text-black rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <span class="text-xs text-red-600"> {{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="confirm_password" class="block text-black font-medium mb-2 text-nowrap">Confirm Password</label>
                <input type="password" id="confirm_password" name="password_confirmation" placeholder="******" class="h-[80px] pl-6 w-full p-3 bg-white text-black rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password_confirmation')
                    <span class="text-xs text-red-600"> {{ $message }}</span>
                @enderror
            </div>           
        </div>
        <div class="flex justify-center">
            <button type="submit" class="w-full bg-[var(--bg-color-active)] hover:bg-[#43b189] text-white font-bold py-4 px-4 rounded-sm focus:outline-none focus:ring-2">Update profile</button>
        </div>
    </form>
</div>
@endsection
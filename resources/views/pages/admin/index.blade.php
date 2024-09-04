@extends('layouts.main')
@section('content')
<div class="flex flex-col w-full relative">
    <x-form.success/>
    <div class="flex flex-row justify-between w-full">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Users
        </div>
    </div>
    <div class="flex gap-4">
        <div class="flex-1 overflow-x-auto" >
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Name</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Email</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $use)
                    <tr>
                        <td class="px-4 py-2 font-medium text-center text-gray-900 whitespace-nowrap">{{ $use->id }}</td>
                        <td class="px-4 py-2 font-medium text-center text-gray-900 whitespace-nowrap">{{ $use->name }}</td>
                        <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $use->email }}</td>
                        <td class="flex flex-row justify-center gap-2 px-4 py-2 text-center whitespace-nowrap">
                            <a href="{{ route('admin.edit', ['user' => $use->id])}}" > 
                                <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                    <i class='bx bx-edit-alt text-[22px]'></i>
                                </button>
                            </a> 
                            <x-form.delete route="admin.delete" modelName="user" :dataId="$use->id" confirmText="are you sure you want to delete?"/>                       
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mx-2 p-4 pt-0 rounded-lg flex  justify-center w-[400px]">
            <form action="{{ isset($user_edit['edit_user']) ? route('admin.update',['user' => $user->id]) : route('register') }}" method="POST" class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
                @csrf
                @isset($user_edit['edit_user']) @method('patch') @endisset
        
                <h2 class="text-2xl font-bold text-center mb-6 text-black">
                    {{ isset($user_edit['edit_user']) ? 'Edit User' : 'Register User' }}
                </h2>
        
                <!-- Username -->
                <div class="mb-5">
                    <input type="text" name="name" value="{{ isset($user_edit['edit_user']) ? $user->name : old('name') }}" class="w-full p-3 bg-white text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Username" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
        
                <!-- Email -->
                <div class="mb-5">
                    <input type="email" name="email" value="{{ isset($user_edit['edit_user']) ? $user->email : old('email') }}" class="w-full p-3 bg-white text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <!-- Password -->
                <div class="mb-5">
                    <input type="password" name="password" placeholder="Password" class="w-full p-3 bg-white text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <!-- Confirm Password -->
                <div class="mb-6">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full p-3 bg-white text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
        
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-[var(--bg-color-active)] text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        {{ isset($user_edit['edit_user']) ? 'Update' : 'Submit' }}
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection


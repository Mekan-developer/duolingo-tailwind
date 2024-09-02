@extends('layouts.main')
@section('content')
<div class="flex flex-col w-full">
    <div class="flex flex-row justify-between w-full">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Users
        </div>
        <div>
            <div class="flex flex-row-reverse">
                {{-- <a href="#" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 mb-2">+</a> --}}
                {{-- <button  type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg px-5 py-2.5 me-2 mb-2">add</button> --}}
            </div>
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
                        {{-- <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Role</th> --}}
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $use)
                    <tr>
                        <td class="px-4 py-2 font-medium text-center text-gray-900 whitespace-nowrap">{{ $use->id }}</td>
                        <td class="px-4 py-2 font-medium text-center text-gray-900 whitespace-nowrap">{{ $use->name }}</td>
                        <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $use->email }}</td>
                        {{-- <td class="px-4 py-2 text-gray-700 whitespace-nowrap">admin</td> --}}
                        <td class="flex flex-row justify-center gap-2 px-4 py-2 text-center whitespace-nowrap">

                            <a href="{{ route('admin.edit', ['user' => $use->id])}}" > 
                                <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                    <i class='bx bx-edit-alt text-[22px]'></i>
                                </button>
                            </a> 
                            @if(auth()->user()->role == 1)
                            <form action="{{ route('admin.delete', ['user' => $use->id])}}" 
                                method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="inline-block text-lg font-medium text-red-600 rounded hover:text-red-800 ">
                                    <i class='px-3 py-2 rounded-sm bx bx-trash '></i>
                                </button>
                            </form>
                        @endif
                            
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-[var(--bg-color-non-active)] mx-4 p-4 rounded-sm">
            <form action="{{ isset($user_edit['edit_user']) ? route('admin.update',['user' => $user->id]) : route('register') }} " method="POST" class="w-[240px] mx-auto ">
                @csrf
                 @isset($user_edit['edit_user']) @method('patch') @endisset
                <div class="mb-5">
                    <input type="text" name="name" value="{{ isset($user_edit['edit_user']) ? $user->name : old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " placeholder="Tailor" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <input type="email" name="email" value="{{ isset($user_edit['edit_user']) ? $user->email : old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " placeholder="admin@mail.com" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <input type="password" name="password" placeholder="********" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <input type="password" name="password_confirmation" placeholder="********" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <button type="submit" class=" items-end text-white bg-[var(--bg-color-active)] hover:bg-[#2bcee4] focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


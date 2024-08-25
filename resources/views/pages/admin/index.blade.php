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
        <div class="overflow-x-auto flex-1" >
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                        {{-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th> --}}
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr>
                        <td class="text-center whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->email }}</td>
                        {{-- <td class="whitespace-nowrap px-4 py-2 text-gray-700">admin</td> --}}
                        <td class="flex flex-row justify-center gap-2 text-center whitespace-nowrap px-4 py-2">
                            <a href="#" class="inline-block rounded  text-xs font-medium text-white ">
                                <i class='bx bxs-pencil bg-[var(--bg-color-active)] px-3 py-2 rounded-sm hover:bg-[#125768]'></i>
                            </a>
                            @if(auth()->user()->role == 1)
                            <form action="{{ route('admin.delete', ['user' => $user->id])}}" 
                                method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="inline-block rounded  text-xs font-medium text-white ">
                                    <i class='bx bx-trash bg-[var(--bg-color-active)] px-3 py-2 rounded-sm hover:bg-[#fa5151]'></i>
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
            <form action="{{ route('register') }}" method="POST" class="w-[240px] mx-auto ">
                @csrf
                <div class="mb-5">
                    <input type="text" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " placeholder="Tailor" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <input type="email" name="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " placeholder="admin@mail.com" required />
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


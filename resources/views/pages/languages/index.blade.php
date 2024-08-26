@extends('layouts.main')
@section('content')

<div class="flex flex-col w-full">
    <div class="flex flex-row justify-between w-full">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Languages
        </div>
        {{-- <div>
            <div class="flex flex-row-reverse">
                <a href="{{route('language.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 mb-2">+</a>
            </div>
        </div> --}}
    </div>
    <div class="flex gap-4 w-full">
        <div class="overflow-x-auto flex-1" >
            <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">native</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">locale</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">flag</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">status</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">order</th>
                        {{-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th> --}}
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($languages as $language)
                    <tr>
                        <td class="text-center whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $language->name }}</td>
                        <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{ $language->native }}</td>
                        <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{ $language->locale }}</td>
                        <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700 w-[100px] h-auto">
                            <img class="bg-cover" src="{{$language->getFlag()}}" alt="">
                        </td>
                        <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">
                            <form action="{{ route('language.active', ['language' => $language->id])}}" 
                                method="post">
                                @csrf
                                @method('PUT')
                                <label class="inline-flex items-center cursor-pointer relative">
                                    <input type="checkbox" name="status" @if($language->status) checked @endif class="sr-only peer">
                                    <div class="relative w-11 h-6 bg-red-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    <button type="submit" class="w-[45px] h-[25px] absolute top-0"></button>{{-- image activate and disactivate button --}}
                                </label>
                            </form>
                        </td>
                        <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{ $language->order }}</td>
                        <td class="flex flex-row justify-center gap-2 text-center whitespace-nowrap px-4 py-2">
                            <a href="#" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                <i class='bx bx-edit-alt text-[22px]'></i>
                            </a>
                            @if(auth()->user()->role == 1)
                                <form action="{{ route('language.delete', ['language' => $language->id])}}" 
                                    method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-red-600">
                                        <i class='text-[24px] bx bx-trash'></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-[var(--bg-color-non-active)] p-4 rounded-sm w-auto">
            <form action="{{route('language.store')}}" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                  <label for="name" class="block mb-2 text-sm text-gray-600">name</label>
                  <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="name" required>
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-4">
                  <label for="native" class="block mb-2 text-sm text-gray-600">native</label>
                  <input type="text" id="native" name="native" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="native" required>
                  <x-input-error :messages="$errors->get('native')" class="mt-2" />
                </div>
                <div class="mb-4">
                  <label for="locale" class="block mb-2 text-sm text-gray-600">locale</label>
                  <input type="text" id="locale" name="locale" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="ru" required>
                  <x-input-error :messages="$errors->get('locale')" class="mt-2" />
                </div>
                <div class="mb-4">
                  <label for="flag" class="block mb-2 text-sm text-gray-600">flag</label>
                  <input type="file" id="flag" name="flag" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                  <x-input-error :messages="$errors->get('flag')" class="mt-2" />
                </div>
                <button type="submit" class="bg-[var(--bg-color-active)] w-full bg-gradient-to-r  text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2">add language</button>
              </form>
        </div>
    </div>
</div>

@endsection
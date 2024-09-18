@extends('layouts.main')
@section('content')
<div class="relative flex flex-col w-full h-full">
    <x-form.success/> 
    <div class="flex flex-row justify-between w-full">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Languages
        </div>
    </div>
    <div class="flex w-full gap-4">
        <div class="flex-1 overflow-x-auto " >
            <table class="w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">Name</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">native</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">locale</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">flag</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($languages as $language)
                        <tr>
                            <td class="px-4 py-2 text-center text-gray-900 whitespace-nowrap">{{ $language->id }}</td>
                            <td class="px-4 py-2 text-center text-gray-900 whitespace-nowrap">{{ $language->name }}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $language->native }}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $language->locale }}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700 w-[100px] h-auto">
                                <img class="bg-cover w-[60px]" src="{{$language->getFlag()}}" alt="">
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="language.active" modelName="language" :id="$language->id" :currentStatus="$language->status"/>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $language->order }}</td>
                            <td class="flex flex-row justify-center gap-2 px-4 py-2 text-center whitespace-nowrap">
                                <a href="{{ route('language.edit', ['language' => $language->id])}}">
                                    <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                        <i class='bx bx-edit-alt text-[22px]'></i>
                                    </button>
                                </a>
                                <x-form.delete route="language.delete" modelName="language" :dataId="$language->id" confirmText="are you sure you want to delete?"/>
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-[var(--bg-color-non-active)] p-4 rounded-sm w-auto">
            <form  action="{{ isset($lang['edit']) ? route('language.update') : route('language.store') }}" 
            method= "POST" class="w-full" enctype="multipart/form-data" onsubmit="disableButton()">
                @csrf
                @isset($lang['edit']) @method('patch') @endisset
                @isset($lang['edit']) 
                    <input class="hidden" type="number" name="language" value="{{$lng->id}}">
                @endisset
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm text-gray-600">name</label>
                    <input type="text" value="{{ isset($lang['edit']) ? $lng->name : old('name') }}" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="name" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="native" class="block mb-2 text-sm text-gray-600">native</label>
                    <input type="text" id="native" value="{{ isset($lang['edit']) ? $lng->native : old('native') }}"  name="native" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="native" required>
                    <x-input-error :messages="$errors->get('native')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="locale" class="block mb-2 text-sm text-gray-600">locale</label>
                    <input type="text" id="locale" value="{{ isset($lang['edit']) ? $lng->locale : old('locale') }}" name="locale" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="ru" required>
                    <x-input-error :messages="$errors->get('locale')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="flag" class="block mb-2 text-sm text-gray-600">flag</label>
                    <input type="file" id="flag" name="flag" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" {{ isset($lang['edit'])? '' : `required` }} >
                    <x-input-error :messages="$errors->get('flag')" class="mt-2" />
                </div>
                @isset($lang['edit']) 
                    <x-form.order class="order" :request="$languages" :currentOrder="$lng"></x-form.order>
                @endisset
                <x-form.btn-submit name="{{ isset($lang['edit']) ? 'update language' : 'add language' }}" />
            </form>
        </div>
    </div>
</div>
@endsection
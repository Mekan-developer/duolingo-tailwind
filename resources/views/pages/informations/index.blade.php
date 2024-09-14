@extends('layouts.main')
@section('content')

<div class="flex flex-col w-full relative">
    <x-form.success/>
    <div class="flex flex-row justify-between w-full">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Informations
        </div>
        <div>
            <div class="flex flex-row-reverse">
                <a href="{{route('information.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
            </div>
        </div>
    </div>

    <div class="flex gap-4">
        <div class="flex-1 overflow-x-auto" >
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        @foreach($locales as $locale)
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">Information {{ $locale->locale }}</th>
                        @endforeach
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson ids</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">exercise ids</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($informations as $information)
                    <tr>
                        <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$information->id}}</td>
                        @foreach($locales as $locale)
                            <td class="px-4 py-2 text-center text-gray-900 whitespace-nowrap">
                                {!! $information->translate('information', $locale->locale) !!}
                            </td>
                        @endforeach
                        <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ implode(',',json_decode($information->lessons)) }}</td>
                        <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ implode(',',json_decode($information->exercises)) }}</td>
                        <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                            <x-form.status route="information.active" modelName="information" :id="$information->id" :currentStatus="$information->status"/>
                        </td>
                        <td class="flex flex-row justify-center gap-2 px-4 py-2 text-center whitespace-nowrap">
                            <x-form.edit-delete-exercises :editRoute="route('information.edit',['information'=>$information->id])" :deleteRoute="route('information.delete', ['information' => $information->id])" />                                                              
                        </td>
                    </tr> 
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('content')

<div>
    <div class="relative flex flex-col w-full">
        <x-form.success/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Vocabulary (1. Лексика)
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('vocabulary.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>

    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'vocabulary.index','title' => 'vocabulary'])

    <div class="relative flex gap-4">
        <div class="flex-1 overflow-hidden overflow-x-auto overflow-y-auto" >
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">en text</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">audio</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">image</th>
                        @foreach($locales as $locale)
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">translations {{ $locale->locale }}</th>
                        @endforeach
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">exercise</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($vocabularies as $vocabulary)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$vocabulary->id}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$vocabulary->en_text}}</td>
                            <td  class="px-6 py-4 ">
                                <x-admin.audio :getAudio="$vocabulary->getAudio()"/>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <img class="w-[75px] h-auto" src="{{$vocabulary->getImage()}}" alt="vocabulary image">
                            </td>
                            @foreach($locales as $locale)
                                <td class="px-4 py-2 text-center text-gray-900 whitespace-nowrap">
                                    {{ $vocabulary->getTranslation('translations_word',$locale->locale) }}
                                </td>
                            @endforeach
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$vocabulary->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$vocabulary->Lesson->name }}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$vocabulary->Exercise->name }}</td>
                            
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$vocabulary->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="vocabulary.active" modelName="vocabulary" :id="$vocabulary->id" :currentStatus="$vocabulary->status"/>
                            </td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('vocabulary.edit',['vocabulary' => $vocabulary->id])" :deleteRoute="route('vocabulary.delete', ['vocabulary' => $vocabulary->id])" />
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="absolute w-full mt-2 top-full">
        {{$vocabularies->links()}}
    </div>
</div>
@endsection
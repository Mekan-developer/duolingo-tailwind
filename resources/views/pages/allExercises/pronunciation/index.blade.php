@extends('layouts.main')
@section('content')

<div>
    <div class="relative flex flex-col w-full">
        <x-form.success/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Pronunciation (7. Лексика с произношением)
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('pronunciation.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>
    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'pronunciation.index','title' => 'Pronunciation'])
    <div class="relative flex gap-4">
        <div class="flex-1 overflow-hidden overflow-x-auto overflow-y-auto " >
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">audio</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">exercise</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($pronunciations as $pronunciation)
                        <tr class="hover:bg-gray-50">
                            <td class="text-center">{{$pronunciation->id}}</td>
                            <td class="flex justify-center px-6 py-4">
                                <x-admin.audio :getAudio="$pronunciation->getAudio()"/>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$pronunciation->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$pronunciation->Lesson->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$pronunciation->Exercise->name}}</td>
                            
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$pronunciation->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="pronunciation.active" modelName="pronunciation" :id="$pronunciation->id" :currentStatus="$pronunciation->status"/>
                            </td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('pronunciation.edit',['pronunciation'=>$pronunciation->id])" :deleteRoute="route('pronunciation.delete', ['pronunciation' => $pronunciation->id])" />                                                             
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="absolute w-full mt-2 top-full">
            {{$pronunciations->links()}}
        </div>
    </div>
</div>
@endsection
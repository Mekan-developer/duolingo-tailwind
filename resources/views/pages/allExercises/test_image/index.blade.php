@extends('layouts.main')
@section('content')

<div>
    <div class="relative flex flex-col w-full">
        <x-form.success/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Test audio + image  (9. Лексика)
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('testImage.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>
    
    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'testImage.index','title' => 'audio image'])
    <div class="relative flex gap-4">
        <div class="flex-1 overflow-hidden overflow-x-auto overflow-y-auto " >
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">audio</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">correct image</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">incorrect image</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">exercise</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($testImages as $testImage)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $testImage->id }}</td>
                            <td  class="flex justify-center px-6 py-4">
                                <x-admin.audio :getAudio="$testImage->getAudio()"/>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <img src="{{$testImage->getCorrectImage()}}" alt="testImage image">
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <img src="{{$testImage->getIncorrectImage()}}" alt="testImage image">
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$testImage->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$testImage->Lesson->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$testImage->Exercise->name}}</td>
                            
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$testImage->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="testImage.active" modelName="testImage" :id="$testImage->id" :currentStatus="$testImage->status"/>
                            </td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('testImage.edit',['testImage'=>$testImage->id])" :deleteRoute="route('testImage.delete', ['testImage' => $testImage->id])" />                                                              
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="absolute w-full mt-2 top-full">
            {{$testImages->links()}}
        </div>
    </div>
</div>
@endsection
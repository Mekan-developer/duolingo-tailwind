@extends('layouts.main')
@section('content')

<div class="h-[88%]">
    <div class="flex flex-col w-full relative">
        <x-form.success/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Video
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('video.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>

    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'video.index','title' => 'video'])

    <div class="flex gap-4 relative">
        <div class="flex-1 overflow-x-auto overflow-hidden overflow-y-auto  h-[700px] " >
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">video</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">exercise</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($videos as $video)
                        <tr>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$video->id}}</td>
                            <td class="flex justify-center px-4 py-2 text-gray-700 whitespace-nowrap">
                                <video width="130" controls>
                                    <source src="{{$video->getVideo()}}" type="video/mp4">
                                    <source src="{{$video->getVideo()}}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$video->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$video->Lesson->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$video->Exercise->name}}</td>
                            
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$video->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="video.active" modelName="video" :id="$video->id" :currentStatus="$video->status"/>
                            </td>

                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('video.edit',['video' => $video->id])" :deleteRoute="route('video.delete', ['video' => $video->id])" />                                                              
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full absolute top-full mt-2">
            {{$videos->links()}}
        </div>
    </div>
</div>

@endsection
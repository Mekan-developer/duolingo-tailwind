@extends('layouts.main')
@section('content')

<div>
    <div class="flex flex-col w-full">
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Chapters
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('video.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 mb-2">+</a>
                    {{-- <button  type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg px-5 py-2.5 me-2 mb-2">add</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="flex gap-4">
        <div class="overflow-x-auto flex-1" >
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">video</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">chapter</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">lesson</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">exercise</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">order</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($videos as $video)
                        <tr>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">
                                <video width="200" height="150" controls>
                                    <source src="{{$video->getVideo()}}" type="video/mp4">
                                    <source src="{{$video->getVideo()}}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$video->Chapter->translate('title',$locales[0]['locale'])}}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$video->Lesson->translate('title',$locales[0]['locale'])}}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$video->Exercise->translate('title',$locales[0]['locale'])}}</td>
                            
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$video->order}}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$video->status}}</td>

                            <td class="gap-2 text-center whitespace-nowrap px-4 py-2 h-full ">
                                <div class="h-full flex flex-row justify-center gap-2">
                                    <a href="{{route('video.edit',['video'=>$video->id])}}">
                                        <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                            <i class='bx bx-edit-alt text-[22px]'></i>
                                        </button>
                                    </a>
                                    </form>
                                    @if(auth()->user()->role == 1)
                                        <form action="{{ route('video.delete', ['video' => $video->id])}}" 
                                            method="post">
                                            @csrf
                                            @method('DELETE')
    
                                            <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-red-600">
                                                <i class='text-[24px] bx bx-trash'></i>
                                            </button>
                                        </form>
                                    @endif 
                                </div>                                                               
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
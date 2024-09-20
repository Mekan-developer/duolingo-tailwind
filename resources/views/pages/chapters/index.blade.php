@extends('layouts.main')
@section('content')
    <div class="relative flex flex-col w-full h-full">
        <x-form.success/>
        <x-alert/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Chapters
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('chapter.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between h-full">
            <div class="flex-1  overflow-x-auto">
                <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">name</th>                            
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                            <th class="px-4 py-2">actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($chapters as $chapter)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$chapter->id}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$chapter->name}}</td>                           
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$chapter->order}}</td>
                            <td class="flex flex-row justify-center gap-2 px-4 py-2 text-center whitespace-nowrap">
                                <a href="{{route('chapter.edit',['chapter'=>$chapter->id])}}">
                                    <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                        <i class='bx bx-edit-alt text-[22px]'></i>
                                    </button>
                                </a>
                                <x-form.delete route="chapter.delete" modelName="chapter" :dataId="$chapter->id" confirmText="are you sure, It maybe has lessons!"/>                              
                            </td>
                        </tr> 
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="top-full w-full my-2 ">
                {{$chapters->links()}}
            </div>
        </div>

    </div>
@endsection
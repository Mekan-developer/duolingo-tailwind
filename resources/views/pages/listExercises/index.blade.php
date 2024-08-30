@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full">
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Exercises
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('list.exercises.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
        {{-- <div class="flex justify-between">
            <form method="GET" action="{{ route('list.exercises') }}" class="flex items-center space-x-4 mb-2">
                <select name="sort_by_chapter" id="sort_by_chapter" onchange="this.form.submit()" 
                        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="0"  {{ request('sort_by_chapter') == '0' ? 'selected' : '' }}>Select for ordering</option>
                    @foreach ($chapters as $chapter)
                        <option value="{{ $chapter->id }}" {{ request('sort_by_chapter') == $chapter->id ? 'selected' : '' }}>
                            {{ $chapter->getTranslation('title', $locales[0]['locale']) }}
                        </option>
                    @endforeach                
                </select>
            </form>

            <form method="GET" action="{{ route('list.exercises') }}" class="flex items-center space-x-4 mb-2">
                <select name="sort_by_lesson" id="sort_by" onchange="this.form.submit()" 
                        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="0"  {{ request('sort_by') == '0' ? 'selected' : '' }}>Select for ordering</option>
                    @foreach ($lessons as $lesson)
                        <option value="{{ $lesson->id }}" {{ request('sort_by') == $lesson->id ? 'selected' : '' }}>
                            {{ $lesson->getTranslation('title', $locales[0]['locale']) }}
                        </option>
                    @endforeach                
                </select>
            </form>
        </div> --}}
        
        <div class="flex gap-4">
            <div class="overflow-x-auto flex-1 min-h-[700px] relative" >
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">id</th>
                            @foreach($locales as $locale)
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">title {{ $locale->locale }}</th>
                            @endforeach
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">parent lesson</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">order</th>
                            <th class="px-4 py-2">actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($list_exercises as $list_exercise)
                        <tr>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$list_exercise->id}}</td>
                            @foreach($locales as $locale)
                                <td class="text-center whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    {{ $list_exercise->getTranslation('title', $locale->locale) }}
                                </td>
                            @endforeach
                            
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$list_exercise->lesson->getTranslation('title',$locales[0]['locale'])}}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$list_exercise->order}}</td>
                            <td class="flex flex-row justify-center gap-2 text-center whitespace-nowrap px-4 py-2">
                                <form action="{{route('list.exercises.edit',['exercise'=>$list_exercise->id])}}" 
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                        <i class='bx bx-edit-alt text-[22px]'></i>
                                    </a>
                                </form>

                                @if(auth()->user()->role == 1)
                                    <form action="{{ route('list.exercises.delete', ['list_exercise' => $list_exercise->id])}}" 
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
                <div class="w-full absolute bottom-0">
                    {{$list_exercises->links()}}
                </div>
            </div>
        </div>

    </div>
@endsection
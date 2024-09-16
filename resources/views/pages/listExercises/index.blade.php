@extends('layouts.main')
@section('content')
    <div class="relative flex flex-col w-full">
        <x-form.success/>
        <x-alert/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] text-[22px]">
                Exercises
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('list.exercises.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <form method="GET" action="{{ route('list.exercises') }}" class="flex-1 mb-2 space-x-4">
                <select name="sort_by_chapter" id="sort_by" onchange="this.form.submit()" 
                        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="0"  {{ request('sort_by_chapter') == '0' ? 'selected' : '' }}>Select for ordering exercises by chapter</option>
                    @foreach ($chapters as $chapter) 
                        @if($selected_chapter_id !== null)
                            <option value="{{ $chapter->id }}" {{ $selected_chapter_id == $chapter->id ? 'selected' : '' }}>
                                {{ $chapter->name }}
                            </option>
                        @else
                            <option value="{{ $chapter->id }}" {{ (request('sort_by_chapter') == $chapter->id || $selected_chapter_id == $chapter->id ) ? 'selected' : '' }}>
                                {{ $chapter->name }}
                            </option>
                        @endif
                    @endforeach                
                </select>
            </form>

            @if(count($lessons)>0 and (request('sort_by_chapter') || $selected_chapter_id !== null))
                <form method="GET" action="{{ route('list.exercises') }}" class="flex-1 mb-2 space-x-4 ">
                    <select name="sort_by_lesson" id="sort_by" onchange="this.form.submit()" 
                            class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="0"  {{ request('sort_by_lesson') == '0' ? 'selected' : '' }}>Select for ordering exercises by lessons</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ request('sort_by_lesson') == $lesson->id ? 'selected' : '' }}>
                                {{ $lesson->name }}
                            </option>
                        @endforeach                
                    </select>
                </form>
            @endif
        </div>
        <div class="flex gap-4">
            <div class="overflow-x-auto  flex-1 min-h-[700px] relative" >
                <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">name</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">parent chapter</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">parent lesson</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($list_exercises as $list_exercise)
                        <tr>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$list_exercise->id}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$list_exercise->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $list_exercise->chapter->name }}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $list_exercise->lesson->name }}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$list_exercise->order}}</td>
                            <td class="flex flex-row justify-center gap-2 px-4 py-2 text-center whitespace-nowrap">
                                <a href="{{route('list.exercises.edit',['list_exercise'=>$list_exercise->id])}}">
                                    <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                        <i class='bx bx-edit-alt text-[22px]'></i>
                                    </button>
                                </a>
                                <x-form.delete route="list.exercises.delete" modelName="list_exercise" :dataId="$list_exercise->id" confirmText="are you sure you want to delete?"/>                               
                            </td>
                        </tr> 
                    @endforeach
                    </tbody>
                </table>
                <div class="absolute bottom-0 w-full">
                    {{$list_exercises->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
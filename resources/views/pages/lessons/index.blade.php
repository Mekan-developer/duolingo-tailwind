@extends('layouts.main')
@section('content')
    <div class="relative flex flex-col w-full h-full">
        <x-form.success/>
        <x-alert/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Lessons
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('lessons.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <form method="GET" action="{{ route('lessons') }}" class="flex items-center mb-2 space-x-4">
                <select name="sort_by" id="sort_by" onchange="this.form.submit()" 
                        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="0"  {{ request('sort_by') == '0' ? 'selected' : '' }}>Select for ordering lessons by chapter</option>
                    @foreach ($chapters as $chapter)
                        <option value="{{ $chapter->id }}" {{ request('sort_by') == $chapter->id ? 'selected' : '' }}>
                            {{ $chapter->name }}
                        </option>
                    @endforeach                
                </select>
            </form>
        </div>        
        <div class="flex flex-col justify-between h-full">
            <div class="flex-1  overflow-x-auto" >
                <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">name</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">parent chapter</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                            <th class="px-4 py-2">actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($lessons as $lesson)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$lesson->id}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$lesson->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $lesson->chapter->name }}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$lesson->order}}</td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <div class="flex flex-row justify-center h-full gap-2">
                                    <a href="{{route('lessons.edit',['lesson'=>$lesson->id])}}">
                                        <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                            <i class='bx bx-edit-alt text-[22px]'></i>
                                        </button>
                                    </a>
                                    <x-form.delete route="lesson.delete" modelName="lesson" :dataId="$lesson->id" confirmText="are you sure you want to delete?"/>
                                </div>                              
                            </td>
                        </tr> 
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="top-full w-full my-2">
                {{$lessons->links()}}
            </div>
        </div>
    </div>
@endsection
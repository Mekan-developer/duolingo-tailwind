@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full">
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Lessons
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('lessons.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 mb-2">+</a>
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
                            {{ $chapter->getTranslation('title', $locales[0]['locale']) }}
                        </option>
                    @endforeach                
                </select>
            </form>
        </div>        
        
        <div class="flex gap-4">
            <div class="flex-1 overflow-x-auto min-h-[700px] relative" >
                <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">id</th>
                            @foreach($locales as $locale)
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">title {{ $locale->locale }}</th>
                            @endforeach
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">dopamine1</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">dopamine2</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">dopamine3</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">dopamine4</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">parent chapter</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">order</th>
                            <th class="px-4 py-2">actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($lessons as $lesson)
                        <tr>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$lesson->id}}</td>
                            @foreach($locales as $locale)
                                <td class="px-4 py-2 font-medium text-center text-gray-900 whitespace-nowrap">
                                    {{ $lesson->getTranslation('title', $locale->locale) }}
                                </td>
                            @endforeach
                            
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <img src="{{$lesson->getDopamine($lesson->dopamine_image_1)}}" alt="dopamine 1">
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <img src="{{$lesson->getDopamine($lesson->dopamine_image_2)}}" alt="dopamine 1">
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <img src="{{$lesson->getDopamine($lesson->dopamine_image_3)}}" alt="dopamine 1">
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <img src="{{$lesson->getDopamine($lesson->dopamine_image_4)}}" alt="dopamine 1">
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $lesson->chapter->getTranslation('title',$locales[0]['locale']) }}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$lesson->order}}</td>
                            <td class="flex flex-row items-center justify-center h-full gap-2 px-4 py-2 whitespace-nowrap">
                                <a href="{{route('lessons.edit',['lesson'=>$lesson->id])}}">
                                    <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                        <i class='bx bx-edit-alt text-[22px]'></i>
                                    </button>
                                </a>
                                @if(auth()->user()->role == 1)
                                    <form action="{{ route('lesson.delete', ['lesson' => $lesson->id])}}" 
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
                    {{$lessons->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
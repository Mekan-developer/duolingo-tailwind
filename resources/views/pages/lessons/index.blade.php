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
        <form method="GET" action="{{ route('lessons') }}" class="flex items-center space-x-4 mb-2">
            <select name="sort_by" id="sort_by" onchange="this.form.submit()" 
                    class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="0"  {{ request('sort_by') == '0' ? 'selected' : '' }}>Select for ordering</option>
                @foreach ($chapters as $chapter)
                    <option value="{{ $chapter->id }}" {{ request('sort_by') == $chapter->id ? 'selected' : '' }}>
                        {{ $chapter->getTranslation('title', $locales[0]['locale']) }}
                    </option>
                @endforeach                
            </select>
        </form>
        
        <div class="flex gap-4">
            <div class="overflow-x-auto flex-1" >
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            @foreach($locales as $locale)
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">title {{ $locale->locale }}</th>
                            @endforeach
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">dopamine1</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">dopamine2</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">dopamine3</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">dopamine4</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">parent chapter</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">order</th>
                            <th class="px-4 py-2">actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($lessons as $lesson)
                        <tr>
                            @foreach($locales as $locale)
                                <td class="text-center whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    {{ $lesson->getTranslation('title', $locale->locale) }}
                                </td>
                            @endforeach
                            
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">
                                <img src="{{$lesson->getDopamine($lesson->dopamine_image_1)}}" alt="dopamine 1">
                            </td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">
                                <img src="{{$lesson->getDopamine($lesson->dopamine_image_2)}}" alt="dopamine 1">
                            </td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">
                                <img src="{{$lesson->getDopamine($lesson->dopamine_image_3)}}" alt="dopamine 1">
                            </td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">
                                <img src="{{$lesson->getDopamine($lesson->dopamine_image_4)}}" alt="dopamine 1">
                            </td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{ $lesson->chapter->getTranslation('title',$locales[0]['locale']) }}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$lesson->order}}</td>
                            <td class="flex flex-row justify-center gap-2 text-center whitespace-nowrap px-4 py-2">
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
            </div>
        </div>
    </div>
@endsection
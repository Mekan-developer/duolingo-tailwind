@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full">
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Chapters
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('chapter.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 mb-2">+</a>
                    {{-- <button  type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg px-5 py-2.5 me-2 mb-2">add</button> --}}
                </div>
            </div>
        </div>
        <div class="flex gap-4">
            <div class="overflow-x-auto flex-1" >
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            @foreach($locales as $locale)
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">title {{ $locale->locale }}</th>
                            @endforeach
                            
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">order</th>
                            {{-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th> --}}
                            <th class="px-4 py-2">actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($chapters as $chapter)
                        <tr>
                            @foreach($locales as $locale)
                                <td class="text-center whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    {{ $chapter->getTranslation('title', $locale->locale) }}
                                </td>
                            @endforeach
                            
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$chapter->order}}</td>
                            {{-- <td class="whitespace-nowrap px-4 py-2 text-gray-700">admin</td> --}}
                            <td class="flex flex-row justify-center gap-2 text-center whitespace-nowrap px-4 py-2">
                                <a href="#" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                    <i class='bx bx-edit-alt text-[22px]'></i>
                                </a>
                                @if(auth()->user()->role == 1)
                                    <form action="{{ route('chapter.delete', ['chapter' => $chapter->id])}}" 
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
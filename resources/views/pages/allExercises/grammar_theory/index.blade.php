@extends('layouts.main')
@section('content')

<div>
    <div class="relative flex flex-col w-full">
        <x-form.success/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Grammar theory and practics (8. Грамматика)
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('grammar.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>
    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'grammar.index','title' => 'grammar'])
    <div class="relative flex gap-4">
        <div class="flex-1 overflow-hidden overflow-x-auto overflow-y-auto ">
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>         
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">grammar_theory</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">text</th>
                        <th class="px-4 py-2 text-gray-900 border-r-2 whitespace-nowrap">audio</th>
                        @for ($i = 1; $i <= $textPartCounts; $i++)
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">text correct part {{$i}}</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">text incorrect part {{$i}}</th>
                        @endfor
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">exercise</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($grammars as $grammar)
                        <tr>
                            <td class="text-center">{{$grammar->id}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{!! $grammar->translate('grammar_theory',$locales[0]['locale']) !!}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{!! $grammar->translate('text',$locales[0]['locale']) !!}</td>
                            <td class="flex justify-center px-4 py-2 border-r-2">
                                <div data-audio-src="{{ $grammar->getSound($grammar->audio) }}" class="text-white rounded-lg shadow-lg audio-player w-[200px]" >
                                    <div class="flex flex-row items-center justify-between ">
                                            <div class="flex items-center justify-center p-3 text-gray-800 bg-cover rounded-sm playPauseBtn hover:text-[var(--bg-color-active)] focus:outline-none">
                                               <span class="hidden pauseIcon">
                                                    <i class='bx bx-pause text-[28px]'></i>
                                                </span> 
                                                <span class="playIcon">
                                                    <i class='bx bx-play-circle text-[28px] opacity-60'></i>
                                                </span>
                                            </div>
                                        <div class="items-start flex-1 pl-4">
                                            <p class="text-sm text-gray-400 text-nowrap">test</p>
                                            <div class="relative text-gray-400">
                                                <input type="range" min="0" max="100" value="0" class="w-full h-2 bg-gray-400 rounded-lg appearance-none cursor-pointer progressBar">
                                                <span class="currentTime">00:00</span> / <span class="duration">00:00</span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @for ($i = 1; $i <= $textPartCounts; $i++)
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                @if(!empty($grammar->translate('text_correct_parts',$i)))
                                    {{$grammar->translate('text_correct_parts',$i)}}
                                @else 
                                    ---
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                @if(!empty($grammar->translate('text_incorrect_parts',$i)))
                                    {{$grammar->translate('text_incorrect_parts',$i)}}
                                @else 
                                    ---
                                @endif
                            </td>
                            @endfor
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$grammar->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$grammar->Lesson->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$grammar->Exercise->name}}</td>
                            
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$grammar->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="grammar.active" modelName="grammar" :id="$grammar->id" :currentStatus="$grammar->status"/>
                            </td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('grammar.edit',['grammar'=>$grammar->id])" :deleteRoute="route('grammar.delete', ['grammar' => $grammar->id])" />                                                              
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="absolute w-full mt-2 top-full">
            {{$grammars->links()}}
        </div>
    </div>
</div>
@endsection
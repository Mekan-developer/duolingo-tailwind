@extends('layouts.main')
@section('content')

<div>
    <div class="flex flex-col w-full relative">
        <x-form.success/>
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Question word (3.Лексика)
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('questionWord.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>
    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'questionWord.index','title' => 'question word'])

    <div class="flex gap-4 relative">
        <div class="flex-1 overflow-x-auto overflow-hidden overflow-y-auto ">
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">en text</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">audio</th>
                        @foreach($locales as $locale)
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">correct translations {{ $locale->locale }}</th>
                            <th class="px-4 py-2 text-gray-900 whitespace-nowrap">incorrect translations {{ $locale->locale }}</th>
                        @endforeach
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">exercise</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($questionWords as $question)
                        <tr class="hover:bg-gray-50"> 
                            <td class="text-center"> {{$question->id}} </td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$question->en_text}}</td>
                            <td  class="px-6 py-4 ">
                                <x-admin.audio :getAudio="$question->getAudio()"/>
                            </td>
                            @foreach($locales as $locale)
                                <td class="px-4 py-2 text-center text-gray-900 whitespace-nowrap">
                                    {{ $question->getTranslation('translation_correct_words',$locale->locale) }}
                                </td>
                                <td class="px-4 py-2 text-center text-gray-900 whitespace-nowrap">
                                    {{ $question->getTranslation('translation_incorrect_words',$locale->locale) }}
                                </td>
                            @endforeach

                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$question->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$question->Lesson->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$question->Exercise->name}}</td>
                            
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$question->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="questionWord.active" modelName="questionWord" :id="$question->id" :currentStatus="$question->status"/>
                            </td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('questionWord.edit',['questionWord' => $question->id])" :deleteRoute="route('questionWord.delete', ['questionWord' => $question->id])" />                                                             
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full absolute top-full mt-2">
            {{$questionWords->links()}}
        </div>
    </div>
</div>
@endsection
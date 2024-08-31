<div class="grid grid-cols-3 gap-4">
    <form method="GET" action="{{ route($route) }}" class="flex-1 space-x-4 mb-2">
        <select name="sort_by_chapter" id="sort_by" onchange="this.form.submit()" 
                class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="0"  {{ request('sort_by_chapter') == '0' ? 'selected' : '' }}>Select for ordering {{ $title }} by chapter</option>
            @foreach ($chapters as $chapter)
                @if($selected_chapter_id !== null)
                    <option value="{{ $chapter->id }}" {{ $selected_chapter_id == $chapter->id ? 'selected' : '' }}>
                        {{ $chapter->getTranslation('title', $locales[0]['locale']) }}
                    </option>
                @else
                    <option value="{{ $chapter->id }}" {{ (request('sort_by_chapter') == $chapter->id || $selected_chapter_id == $chapter->id ) ? 'selected' : '' }}>
                        {{ $chapter->getTranslation('title', $locales[0]['locale']) }}
                    </option>
                @endif
            @endforeach                
        </select>
    </form>

    @if((request('sort_by_chapter') || $selected_chapter_id !== null) && $lessons->isNotEmpty())
        <form method="GET" action="{{ route($route) }}" class="flex-1 space-x-4 mb-2 ">
            <select name="sort_by_lesson" id="sort_by_lesson" onchange="this.form.submit()" 
                    class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="0"  {{ request('sort_by_lesson') == '0' ? 'selected' : '' }}>Select for ordering {{ $title }} by lesson</option>
                @foreach ($lessons as $lesson)
                    @if($selected_lesson_id !== null)
                        <option value="{{ $lesson->id }}" {{ $selected_lesson_id == $lesson->id ? 'selected' : '' }}>
                            {{ $lesson->getTranslation('title', $locales[0]['locale']) }}
                        </option>
                    @else
                        <option value="{{ $lesson->id }}" {{ (request('sort_by_lesson') == $lesson->id || $selected_lesson_id == $lesson->id ) ? 'selected' : '' }}>
                            {{ $lesson->getTranslation('title', $locales[0]['locale']) }}
                        </option>
                    
                    @endif
                @endforeach                
            </select>
        </form>
    @endif

    @if((request('sort_by_lesson') || $selected_lesson_id !== null) && $lessons->isNotEmpty())
        <form method="GET" action="{{ route($route) }}" class="flex-1 space-x-4 mb-2 ">
            <select name="sort_by_exercise" id="sort_by_exercise" onchange="this.form.submit()" 
                    class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="0"  {{ request('sort_by_exercise') == '0' ? 'selected' : '' }}>Select for ordering {{ $title }} by exercise</option>
                @foreach ($listExercises as $listExercise)
                    <option value="{{ $listExercise->id }}" {{ request('sort_by_exercise') == $listExercise->id ? 'selected' : '' }}>
                        {{ $listExercise->getTranslation('title', $locales[0]['locale']) }}
                    </option>
                @endforeach                
            </select>
        </form>
    @endif
</div>
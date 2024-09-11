<div class="z-10 bg-white rounded-md shadow w-full ">
    <div class="p-3">
      <label for="input-group-search" class="sr-only">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
        </div>
        <input type="text"  wire:model.live.debounce.500ms="queryExercise" class="bg-gray-50 border border-gray-300 text-[#57BE99] text-sm rounded-lg focus:ring-[#57BE99] focus:border-[#57BE99] block w-full ps-10 p-2.5 " placeholder="Search user">
      </div>
    </div>
    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200 scroll-container" >
      @if(isset($exercises) && $exercises != "")
        @php $noRepeat=0; @endphp
        @foreach ($exercises as $exercise)
          @if($exercise->lesson_id != $noRepeat)
              <div class="text-[#57BE99] w-full text-center">{{$exercise->lesson->name}}</div>
              @php $noRepeat = $exercise->lesson_id; @endphp
          @endif
          <li>
            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
              <input id="checkbox-item-{{$exercise->created_at}}" name="exercise_ids[]" wire:model="exercise_ids" type="checkbox" value="{{$exercise->id}}" class="w-4 h-4 text-[#57BE99] bg-gray-100 border-gray-300 rounded focus:ring-[#57BE99]">
              <label for="checkbox-item-{{$exercise->created_at}}" class="w-full ms-2 text-sm font-medium text-[#57BE99] rounded dark:text-gray-300">{{ $exercise->name }}</label>
            </div>
          </li>
        @endforeach

      @endif
    </ul>
</div>
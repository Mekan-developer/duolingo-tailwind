<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add Lesson
        </div>
        <form action="{{route('list.exercises.store')}}" method="post" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6">
            @csrf
            <div class="px-4 rounded-sm">
                <div class="flex flex-row w-full gap-6 px-2 py-6 bg-white">
                    <div class="w-full">
                        <x-form.select-chapter :chapters="$chapters" :locales="$locales" />
                    </div>
                    <div class="w-full">
                        <x-form.select-lesson :lessons="$lessons" :locales="$locales" />
                    </div>
                </div>                
            </div>
            <div class="px-4">
                <x-form.input name="name" placeholder="exercise name" labelText="exercise name" :errorMessage="$errors->get('name')" />
                {{-- @foreach ($locales as $locale)
                    <x-form.input :name="'title['.$locale->locale.']'" :placeholder="'Exercise '. $locale->locale" :labelText="'Exercise '. $locale->name" :errorMessage="$errors->get('title.' . $locale->locale)" />
                @endforeach --}}
                <x-form.btn-submit/>
            </div>
        </form>
    </div>
</div>

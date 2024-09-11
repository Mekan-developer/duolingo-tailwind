<div>
    @props([
        'editRoute','deleteRoute'
    ])
    <div class="flex flex-row justify-center h-full gap-2">
        <a href="{{$editRoute}}">
            <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                <i class='bx bx-edit-alt text-[22px]'></i>
            </button>
        </a>
        </form>
        @if(auth()->user()->role == 1)
            <form action="{{$deleteRoute}}" 
                method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-red-600">
                    <i class='text-[24px] bx bx-trash'></i>
                </button>
            </form>
        @endif  
    </div> 
</div>
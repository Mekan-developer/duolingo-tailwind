<div class="flex-1">
    @props([
        'name'
    ])
    <button type="submit" 
    {{ $attributes->merge(['class' => 'w-full py-4 bg-yellow-400 rounded-sm text-white text-[18px] ']) }}
    > @if(isset($name)){{$name}} @else cancel @endif </button>
</div>
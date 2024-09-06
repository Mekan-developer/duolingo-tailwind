@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-xs text-red-600']) }}>
        @foreach ((array) $messages as $message)
            <span>{{ $message }}</span>
        @endforeach
    </div>
@endif

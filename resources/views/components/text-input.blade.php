@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 font-normal focus:border-[var(--bg-color-active)] focus:ring-indigo-500 rounded-md shadow-sm']) !!}>

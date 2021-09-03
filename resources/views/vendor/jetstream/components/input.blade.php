@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm']) !!}>

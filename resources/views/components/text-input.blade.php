@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-2 border-amber-900 border-solid bg-transparent focus:border-gray-800 focus:ring-gray-300 rounded-md shadow-sm']) }}>

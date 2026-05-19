@props(['type' => 'button', 'color' => 'blue'])

@php
$colorMap = [
    'blue' => '#2563eb',
    'green' => '#16a34a',
    'red' => '#dc2626',
    'yellow' => '#ca8a04',
    'orange' => '#ff8000',
];
$bgColor = $colorMap[$color] ?? $colorMap['blue'];
@endphp

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'fancy-button']) }}
    style="--color-back: {{ $bgColor }};"
>
    <span class="fancy-text text-gray-700">{{ $slot }}</span>
</button>

<style>
.fancy-button {
    background: var(--color-back);
    border-radius: 0.5em;
    box-shadow:
        inset 0px -6px 18px -6px rgba(3, 15, 20, 0),
        inset rgba(54, 69, 75, 1) -1px -1px 6px 0px,
        inset 12px 0px 12px -6px rgba(3, 15, 20, 0),
        inset -12px 0px 12px -6px rgba(3, 15, 20, 0),
        rgba(54, 69, 75, 1) -1px -1px 6px 0px;
    border: solid 2px #030f14;
    cursor: pointer;
    font-size: 14px;
    padding: 0.5em 1em;
    outline: none;
    transition: all 0.3s;
    user-select: none;
    width: 100%;
}

.fancy-button:hover {
    box-shadow:
        inset 0px -6px 18px -6px rgba(3, 15, 20, 1),
        inset 0px 6px 18px -6px rgba(3, 15, 20, 1),
        inset 12px 0px 12px -6px rgba(3, 15, 20, 0),
        inset -12px 0px 12px -6px rgba(3, 15, 20, 0),
        -1px -1px 6px 0px rgba(54, 69, 75, 1);
}

.fancy-button:active {
    box-shadow:
        inset 0px -12px 12px -6px rgba(3, 15, 20, 1),
        inset 0px 12px 12px -6px rgba(3, 15, 20, 1),
        inset 12px 0px 12px -6px rgba(3, 15, 20, 1),
        inset -12px 0px 12px -6px rgba(3, 15, 20, 1),
        -1px -1px 6px 0px rgba(54, 69, 75, 1);
}

.fancy-text {
    /* color: #d0a756; */
    font-weight: 700;
    margin: auto;
    transition: all 0.3s;
    width: fit-content;
    display: block;
}

.fancy-button:hover .fancy-text {
    transform: scale(0.9);
}

.fancy-button:active .fancy-text {
    transform: scale(0.8);
}
</style>
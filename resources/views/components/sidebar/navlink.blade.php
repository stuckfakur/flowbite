@props(['active', 'title', 'badge' => false, 'badgeName'])

@php
    $classes = ($active ?? false)
                ? 'flex items-center p-2 text-base-100 rounded-lg text-white bg-blue-600 hover:bg-blue-700 group'
                : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }} >
        {{ $slot }}
        <span class="flex-1 ms-3 whitespace-nowrap">{{ $title }}</span>
    @if($badge)
            <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $badgeName ?? '' }}</span>
        @endif
    </a>
</li>

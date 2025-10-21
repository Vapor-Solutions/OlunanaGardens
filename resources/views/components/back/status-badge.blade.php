{{-- Status Badge Component --}}
@props([
    'status' => 'pending',
    'size' => 'md',
    'showText' => true,
])

@php
    $statusConfig = [
        'pending' => [
            'bg' => 'bg-warning',
            'text' => 'Pending',
            'icon' => 'clock',
            'title' => 'Awaiting confirmation',
        ],
        'confirmed' => [
            'bg' => 'bg-success',
            'text' => 'Confirmed',
            'icon' => 'check-circle',
            'title' => 'Confirmed and scheduled',
        ],
        'cancelled' => [
            'bg' => 'bg-danger',
            'text' => 'Cancelled',
            'icon' => 'x-circle',
            'title' => 'Booking cancelled',
        ],
        'completed' => [
            'bg' => 'bg-secondary',
            'text' => 'Completed',
            'icon' => 'check-square',
            'title' => 'Event completed',
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['pending'];
    $sizeClass = match($size) {
        'sm' => 'px-2 py-1 text-xs',
        'lg' => 'px-4 py-2 text-base',
        default => 'px-3 py-1.5 text-sm',
    };
@endphp

<span
    class="inline-flex items-center gap-2 {{ $config['bg'] }} text-white rounded-full {{ $sizeClass }} font-medium"
    title="{{ $config['title'] }}"
>
    <i data-feather="{{ $config['icon'] }}" style="width: 16px; height: 16px;"></i>
    @if($showText)
        <span>{{ $config['text'] }}</span>
    @endif
</span>

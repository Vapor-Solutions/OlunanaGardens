{{-- Dashboard Metric Card Component --}}
@props([
    'title' => '',
    'value' => '0',
    'icon' => 'trending-up',
    'color' => 'primary',
    'icon_bg' => false,
])

<div class="card h-100 border-0 shadow-sm o-hidden">
    <div class="bg-{{ $color }} b-r-4 card-body">
        <div class="media static-top-widget" wire:ignore>
            <!-- Icon -->
            <div class="align-self-center text-center text-white">
                <i data-feather="{{ $icon }}" style="width: 32px; height: 32px;"></i>
            </div>

            <!-- Content -->
            <div class="media-body">
                <span class="m-0 text-white text-opacity-75">{{ $title }}</span>
                <h4 class="mb-0 text-white font-weight-bold">
                    {{ $value }}
                </h4>

                <!-- Background Icon -->
                @if ($icon_bg)
                    <i class="icon-bg text-white text-opacity-10" data-feather="{{ $icon }}"></i>
                @endif
            </div>
        </div>
    </div>
</div>

@props(['submit'])

<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-md-4">
        <x-back.section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">
                <span class="small">
                    {{ $description }}
                </span>
            </x-slot>
        </x-back.section-title>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <form wire:submit="{{ $submit }}">
                <div class="card-body">
                {{ $form }}
                </div>

                @if (isset($actions))
                    <div class="card-footer d-flex justify-content-end">
                        {{ $actions }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

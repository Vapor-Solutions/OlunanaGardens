<x-back.form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="w-md-75">
            <div class="mb-3">
                <x-back.label for="current_password" value="{{ __('Current Password') }}" />
                <x-back.input id="current_password" type="password" class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                             wire:model="state.current_password" autocomplete="current-password" />
                <x-back.input-error for="current_password" />
            </div>

            <div class="mb-3">
                <x-back.label for="password" value="{{ __('New Password') }}" />
                <x-back.input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                             wire:model="state.password" autocomplete="new-password" />
                <x-back.input-error for="password" />
            </div>

            <div class="mb-3">
                <x-back.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-back.input id="password_confirmation" type="password" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                             wire:model="state.password_confirmation" autocomplete="new-password" />
                <x-back.input-error for="password_confirmation" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-back.button>
            <div wire:loading class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

            {{ __('Save') }}
        </x-back.button>
    </x-slot>
</x-back.form-section>

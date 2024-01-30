<x-guest-layout>
    <x-back.authentication-card>
        <x-slot name="logo">
            <x-back.authentication-card-logo />
        </x-slot>

        <div class="card-body">

            <div class="mb-3 text-sm text-muted">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <x-back.validation-errors class="mb-2" />

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div>
                    <x-back.label for="password" value="{{ __('Password') }}" />
                    <x-back.input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <x-back.button class="ms-4">
                        {{ __('Confirm') }}
                    </x-back.button>
                </div>
            </form>
        </div>
    </x-back.authentication-card>
</x-guest-layout>

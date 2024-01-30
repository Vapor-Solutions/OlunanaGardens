<x-guest-layout>
    <x-back.authentication-card>
        <x-slot name="logo">
            <x-back.authentication-card-logo />
        </x-slot>

        <div class="card-body">

            <x-back.validation-errors class="mb-3" />

            <form method="POST" action="/reset-password">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <x-back.label value="{{ __('Email') }}" />

                    <x-back.input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email', $request->email)" required autofocus />
                    <x-back.input-error for="email"></x-back.input-error>
                </div>

                <div class="mb-3">
                    <x-back.label value="{{ __('Password') }}" />

                    <x-back.input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-back.input-error for="password"></x-back.input-error>
                </div>

                <div class="mb-3">
                    <x-back.label value="{{ __('Confirm Password') }}" />

                    <x-back.input class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password"
                                 name="password_confirmation" required autocomplete="new-password" />
                    <x-back.input-error for="password_confirmation"></x-back.input-error>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end">
                        <x-back.button>
                            {{ __('Reset Password') }}
                        </x-back.button>
                    </div>
                </div>
            </form>
        </div>
    </x-back.authentication-card>
</x-guest-layout>

<x-guest-layout>

    <x-back.authentication-card>
        <x-slot name="logo">
            <x-back.authentication-card-logo />
        </x-slot>

        <x-back.validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <x-back.label value="{{ __('Name') }}" />

                    <x-back.input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" />
                    <x-back.input-error for="name"></x-back.input-error>
                </div>

                <div class="mb-3">
                    <x-back.label value="{{ __('Email') }}" />

                    <x-back.input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
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

                    <x-back.input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <x-back.checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-back.button>
                            {{ __('Register') }}
                        </x-back.button>
                    </div>
                </div>
            </form>
        </div>
    </x-back.authentication-card>
</x-guest-layout>

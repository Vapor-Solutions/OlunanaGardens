<x-guest-layout>
    <x-back.authentication-card>
        <x-slot name="logo">
            <x-back.authentication-card-logo />
            {{-- <a class="d-flex justify-content-center mb-4" href="/">
                <img src="/company_logo.png" width="59.98" height="59.98" alt="">
            </a> --}}

        </x-slot>

        <div class="card-body">

            <x-back.validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <x-back.label value="{{ __('Email') }}" />

                    <x-back.input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                        :value="old('email')" required />
                    <x-back.input-error for="email"></x-back.input-error>
                </div>

                <div class="mb-3">
                    <x-back.label value="{{ __('Password') }}" />

                    <x-back.input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-back.input-error for="password"></x-back.input-error>
                </div>

                <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <x-back.checkbox id="remember_me" name="remember" />
                        <label class="" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted mr-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-back.button>
                            {{ __('Log in') }}
                        </x-back.button>
                    </div>
                </div>
            </form>
        </div>
    </x-back.authentication-card>
</x-guest-layout>

<x-back.action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="h5 font-weight-bold">
            @if ($this->enabled)
                {{ __('You have enabled two factor authentication.') }}
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <p class="mt-3">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <p class="mt-3">
                    {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                </p>

                <div class="mt-3">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
                <x-back.label for="code" value="{{ __('Code') }}" />

                        <x-back.input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-back.input-error for="code" class="mt-2" />

                        <x-back.button class="mt-2">
                            <div wire:loading wire:click="confirmTwoFactorAuthentication" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            {{ __('Save') }}
                        </x-back.button>
            @endif

            @if ($showingRecoveryCodes)
                <p class="mt-3">
                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                </p>

                <div class="bg-light rounded p-3">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-3">
            @if (! $this->enabled)
                <x-back.confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-back.button type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </x-back.button>
                </x-back.confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-back.confirms-password wire:then="regenerateRecoveryCodes">
                        <x-back.secondary-button class="me-3">
                            <div wire:loading wire:target="regenerateRecoveryCodes" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            {{ __('Regenerate Recovery Codes') }}
                        </x-back.secondary-button>
                    </x-back.confirms-password>
                @else
                    <x-back.confirms-password wire:then="showRecoveryCodes">
                        <x-back.secondary-button class="me-3">
                            <div wire:loading wire:target="showRecoveryCodes" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            {{ __('Show Recovery Codes') }}
                        </x-back.secondary-button>
                    </x-back.confirms-password>
                @endif

                <x-back.confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-back.danger-button wire:loading.attr="disabled">
                        <div wire:loading wire:target="disableTwoFactorAuthentication" class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        {{ __('Disable') }}
                    </x-back.danger-button>
                </x-back.confirms-password>
            @endif
        </div>
    </x-slot>
</x-back.action-section>

@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <x-filament-panels::avatar.user size="lg" :user="$user" />

            <div class="flex-1">
                <h2
                    class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white"
                >
                    {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }}
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ filament()->getUserName($user) }}
                </p>
            </div>

            <x-filament::button
                    color="success"
                    tag="a"
                    href="{{ config('donation.link') }}"
                    icon="heroicon-m-hand-thumb-up"
                    rel="noopener noreferrer"
                    target="_blank"
                    outlined
                >
                    {{ __('Donate') }}
            </x-filament::button>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

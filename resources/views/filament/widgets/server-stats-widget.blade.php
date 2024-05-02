@php
    $columns = $this->getColumns();
@endphp

<x-filament-widgets::widget class="fi-wi-stats-overview">
    <div
        @if ($pollingInterval = $this->getPollingInterval())
            wire:poll.{{ $pollingInterval }}
        @endif
        @class([
            'fi-wi-stats-overview-stats-ctn grid gap-6',
            'md:grid-cols-1' => $columns === 1,
            'md:grid-cols-2' => $columns === 2,
            'md:grid-cols-3' => $columns === 3,
            'md:grid-cols-2 xl:grid-cols-4' => $columns === 4,
        ])
    >
        @foreach ($this->getCachedStats() as $stat)
            {{ $stat }}
        @endforeach

        @if (count($this->connectedApps) > 0)
            <x-filament-widgets::widget>
                <x-filament::section icon="heroicon-m-wifi" icon-color="success">
                    <x-slot name="heading">
                        Connected Apps
                    </x-slot>

                    <div class="divide-y divide-gray-200 dark:divide-white/10" style="margin: -1.5rem">
                        @foreach ($this->connectedApps as $app)
                            <div class="flex justify-between p-6 dark:border-white/10">
                                <div>
                                    App ID: {{ $app['json']['app_id'] }}
                                </div>
                                <div>
                                    Connection: {{ $app['value'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-filament::section>
            </x-filament-widgets::widget>
        @endif
    </div>
</x-filament-widgets::widget>

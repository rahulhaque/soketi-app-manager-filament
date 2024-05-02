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

        <x-filament-widgets::widget>
            <x-filament::section icon="heroicon-m-wifi" icon-color="success">
                <x-slot name="heading">
                    Connected Apps
                </x-slot>
                @if (count($this->connectedApps) > 0 && $this->totalConnection > 0)
                    <div class="divide-y divide-gray-200 dark:divide-white/10" style="margin: -1.5rem">
                        @foreach ($this->connectedApps as $app)
                            <div class="flex justify-between p-6 dark:border-white/10">
                                <div>
                                    <span class="font-medium text-gray-500 dark:text-gray-400">App ID:</span> {{ $app['json']['app_id'] }}
                                </div>
                                <div>
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Connection:</span> {{ $app['value'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    @if ($this->isSoketiRunning)
                        <div class="flex justify-center p-6 dark:border-white/10 text-sm text-gray-600 dark:text-gray-400" style="margin: -1.5rem">
                            No apps connected yet.
                        </div>
                    @else
                        <div class="flex justify-center p-6 dark:border-white/10 text-sm text-danger-600 dark:text-danger-400" style="margin: -1.5rem">
                            Error getting stats. Is Soketi running?
                        </div>
                    @endif
                @endif
            </x-filament::section>
        </x-filament-widgets::widget>
    </div>
</x-filament-widgets::widget>

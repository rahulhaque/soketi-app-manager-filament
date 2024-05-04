<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Number;

class ServerStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';

    protected static string $view = 'filament.widgets.server-stats-widget';

    protected bool $isSoketiRunning = false;

    protected int $totalConnection = 0;

    protected array $connectedApps = [];

    protected function getColumns(): int
    {
        return 3;
    }

    public static function canView(): bool
    {
        return config('metrics.enabled') && auth()->user()->is_admin;
    }

    protected function getStats(): array
    {
        try {
            $memoryUsage = Http::timeout(5)->get(config('metrics.host').'/usage');
            $metrics = Http::timeout(5)->get(config('metrics.host').'/metrics');

            $soketiConnected = parse_prometheus('soketi_connected', $metrics->body());
            $soketiProcessRuntime = parse_prometheus('soketi_process_start_time_seconds', $metrics->body());

            $this->isSoketiRunning = true;
            $this->connectedApps = $soketiConnected->toArray();
            $this->totalConnection = $soketiConnected->pluck('value')->sum();

            return [
                Stat::make('Server Started', now()->subSeconds(time() - $soketiProcessRuntime->pluck('value')[0])->diffForHumans()),
                Stat::make('Total Memory Usage', round($memoryUsage->json('memory.percent')).'% of '.Number::fileSize($memoryUsage->json('memory.total'), 1)),
                Stat::make('Total Open Connection', $this->totalConnection),
            ];
        } catch (\Exception $e) {
            return [
                Stat::make('Server Runtime', 'N/A')
                    ->description('Error getting stats. Is Soketi running?')
                    ->color('danger'),
                Stat::make('Total Memory Used', 'N/A')
                    ->description('Error getting stats. Is Soketi running?')
                    ->color('danger'),
                Stat::make('Total Open Connection', 'N/A')
                    ->description('Error getting stats. Is Soketi running?')
                    ->color('danger'),
            ];
        }
    }
}

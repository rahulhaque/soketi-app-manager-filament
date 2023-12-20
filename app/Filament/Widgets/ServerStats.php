<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Number;

class ServerStats extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';

    public static function canView(): bool
    {
        return config('metrics.enabled');
    }

    protected function getStats(): array
    {
        try {
            $memoryUsage = Http::timeout(5)->get(config('metrics.host').'/usage');
            $metrics = Http::timeout(5)->get(config('metrics.host').'/metrics');

            $soketiConnected = parse_prometheus('soketi_connected', $metrics->body());
            $soketiMessageSent = parse_prometheus('soketi_ws_messages_sent_total', $metrics->body());

            return [
                Stat::make('Total Memory Usage', round($memoryUsage->json('memory.percent')).'%')
                    ->description('Of '.Number::fileSize($memoryUsage->json('memory.total'), 2)),
                Stat::make('Total Open Connection', $soketiConnected->pluck('value')->sum())
                    ->description('Instance(s) connected'),
                Stat::make('Total Message Sent', $soketiMessageSent->pluck('value')->sum())
                    ->description('To connected clients'),
            ];
        } catch (\Exception $e) {
            return [
                Stat::make('Total Memory Used', 'N/A')
                    ->description('Error getting stats. Is Soketi running?')
                    ->color('danger'),
                Stat::make('Total Open Connection', 'N/A')
                    ->description('Error getting stats. Is Soketi running?')
                    ->color('danger'),
                Stat::make('Total Message Sent', 'N/A')
                    ->description('Error getting stats. Is Soketi running?')
                    ->color('danger'),
            ];
        }

    }
}
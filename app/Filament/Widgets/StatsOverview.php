<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Applications', Application::count()),
            Stat::make('Active Applications', Application::where('enabled', true)->count()),
            Stat::make('Inactive Applications', Application::where('enabled', false)->count()),
        ];
    }
}

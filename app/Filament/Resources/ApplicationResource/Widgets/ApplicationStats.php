<?php

namespace App\Filament\Resources\ApplicationResource\Widgets;

use App\Filament\Resources\ApplicationResource\Pages\ListApplications;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ApplicationStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListApplications::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Applications', $this->getPageTableQuery()->count()),
            Stat::make('Active Applications', $this->getPageTableQuery()->where('enabled', true)->count()),
            Stat::make('Inactive Applications', $this->getPageTableQuery()->where('enabled', false)->count()),
        ];
    }
}

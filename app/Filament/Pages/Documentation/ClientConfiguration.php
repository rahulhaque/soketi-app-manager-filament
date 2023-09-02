<?php

namespace App\Filament\Pages\Documentation;

use Filament\Pages\Page;

class ClientConfiguration extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-window';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.documentation.client-configuration';

    public function getBreadcrumbs(): array
    {
        return [
            '/applications' => 'Applications',
            '/client-configuration' => 'Client Configuration',
        ];
    }
}

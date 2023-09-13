<?php

namespace App\Filament\Pages\Documentation;

use Filament\Pages\Page;

class ClientConfiguration extends Page
{
    protected static ?string $navigationGroup = 'Documentation';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.documentation.client-configuration';

    public function getBreadcrumbs(): array
    {
        return [
            '#' => 'Documentation',
            '/client-configuration' => 'Client Configuration',
        ];
    }
}

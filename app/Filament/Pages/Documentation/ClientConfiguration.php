<?php

namespace App\Filament\Pages\Documentation;

use Filament\Pages\Page;

class ClientConfiguration extends Page
{
    protected static ?string $navigationGroup = 'Documentation';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.pages.documentation.client-configuration';

    public function getBreadcrumbs(): array
    {
        return [
            '#' => 'Documentation',
            '/client-configuration' => 'Client Configuration',
        ];
    }

    protected function getViewData(): array
    {
        return [
            'host' => parse_url(config('app.url'), PHP_URL_HOST),
            'port' => env('APP_PORT', 6001),
        ];
    }
}

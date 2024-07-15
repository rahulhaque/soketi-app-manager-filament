<?php

namespace App\Filament\Pages\Documentation;

use Filament\Pages\Page;

class ServerConfiguration extends Page
{
    protected static ?string $navigationGroup = 'Documentation';

    protected static ?int $navigationSort = 5;

    protected static string $view = 'filament.pages.documentation.server-configuration';

    public function getBreadcrumbs(): array
    {
        return [
            '#' => 'Documentation',
            '/server-configuration' => 'Server Configuration',
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

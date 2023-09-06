<?php

namespace App\Filament\Pages\Documentation;

use Filament\Pages\Page;

class ServerConfiguration extends Page
{
    protected static ?string $navigationGroup = 'Documentation';
    
    protected static string $view = 'filament.pages.documentation.server-configuration';

    public function getBreadcrumbs(): array
    {
        return [
            '/applications' => 'Applications',
            '/server-configuration' => 'Server Configuration',
        ];
    }
}

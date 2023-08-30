<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->successNotificationTitle('Application created successfully!')
                ->form([
                    TextInput::make('name')
                        ->label('App name')
                        ->required()
                        ->maxLength(100)
                        ->unique()
                        ->columnSpan(3),
                    Toggle::make('enabled')
                        ->label('Is enabled?')
                        ->required()
                        ->inline(false)
                        ->columnSpan(3),
                ])
                ->mutateFormDataUsing(function (array $data): array {
                    $data['key'] = md5(microtime().rand());
                    $data['secret'] = md5(microtime().rand());
                    $data['webhooks'] = [];
                    $data['created_by'] = auth()->id();

                    return $data;
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'active' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('enabled', true)),
            'inactive' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('enabled', false)),
        ];
    }
}

<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Hash;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-m-plus-circle')
                ->successNotificationTitle('User created successfully!')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(100),
                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->unique()
                        ->maxLength(100),
                    TextInput::make('password')
                        ->required()
                        ->password()
                        ->maxLength(100),
                    Toggle::make('is_active')
                        ->inline(false),
                    Toggle::make('is_admin')
                        ->inline(false),
                ])
                ->mutateFormDataUsing(function (array $data): array {
                    $data['password'] = Hash::make($data['password']);
                    $data['created_by'] = auth()->id();

                    return $data;
                }),
        ];
    }
}

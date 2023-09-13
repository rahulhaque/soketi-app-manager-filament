<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->icon('heroicon-m-trash')
                ->successNotificationTitle('User deleted successfully!'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'User updated successfully!';
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();

        if (empty($data['password'])) {
            $data = Arr::except($data, 'password');

            return $data;
        }

        $data['password'] = Hash::make($data['password']);

        return $data;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(4)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(3),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(3),
                        TextInput::make('password')
                            ->password()
                            ->maxLength(100)
                            ->columnSpan(3),
                        Toggle::make('is_active')
                            ->inline(false)
                            ->hidden(fn () => $this->record->id == auth()->id())
                            ->columnSpan(3),
                        Toggle::make('is_admin')
                            ->inline(false)
                            ->hidden(fn () => $this->record->id == auth()->id())
                            ->columnSpan(3),
                    ]),
            ]);
    }
}

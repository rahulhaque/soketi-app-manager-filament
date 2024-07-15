<?php

namespace App\Filament\Pages;

use App\Models\Application;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Pusher\Pusher;

class Playground extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.playground';

    public ?array $data = [];

    public string $channel;

    public string $event;

    public string $payload;

    public function mount(): void
    {
        // To set filament form value
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $applications = Application::ownershipAware()->where('enabled', true)->pluck('name', 'id');

        return $form
            ->schema([
                Select::make('applications')
                    ->label('Application to send')
                    ->options($applications)
                    ->required()
                    ->searchable(['name'])
                    ->native(false),
                TextInput::make('channel')
                    ->label('Channel name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('event')
                    ->label('Event name')
                    ->required()
                    ->maxLength(100),
                Textarea::make('payload')
                    ->required()
                    ->autosize()
                    ->json(),
            ])
            ->statePath('data');
    }

    public function send(): void
    {
        // Method getState() will validate the form
        $input = $this->form->getState();

        $application = Application::query()->find($input['applications'], ['id', 'key', 'secret']);

        $pusher = new Pusher(
            $application->key,
            $application->secret,
            $application->id,
            config('broadcasting.connections.pusher.options')
        );

        (new PusherBroadcaster($pusher))->broadcast([$input['channel']], $input['event'], json_decode($input['payload'], true));

        Notification::make()
            ->title('Success')
            ->body('See client side for received events.')
            ->success()
            ->send();
    }
}

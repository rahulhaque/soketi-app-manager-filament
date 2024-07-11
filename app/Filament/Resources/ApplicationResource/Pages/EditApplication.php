<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Enums\WebhookEvent;
use App\Enums\WebhookFilter;
use App\Filament\Resources\ApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;

class EditApplication extends EditRecord
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->icon('heroicon-m-trash')
                ->successNotificationTitle('Application deleted successfully!'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Application updated successfully!';
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();

        return $data;
    }

    protected function afterSave(): void
    {
        $this->record->clearCache();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()
                    ->columns(4)
                    ->columnSpan(4)
                    ->tabs([
                        Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('name')
                                    ->label('App name')
                                    ->required()
                                    ->maxLength(100)
                                    ->unique(ignoreRecord: true)
                                    ->columnSpan(3),
                                Toggle::make('enabled')
                                    ->label('Enable app')
                                    ->required()
                                    ->inline(false)
                                    ->columnSpan(3),
                                Toggle::make('enable_client_messages')
                                    ->label('Enable client events')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Let clients communicate directly with each other.')
                                    ->hintColor('primary')
                                    ->required()
                                    ->inline(false)
                                    ->columnSpan(3),
                                Toggle::make('enable_user_authentication')
                                    ->label('Enable authorized connections')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Closes connections which fail to subscribe to a private/presence channel within a timeout.')
                                    ->hintColor('primary')
                                    ->required()
                                    ->inline(false)
                                    ->columnSpan(3),
                                Select::make('created_by')
                                    ->label('Owner')
                                    ->relationship('creator', 'name')
                                    ->required()
                                    ->native(false)
                                    ->searchable(['name', 'email'])
                                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name} ({$record->email})")
                                    ->visible(fn (): bool => auth()->user()->is_admin && auth()->id())
                                    ->columnSpan(3),
                            ]),
                        Tab::make('Limits')
                            ->icon('heroicon-o-funnel')
                            ->schema([
                                TextInput::make('max_connections')
                                    ->label('Max connections')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Negative value means unlimited connections')
                                    ->hintColor('primary')
                                    ->required()
                                    ->numeric()
                                    ->minValue(-1)
                                    ->maxValue(10000)
                                    ->columnSpan(3),
                                TextInput::make('max_backend_events_per_sec')
                                    ->label('Max backend events per second')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Negative value means unlimited connections')
                                    ->hintColor('primary')
                                    ->required()
                                    ->numeric()
                                    ->minValue(-1)
                                    ->maxValue(10000)
                                    ->columnSpan(3),
                                TextInput::make('max_client_events_per_sec')
                                    ->label('Max client events per second')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Negative value means unlimited connections')
                                    ->hintColor('primary')
                                    ->required()
                                    ->numeric()
                                    ->minValue(-1)
                                    ->maxValue(10000)
                                    ->columnSpan(3),
                                TextInput::make('max_read_req_per_sec')
                                    ->label('Max read requests per second')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Negative value means unlimited connections')
                                    ->hintColor('primary')
                                    ->required()
                                    ->numeric()
                                    ->minValue(-1)
                                    ->maxValue(10000)
                                    ->columnSpan(3),
                            ]),
                        Tab::make('Channel')
                            ->icon('heroicon-o-view-columns')
                            ->schema([
                                TextInput::make('max_channel_name_length')
                                    ->label('Max channel name length')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(127)
                                    ->columnSpan(3),
                                TextInput::make('max_event_name_length')
                                    ->label('Max event name length')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(127)
                                    ->columnSpan(3),
                                TextInput::make('max_presence_members_per_channel')
                                    ->label('Max presence members per channel')
                                    ->required()
                                    ->numeric()
                                    ->minValue(-1)
                                    ->maxValue(127)
                                    ->columnSpan(3),
                                TextInput::make('max_event_channels_at_once')
                                    ->label('Max event channels at once')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(127)
                                    ->columnSpan(3),
                            ]),
                        Tab::make('Memory')
                            ->icon('heroicon-o-circle-stack')
                            ->schema([
                                TextInput::make('max_event_batch_size')
                                    ->label('Max event batch size')
                                    ->required()
                                    ->numeric()
                                    ->minValue(10)
                                    ->maxValue(127)
                                    ->columnSpan(3),
                                TextInput::make('max_presence_member_size_in_kb')
                                    ->label('Max presence member size in kb')
                                    ->required()
                                    ->numeric()
                                    ->minValue(10)
                                    ->maxValue(127)
                                    ->columnSpan(3),
                                TextInput::make('max_event_payload_in_kb')
                                    ->label('Max event payload size in kb')
                                    ->required()
                                    ->numeric()
                                    ->minValue(10)
                                    ->maxValue(127)
                                    ->columnSpan(3),
                            ]),
                    ])
                    ->persistTabInQueryString(),
                Repeater::make('webhooks')
                    ->addActionLabel('Add webhook')
                    ->itemLabel('Webhook')
                    ->hint(
                        new HtmlString('<a href="https://docs.soketi.app/advanced-usage/app-webhooks" title="Consider reading Pusher documentation" target="_blank">Documentation</a>')
                    )
                    ->hintColor('primary')
                    ->columns(4)
                    ->columnSpan(4)
                    ->schema([
                        TextInput::make('url')->label('Webhook URL')->required()->url()->maxLength(100)->columnSpan(3),
                        CheckboxList::make('event_types')
                            ->options(WebhookEvent::toTitledArray())
                            ->columns(3)
                            ->columnSpan(3),
                        KeyValue::make('headers')
                            ->addActionLabel('Add header')
                            ->hint(
                                new HtmlString('<a href="https://docs.soketi.app/advanced-usage/app-webhooks#webhook-headers" target="_blank">Documentation</a>')
                            )
                            ->hintColor('primary')
                            ->keyLabel('Header')
                            ->columnSpan(3),
                        KeyValue::make('filter')
                            ->hint(
                                new HtmlString('<a href="https://docs.soketi.app/advanced-usage/app-webhooks#filtering-webhooks" target="_blank">Documentation</a>')
                            )
                            ->hintColor('primary')
                            ->default(array_fill_keys(WebhookFilter::values(), ''))
                            ->addable(false)
                            ->editableKeys(false)
                            ->deletable(false)
                            ->columnSpan(3),
                    ])
                    ->reorderable(false),
            ]);
    }
}

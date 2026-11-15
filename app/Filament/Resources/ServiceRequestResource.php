<?php

namespace App\Filament\Resources;

use App\Actions\TransitionServiceRequest;
use App\Enums\RequestStatus;
use App\Filament\Resources\ServiceRequestResource\Pages\ListServiceRequests;
use App\Models\ServiceRequest;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ServiceRequestResource extends Resource
{
    protected static ?string $model = ServiceRequest::class;

    protected static ?string $slug = 'meldingen';

    protected static ?string $modelLabel = 'melding';

    protected static ?string $pluralModelLabel = 'meldingen';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Serviceoverzicht')
            ->description('Bekijk storingen, plan een afspraak en werk de klantstatus bij.')
            ->modifyQueryUsing(fn ($query) => $query->with('door.company'))
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('reference')->label('Nummer')->fontFamily('mono')->visibleFrom('lg'),
                TextColumn::make('title')->label('Melding')->searchable()->wrap()->weight('semibold')
                    ->description(fn (ServiceRequest $record) => $record->door->name),
                TextColumn::make('door.company.name')->label('Bedrijf')->searchable()->visibleFrom('md'),
                TextColumn::make('status')->label('Status')->badge(),
                TextColumn::make('scheduled_for')->label('Afspraak')->state(fn (ServiceRequest $record) => $record->scheduled_for?->format('d-m-Y') ?? 'Nog niet gepland')
                    ->sortable()->visibleFrom('lg'),
            ])
            ->filters([SelectFilter::make('status')->label('Status')->options(RequestStatus::class)])
            ->recordActions([
                Action::make('bekijken')
                    ->label('Bekijken')
                    ->icon(Heroicon::OutlinedEye)
                    ->authorize('view')
                    ->modalHeading(fn (ServiceRequest $record) => $record->title)
                    ->modalContent(fn (ServiceRequest $record) => view('staff.request', [
                        'report' => $record->load('door.company'),
                        'updates' => $record->updates()->orderBy('id')->get(),
                    ]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Sluiten'),
                Action::make('inplannen')
                    ->label('Inplannen')
                    ->icon(Heroicon::OutlinedCalendar)
                    ->authorize('update')
                    ->visible(fn (ServiceRequest $record) => $record->status === RequestStatus::Reported)
                    ->modalHeading('Afspraak inplannen')
                    ->schema([DatePicker::make('scheduled_for')->label('Afspraakdatum')->minDate(today())->required()])
                    ->modalSubmitActionLabel('Afspraak opslaan')
                    ->action(function (ServiceRequest $record, array $data): void {
                        static::applyTransition(
                            fn () => app(TransitionServiceRequest::class)->schedule($record, Auth::user(), $data['scheduled_for']),
                            'Afspraak ingepland',
                        );
                    }),
                Action::make('afronden')
                    ->label('Afronden')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->authorize('update')
                    ->visible(fn (ServiceRequest $record) => $record->status === RequestStatus::Scheduled)
                    ->modalHeading('Melding afronden')
                    ->schema([Textarea::make('note')->label('Toelichting voor de klant')->maxLength(500)->rows(3)])
                    ->modalSubmitActionLabel('Melding afronden')
                    ->action(function (ServiceRequest $record, array $data): void {
                        static::applyTransition(
                            fn () => app(TransitionServiceRequest::class)->complete($record, Auth::user(), $data['note'] ?? null),
                            'Melding afgerond',
                        );
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => ListServiceRequests::route('/')];
    }

    private static function applyTransition(callable $transition, string $success): void
    {
        try {
            $transition();
        } catch (ValidationException $exception) {
            Notification::make()->title($exception->validator->errors()->first())->danger()->send();

            return;
        }

        Notification::make()->title($success)->success()->send();
    }
}

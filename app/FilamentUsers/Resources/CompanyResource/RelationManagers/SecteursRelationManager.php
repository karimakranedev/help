<?php

namespace App\FilamentUsers\Resources\CompanyResource\RelationManagers;

use App\Models\Secteur;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class SecteursRelationManager extends RelationManager
{
    protected static string $relationship = 'secteurs';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('type'),

                TextInput::make('code'),

                TextInput::make('icon'),

                TextInput::make('color'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Secteur $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Secteur $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type'),

                TextColumn::make('code'),

                TextColumn::make('icon'),

                TextColumn::make('color'),
            ]);
    }
}

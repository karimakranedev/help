<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultationTypeResource\Pages;
use App\Models\ConsultationType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ConsultationTypeResource extends Resource
{
    protected static ?string $model = ConsultationType::class;

    protected static ?string $slug = 'publications/types';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Types de publications';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $pluralModelLabel = 'Types de publications';
    protected static ?string $modelLabel = 'Type de publication';
    protected static ?string $navigationGroup = 'Gestion des publications';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageConsultationTypes::route('/'),
        ];
    }
}

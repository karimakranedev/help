<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OtypeResource\Pages;
use App\Models\Otype;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class OtypeResource extends Resource
{
    protected static ?string $model = Otype::class;

    protected static ?string $slug = 'organismes/types';
    protected static ?string $navigationLabel = 'Types d\'organisme';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $pluralModelLabel = 'Types d\'organisme';
    protected static ?string $modelLabel = 'Type d\'organisme';
    protected static ?string $navigationGroup = 'Gestion des organismes';

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ManageOtypes::route('/'),
        ];
    }
}

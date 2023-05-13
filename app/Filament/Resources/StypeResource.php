<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StypeResource\Pages;
use App\Models\Stype;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;

class StypeResource extends Resource
{
    protected static ?string $model = Stype::class;

    protected static ?string $slug = 'secteurs/types';
    protected static ?string $navigationLabel = 'Types de secteur';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $pluralModelLabel = 'Types de secteur';
    protected static ?string $modelLabel = 'Type de secteur';
    protected static ?string $navigationGroup = 'Parmètres des annonces';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                ColorPicker::make('color'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ColorColumn::make('color')
                    ->copyable()
                    ->copyMessage('Color code copied')
                    ->copyMessageDuration(1500),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ManageStypes::route('/'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClasseResource\Pages;
use App\Models\Classe;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ClasseResource extends Resource
{
    protected static ?string $model = Classe::class;

    protected static ?string $slug = 'publications/classes';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Classifications';
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $pluralModelLabel = 'Classifications';
    protected static ?string $modelLabel = 'Classification';
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
                    ->label('Nom de la classe')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),

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
            'index' => Pages\ManageClasses::route('/'),
        ];
    }
}

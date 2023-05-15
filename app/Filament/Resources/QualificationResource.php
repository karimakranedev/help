<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QualificationResource\Pages;
use App\Models\Qualification;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class QualificationResource extends Resource
{
    protected static ?string $model = Qualification::class;

    protected static ?string $slug = 'publications/qualifications';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Qualifications';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $pluralModelLabel = 'Qualifications';
    protected static ?string $modelLabel = 'Qualification';
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
            'index' => Pages\ManageQualifications::route('/'),
        ];
    }
}

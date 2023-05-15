<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgreementResource\Pages;
use App\Models\Agreement;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgreementResource extends Resource
{
    protected static ?string $model = Agreement::class;

    protected static ?string $slug = 'publications/agreements';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Agréements';
    protected static ?string $navigationIcon = 'heroicon-o-bookmark-alt';
    protected static ?string $pluralModelLabel = 'Agréements';
    protected static ?string $modelLabel = 'Agréement';
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
            'index' => Pages\ManageAgreements::route('/'),
        ];
    }
}

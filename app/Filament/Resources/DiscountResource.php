<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiscountResource\Pages;
use App\Models\Discount;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $slug = 'products/discount';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Réductions';
    protected static ?string $navigationIcon = 'heroicon-o-receipt-tax';
    protected static ?string $pluralModelLabel = 'Réductions';
    protected static ?string $modelLabel = 'Réduction';
    protected static ?string $navigationGroup = 'Gestion des abonnements';
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
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('discount_percentage')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_date'),
                Forms\Components\DateTimePicker::make('end_date'),
                Forms\Components\Toggle::make('is_forced')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('discount_percentage'),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime('d-M-Y'),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime('d-M-Y'),
                Tables\Columns\ToggleColumn::make('is_forced'),
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
            'index' => Pages\ManageDiscounts::route('/'),
        ];
    }
}

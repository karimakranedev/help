<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Subscription;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $slug = 'products/subscriptions';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Abonnements';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $pluralModelLabel = 'Abonnements';
    protected static ?string $modelLabel = 'Abonnement';
    protected static ?string $navigationGroup = 'Gestion des abonnements';
    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Select::make('discount_id')
                    ->relationship('discount', 'name')
                    ->preload()
                    ->searchable(),

                DatePicker::make('start_date'),

                DatePicker::make('end_date'),

                TextInput::make('price')
                    ->numeric(),

                DatePicker::make('payment_date'),

                Checkbox::make('is_valid'),

                Checkbox::make('is_paid'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Subscription $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Subscription $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('product.name'),

                TextColumn::make('discount.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start_date')
                    ->date(),

                TextColumn::make('end_date')
                    ->date(),

                TextColumn::make('price'),

                TextColumn::make('payment_date')
                    ->date(),

                ToggleColumn::make('is_valid'),

                ToggleColumn::make('is_paid'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['company', 'discount']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['company.name', 'discount.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->company) {
            $details['Company'] = $record->company->name;
        }

        if ($record->discount) {
            $details['Discount'] = $record->discount->name;
        }

        return $details;
    }

    public static function canCreate(): bool
    {
        return true;
    }
}

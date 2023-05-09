<?php

namespace App\FilamentUsers\Resources;

use App\FilamentUsers\Resources\CompanyResource\Pages;
use App\FilamentUsers\Resources\CompanyResource\RelationManagers\SecteursRelationManager;
use App\Models\Company;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Iotronlab\FilamentMultiGuard\Concerns\ContextualResource;

class CompanyResource extends Resource
{
    use ContextualResource;

    protected static ?string $model = Company::class;

    protected static ?string $slug = 'companies';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('email'),

                TextInput::make('phone'),

                TextInput::make('founded_year')
                    ->integer(),

                TextInput::make('website'),

                TextInput::make('linkedin'),

                TextInput::make('facebook'),

                TextInput::make('patente'),

                TextInput::make('if'),

                TextInput::make('rc'),

                TextInput::make('ice'),

                TextInput::make('cnss'),

                TextInput::make('country'),

                TextInput::make('street'),

                TextInput::make('city'),

                TextInput::make('state'),

                TextInput::make('zip'),

                Checkbox::make('is_active'),


                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Company $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Company $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone'),

                TextColumn::make('founded_year'),


            ]);
    }

    public static function getRelations(): array
    {
        return [
            SecteursRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function canCreate(): bool
    {
        $company = auth()->user()->company();
        return $company === null || $company->count() === 0;
    }


}

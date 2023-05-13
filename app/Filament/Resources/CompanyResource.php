<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Ysfkaya\FilamentPhoneInput\PhoneInput;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $slug = 'clients';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Clients';

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $pluralModelLabel = 'Clients';

    protected static ?string $modelLabel = 'Client';

    protected static ?string $navigationGroup = 'Gestion des clients';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make('Logo')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('logo')
                                    ->collection('logo-images')
                                    ->disableLabel(),
                            ])
                            ->collapsed(),
                        Section::make('Propriétaire')
                            ->schema([
                               Fieldset::make()
                                ->relationship('owner')
                                ->schema([
                                    Grid::make()
                                        ->schema([
                                            Select::make('title')
                                                ->options([
                                                    'Mr.' => 'Mr.',
                                                    'Mme.' => 'Mme.',
                                                    'Mlle.' => 'Mlle.',
                                                ])
                                                ->required(),
                                        ]),
                                    Grid::make()
                                        ->schema([
                                            TextInput::make('first_name')
                                                ->maxValue(50)
                                                ->required(),

                                            TextInput::make('last_name')
                                                ->required()
                                                ->maxValue(50),
                                        ]),
                                    Grid::make()
                                        ->schema([
                                            TextInput::make('email')
                                                ->label(__('Email'))
                                                ->email()
                                                ->required()
                                                ->rule(
                                                    fn($record) => 'unique:users,email,'
                                                        . ($record ? $record->id : 'NULL')
                                                        . ',id,deleted_at,NULL'
                                                )
                                                ->maxLength(255),

                                            PhoneInput::make('phone')
                                                ->required()
                                                ->preferredCountries(['ma'])
                                                ->separateDialCode(true)
                                                ->formatOnDisplay(true)
                                                ->onlyCountries(['ma'])
                                                ->unique(ignoreRecord: true),
                                        ]),
                                    TextInput::make('password')
                                        ->password()
                                        ->columnSpan('full')
                                        ->required()
                                        ->dehydrateStateUsing(function ($state) {
                                            return Hash::make($state);
                                        }),
                                    CheckboxList::make('roles')
                                        //->relationship('roles', 'name')
                                        ->relationship('roles', 'name',fn(Builder $query) =>
                                           $query->Where('guard_name', '=','web'))
                                        ->columns(3)
                                        ->label(trans('Roles')),

                                    Hidden::make('is_owner')
                                        ->default(true)
                                ])
                            ])->visibleOn('create'),
                        Card::make()
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Nom de la société')
                                            ->required(),

                                    ]),

                                TextInput::make('founded_year')
                                    ->label('Année de création'),

                                Grid::make()
                                    ->schema([
                                        TextInput::make('email')
                                            ->label(__('Email'))
                                            ->email()
                                            ->required()
                                            ->rule(
                                                fn($record) => 'unique:companies,email,'
                                                    . ($record ? $record->id : 'NULL')
                                                    . ',id,deleted_at,NULL'
                                            )
                                            ->maxLength(255),

                                        PhoneInput::make('phone')
                                            ->label('Téléphone')
                                            ->required()
                                            ->preferredCountries(['ma'])
                                            ->separateDialCode(true)
                                            ->formatOnDisplay(true)
                                            ->onlyCountries(['ma'])
                                            ->unique(ignoreRecord: true),
                                    ]),
                            ]),

                        Card::make()
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        TextInput::make('website')
                                            ->label('Site Web'),
                                        TextInput::make('linkedin'),
                                        TextInput::make('facebook'),
                                    ]),
                            ]),
                        Section::make('Infos légales')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('patente'),
                                        TextInput::make('if'),
                                        TextInput::make('rc'),
                                        TextInput::make('ice'),
                                        TextInput::make('cnss'),
                                    ]),
                            ])->collapsed(),
                        Section::make('Coordonnées')
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        TextInput::make('country')
                                            ->maxLength(50)
                                            ->label(__('Pays'))
                                            ->default('Maroc'),
                                    ]),

                                TextInput::make('street')
                                    ->label('Adresse'),

                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('city')
                                            ->label(__('Ville'))
                                            ->maxLength(100),
                                        TextInput::make('state')
                                            ->label(__('Province'))
                                            ->maxLength(100),
                                        TextInput::make('zip')
                                            ->label(__('CP'))
                                            ->maxLength(100),
                                    ]),
                            ]),

                        Section::make("Secteurs d'activités")
                            ->schema([
                                Grid::make(1)
                                    ->schema([
                                        CheckboxList::make('secteurs')
                                            ->relationship('secteurs', 'name')
                                            ->columns(['sm'=>1,'lg'=>2])
                                            ->label(trans('Secteurs')),
                                    ])
                            ]),

                        Grid::make()
                            ->schema([
                                grid::make()
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label(__('Is active'))
                                            ->required(),
                                    ])->columnSpan(['lg' => 1]),
                            ]),

                    ])
                    ->columnSpan(['lg' => fn (?Company $record) => $record === null ? 3 : 2]),


                Grid::make()
                    ->schema([
                        Section::make('Proriétaire')
                            ->schema([
                                Placeholder::make('owner_name')
                                    ->label('')
                                    ->content(fn ($record) => $record->owner?->name),
                                Placeholder::make('owner_email')
                                    ->label('')
                                    ->content(fn ($record) => $record->owner?->email),
                                Placeholder::make('owner_phone')
                                    ->label('')
                                    ->content(fn ($record) => $record->owner?->phone),
                            ])->hidden(fn (?Company $record) => $record->owner === null),

                        Card::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Company $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (Company $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                    ])->columnSpan(['lg' => 1])
                    ->hidden(fn (?Company $record) => $record === null),


            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('logo')
                    ->label('')
                    ->collection('logo-images'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('owner.name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('founded_year'),

                Tables\Columns\TextColumn::make('country'),
                ToggleColumn::make('is_active')
                    ->label(__('Active')),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

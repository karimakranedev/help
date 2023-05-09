<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
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
use Ysfkaya\FilamentPhoneInput\PhoneInput;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                            ->collapsible(),
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
                            ]),
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
                        Section::make('Société')
                            ->schema([
                                Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Company $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (Company $record): ?string => $record->updated_at?->diffForHumans()),
                            ]),
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

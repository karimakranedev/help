<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganismeResource\Pages;
use App\Models\Organisme;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrganismeResource extends Resource
{
    protected static ?string $model = Organisme::class;

    protected static ?string $slug = 'organismes';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Organismes';

    protected static ?string $navigationIcon = 'heroicon-o-library';

    protected static ?string $pluralModelLabel = 'Organismes';

    protected static ?string $modelLabel = 'Organisme';

    protected static ?string $navigationGroup = 'Gestion des organismes';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('diminutive'),
                            ]),
                        Grid::make()
                            ->schema([
                                Select::make('otype_id')
                                    ->relationship('type','name')
                                    ->preload()
                                    ->required(),
                            ]),
                        Grid::make()
                            ->schema([
                                TextInput::make('email'),
                            ]),
                        Grid::make()
                            ->schema([
                                TextInput::make('phone_1'),
                                TextInput::make('phone_2'),
                                TextInput::make('fax'),
                            ]),
                        Grid::make()
                            ->schema([
                                TextInput::make('website'),
                            ]),

                        Grid::make()
                            ->schema([
                                TextInput::make('country')
                                    ->maxLength(50)
                                    ->label(__('Country'))
                                    ->default('Maroc'),
                            ]),

                        TextInput::make('street')
                            ->label('Street address'),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('city')
                                    ->label(__('City'))
                                    ->maxLength(100),
                                TextInput::make('state')
                                    ->label(__('State / Province'))
                                    ->maxLength(100),
                                TextInput::make('zip')
                                    ->label(__('Zip / Postal code'))
                                    ->maxLength(100),
                            ]),

                    ])
                    ->columnSpan(['lg' => fn (?Organisme $record) => $record === null ? 3 : 2]),

                Card::make()
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (Organisme $record): ?string => $record->created_at?->diffForHumans()),

                        Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Organisme $record): ?string => $record->updated_at?->diffForHumans()),

                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Organisme $record) => $record === null),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([


                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('diminutive'),

                TextColumn::make('type.name'),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone_1'),

                TextColumn::make('phone_2'),

                TextColumn::make('fax'),


                TextColumn::make('country'),


            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganismes::route('/'),
            'create' => Pages\CreateOrganisme::route('/create'),
            'edit' => Pages\EditOrganisme::route('/{record}/edit'),
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['type']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'type.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->type) {
            $details['Type'] = $record->type->name;
        }

        return $details;
    }
}

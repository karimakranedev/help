<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Company;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Ysfkaya\FilamentPhoneInput\PhoneInput;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Utilisateurs';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Utilisateurs';

    protected static ?string $modelLabel = 'Utilisateur';

    protected static ?string $navigationGroup = 'Gestion des clients';

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
                                Select::make('company_id')
                                    ->options(fn($get)=> Company::whereDoesntHave('users')
                                        ->orWhereHas('users',function ($query) use ($get) {
                                            return  $query->where('users.company_id', '=',$get('company_id'));
                                        })->pluck('name','id')->toArray()
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nom de la Société')
                                            ->required(),

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

                                        TextInput::make('phone')
                                            ->label(__('Téléphone')),
                                    ])
                                    ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                                        return $action
                                            ->modalHeading('Créer une Société')
                                            ->modalButton('Créer')
                                            ->modalWidth('lg');
                                    }),
                            ]),

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

                        Grid::make()
                            ->schema([
                                grid::make()
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label(__('Is active'))
                                            ->required(),
                                        Toggle::make('is_owner')
                                            ->label(__('Propriétaire'))
                                            ->required(),
                                    ])->columnSpan(['lg' => 1]),
                            ]),

                        Grid::make()
                            ->schema([
                                Toggle::make('reset_password')
                                    ->columnSpan('full')
                                    ->reactive()
                                    ->dehydrated(false)
                                    ->hiddenOn('create'),

                                TextInput::make('password')
                                    ->password()
                                    ->columnSpan('full')
                                    ->hiddenOn('view')
                                    ->visible(fn ($livewire, $get) => $livewire instanceof Pages\CreateUser || $get('reset_password') == true)
                                    ->required()
                                    ->dehydrateStateUsing(function ($state) {
                                        return Hash::make($state);
                                    }),
                            ]),
                        Card::make()
                            ->schema([
                                CheckboxList::make('roles')
                                    ->relationship('roles', 'name')
                                    //->relationship('roles', 'name',fn(Builder $query) =>
                                     //   $query->Where('guard_name', '=','*'))
                                    ->label(trans('Roles')),
                            ])->columnSpan(['lg' => 1]),

                    ])
                    ->columnSpan(['lg' => fn (?User $record) => $record === null ? 3 : 2]),

                Card::make()
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (User $record): ?string => $record->created_at?->diffForHumans()),

                        Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (User $record): ?string => $record->updated_at?->diffForHumans()),

                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?User $record) => $record === null),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->label('Société')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('email')
                    ->searchable()
                    ->icons(['heroicon-o-mail'])
                    ->color('primary'),

                BadgeColumn::make('phone')
                    ->searchable()
                    ->icons(['heroicon-o-phone'])
                    ->color('success'),

                TagsColumn::make('roles.name')
                    ->searchable()
                    ->limit(2)
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label(__('Active')),
                ToggleColumn::make('is_owner')
                    ->label(__('Owner')),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'name', 'email'];
    }


}

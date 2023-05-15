<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicationResource\Pages;
use App\Models\Agreement;
use App\Models\Classe;
use App\Models\Consultation;
use App\Models\Qualification;
use App\Models\Ville;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PublicationResource extends Resource
{
    protected static ?string $model = Consultation::class;

    protected static ?string $slug = 'publications';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Publications';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $pluralModelLabel = 'Publications';

    protected static ?string $modelLabel = 'Publication';

    protected static ?string $navigationGroup = 'Gestion des publications';

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
                        Card::make()
                            ->schema([
                                Select::make('consultation_type_id')
                                    ->label('Type')
                                    ->relationship('consultationType', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                Select::make('secteur_id')
                                    ->relationship('secteurs', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                            ]),

                        Card::make()
                            ->schema([
                                Select::make('organisme_id')
                                    ->relationship('organisme', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required(),

                                TextInput::make('ministere'),

                                TextInput::make('sous_organisme'),

                                TextInput::make('administration_contact')
                                    ->label('Email'),
                            ]),

                        Card::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Titre de la publication')
                                    ->required(),

                                TextInput::make('reference')
                                    ->label('Reférence')
                                    ->required(),

                                TextInput::make('objet')
                                    ->label('Objet')
                                    ->required(),
                            ]),

                        Card::make()
                            ->schema([

                                Select::make('classe')
                                    ->label('Classification')
                                    ->options(Classe::all()->pluck('name', 'name'))
                                    ->preload()
                                    ->searchable(),

                                Select::make('qualification')
                                    ->label('Qualification')
                                    ->preload()
                                    ->options(Qualification::all()->pluck('name', 'name'))
                                    ->searchable(),

                                Select::make('agreement')
                                    ->label('Agréement')
                                    ->preload()
                                    ->options(Agreement::all()->pluck('name', 'name'))
                                    ->searchable(),

                            ]),

                        Card::make()
                            ->schema([
                                TextInput::make('execution_address')
                                    ->label('Adresse de l\'execution'),

                                Select::make('execution_city')
                                    ->label('Ville de l\'execution')
                                    ->options(Ville::all()->pluck('name', 'name'))
                                    ->searchable(),

                                TextInput::make('pick_up_address')
                                    ->label('Adresse de retrait'),

                                TextInput::make('bid_address')
                                    ->label('Adresse de dépôt'),

                                TextInput::make('bid_opening_address')
                                    ->label('Adresse d\'ouverture'),

                            ]),

                        Card::make()
                            ->schema([
                                RichEditor::make('observation')
                                ->label('Observation')
                                ->disableAllToolbarButtons()
                                ->enableToolbarButtons([
                                    'bold',
                                    'bulletList',
                                    'italic',
                                    'strike',
                                    'redo',
                                    'undo'
                                ]),

                            ]),

                    ])
                    ->columnSpan(2),

                Grid::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('delai_execution')
                                    ->label('Délai d\'execution'),

                                DatePicker::make('date_publication')
                                    ->label('Date de publication'),

                                DatePicker::make('date_ouverture')
                                    ->label('Date d\'ouverture'),

                                DatePicker::make('date_reunion')
                                    ->label('Date de la réunion'),

                                DatePicker::make('date_echantillon')
                                    ->label('Date de dépôt des échantillons'),

                                DatePicker::make('date_visite_lieux')
                                    ->label('Date de visite des lieux'),

                            ]),

                        Card::make()
                            ->schema([
                                Checkbox::make('is_unique_lot')
                                    ->label('Lot unique'),

                                Checkbox::make('is_http_submission')
                                    ->label('Dépôt HTTP'),

                                Checkbox::make('is_site_visit')
                                    ->label('Visite des lieux'),

                                Checkbox::make('is_small_entity')
                                    ->label('PME'),

                            ]),

                        Card::make()
                            ->schema([
                                TextInput::make('montant_retrait')
                                    ->label('Prix de retrait'),

                                TextInput::make('estimation_price')
                                    ->label('Estimation'),

                                TextInput::make('caution')
                                    ->label('Caution'),

                                TextInput::make('plans_acquisition_price')
                                    ->label('Prix de retrait Plans'),
                            ]),

                        Card::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->label('Created Date')
                                    ->content(fn(?Consultation $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                                Placeholder::make('updated_at')
                                    ->label('Last Modified Date')
                                    ->content(fn(?Consultation $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                            ])
                            ->hidden(fn (?Consultation $record) => $record === null),

                        Card::make()
                            ->schema([
                                TextInput::make('http_submission')
                                    ->label('Lien web de dépôt'),
                            ]),
                    ])->columnSpan(['lg' => 1]),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('consultationType.code')
                    ->label('')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('reference'),

                TextColumn::make('organisme.name')
                    ->searchable()
                    ->sortable(),

                TagsColumn::make('secteurs.name'),

                TextColumn::make('execution_city'),

                TextColumn::make('estimation_price'),

                TextColumn::make('date_publication')
                    ->date(),

                TextColumn::make('date_ouverture')
                    ->date(),

            ])->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPublications::route('/'),
            'create' => Pages\CreatePublication::route('/create'),
            'edit' => Pages\EditPublication::route('/{record}/edit'),
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['consultationType', 'organisme']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'consultationType.name', 'organisme.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->consultationType) {
            $details['ConsultationType'] = $record->consultationType->name;
        }

        if ($record->organisme) {
            $details['Organisme'] = $record->organisme->name;
        }

        return $details;
    }
}

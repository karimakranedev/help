<?php

namespace App\Filament\Resources\OrganismeResource\Pages;

use App\Filament\Resources\OrganismeResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrganismes extends ListRecords
{
    protected static string $resource = OrganismeResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

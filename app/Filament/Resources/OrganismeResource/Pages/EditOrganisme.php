<?php

namespace App\Filament\Resources\OrganismeResource\Pages;

use App\Filament\Resources\OrganismeResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrganisme extends EditRecord
{
    protected static string $resource = OrganismeResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

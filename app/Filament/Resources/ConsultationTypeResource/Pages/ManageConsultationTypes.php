<?php

namespace App\Filament\Resources\ConsultationTypeResource\Pages;

use App\Filament\Resources\ConsultationTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageConsultationTypes extends ManageRecords
{
    protected static string $resource = ConsultationTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\AgreementResource\Pages;

use App\Filament\Resources\AgreementResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAgreements extends ManageRecords
{
    protected static string $resource = AgreementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\SecteurResource\Pages;

use App\Filament\Resources\SecteurResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSecteurs extends ManageRecords
{
    protected static string $resource = SecteurResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

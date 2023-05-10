<?php

namespace App\Filament\Resources\OtypeResource\Pages;

use App\Filament\Resources\OtypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOtypes extends ManageRecords
{
    protected static string $resource = OtypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

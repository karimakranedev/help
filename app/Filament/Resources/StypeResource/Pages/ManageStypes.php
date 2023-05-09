<?php

namespace App\Filament\Resources\StypeResource\Pages;

use App\Filament\Resources\StypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStypes extends ManageRecords
{
    protected static string $resource = StypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

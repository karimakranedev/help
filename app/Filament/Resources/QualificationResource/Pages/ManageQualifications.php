<?php

namespace App\Filament\Resources\QualificationResource\Pages;

use App\Filament\Resources\QualificationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageQualifications extends ManageRecords
{
    protected static string $resource = QualificationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

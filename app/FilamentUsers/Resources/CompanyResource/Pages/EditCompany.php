<?php

namespace App\FilamentUsers\Resources\CompanyResource\Pages;

use App\FilamentUsers\Resources\CompanyResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\FilamentUsers\Resources\CompanyResource\Pages;

use App\FilamentUsers\Resources\CompanyResource;
use Auth;
use Filament\Resources\Pages\CreateRecord;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    protected function afterCreate(): void
    {
        $user = Auth::user();
        $company = $this->record;

        $user->attachCompany($company);
    }
}

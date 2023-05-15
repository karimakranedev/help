<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsultationType extends Model
{
    use HasFactory;

    public function consultations():hasMany
    {
        return $this->hasMany(Consultation::class);
    }
}

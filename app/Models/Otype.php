<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Otype extends Model
{
    use HasFactory;

    public function organismes(): hasMany
    {
        return $this->hasMany(Organisme::class);
    }
}

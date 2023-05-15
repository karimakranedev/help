<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ville extends Model
{
    public function region(): belongsTo
    {
        return $this->belongsTo(Region::class);
    }
}

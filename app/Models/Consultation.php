<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Consultation extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasUuid;

    /**
     * Set the value of administration_contact attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setAdministrationEmailAttribute(string $value):void
    {
        // Get the associated organisme
        $organisme = $this->organisme;

        // Set the value of administration_contact to the email of the associated organisme
        $this->attributes['administration_contact'] = $organisme->email;
    }

    public function organisme():belongsTo
    {
        return $this->belongsTo(Organisme::class);
    }

    public function consultationType():belongsTo
    {
        return $this->belongsTo(ConsultationType::class);
    }

    public function secteurs(): BelongsToMany
    {
        return $this->belongsToMany(Secteur::class);
    }
}

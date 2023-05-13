<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    use HasFactory;

    public function secteurs(): BelongsToMany
    {
        return $this->belongsToMany(Secteur::class,'company_secteur');
    }

    /**
     * @return HasMany<User>
     */
    public function users(): HasMany
    {
        return $this->hasMany(
            related: User::class,
            foreignKey: 'company_id',
        );
    }

    /**
     * @return HasOne<User>
     */
    public function owner(): HasOne
    {
        return $this->hasOne(
            User::class,
            'company_id'
        )->where('is_owner', true);
    }

    public static function withoutUserCompanies(): Collection
    {
        return Company::whereDoesntHave('users')->get();
    }

    public function sectors(): BelongsToMany
    {
        return $this->belongsToMany(Secteur::class,'company_secteur');
    }

    public function subscriptions(): hasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscriptions():hasMany
    {
        return $this->hasMany(Subscription::class)
            ->where('end_date', '>=', now())
            ->orWhere('is_valid', true)
            ->orderBy('end_date', 'asc');
    }


}

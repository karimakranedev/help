<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Devaslanphp\FilamentAvatar\Core\HasAvatarUrl;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use SoftDeletes;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasAvatarUrl;

    protected $guard_name='web';


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<Company, User>
     */
    public function company(): belongsTo
    {
        return $this->belongsTo(
            Company::class,
            'company_id',
        );
    }

    public function withoutCompanyUsers(): Collection
    {
        return Company::whereDoesntHave('users')->get();
    }

    public function attachCompany(Company $company): void
    {
        $this->company()->associate($company);
        $this->save();
    }
}

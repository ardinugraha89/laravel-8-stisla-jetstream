<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nip',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%' . $query . '%')
            ->orWhere('nip', 'like', '%' . $query . '%');
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function pelatihan()
    {
        return $this->hasMany(Pelatihan::class);
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class);
    }

    /**
     * Get all of the jabatan for the user.
     */
    public function riwayatJabatan()
    {
        return $this->hasMany(RiwayatJabatan::class);
    }

    /**
     * Get all of the pangkat for the user.
     */
    public function riwayatPangkat()
    {
        return $this->hasMany(RiwayatPangkat::class);
    }

    public function kgb()
    {
        return $this->hasMany(KenaikanGajiBerkala::class);
    }

    public function catatanMutasi()
    {
        return $this->hasMany(CatatanMutasi::class);
    }
}

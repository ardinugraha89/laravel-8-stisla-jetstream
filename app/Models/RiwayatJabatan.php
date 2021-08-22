<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use HasFactory;

    public $table = 'riwayat_jabatans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jabatan_id',
        'user_id',
        'tmt',
        'status',
    ];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('jabatan_id', 'like', '%' . $query . '%')
            ->orWhere('user_id', 'like', '%' . $query . '%');
    }

    /**
     * Get all of the user that are assigned this jabatan.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'assigned');
    }

    /**
     * Get all of the jabatan that are assigned this user.
     */
    public function jabatan()
    {
        return $this->morphedByMany(Jabatan::class, 'assigned');
    }
}

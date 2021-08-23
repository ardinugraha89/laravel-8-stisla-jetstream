<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPangkat extends Model
{
    use HasFactory;
    public $table = 'riwayat_pangkats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pangkat_id',
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
            : static::where('pangkat_id', 'like', '%' . $query . '%')
            ->orWhere('user_id', 'like', '%' . $query . '%');
    }

    /**
     * Get all of the user that are assigned this pangkat.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'assigned');
    }

    /**
     * Get all of the pangkat that are assigned this user.
     */
    public function pangkat()
    {
        return $this->morphedByMany(Pangkat::class, 'assigned');
    }
}

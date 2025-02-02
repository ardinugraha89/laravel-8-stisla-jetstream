<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPangkat extends Model
{
    use HasFactory;
    public $table = 'rank_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rank_id',
        'user_id',
        'tmt',
        'skpangkat',
        'status',
        'dateNaikPangkat',
    ];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('rank_id', 'like', '%' . $query . '%')
            ->orWhere('user_id', 'like', '%' . $query . '%');
    }

    /**
     * Get all of the user that are assigned this pangkat.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the pangkat that are assigned this user.
     */
    public function rank()
    {
        return $this->belongsTo(Pangkat::class);
    }
}

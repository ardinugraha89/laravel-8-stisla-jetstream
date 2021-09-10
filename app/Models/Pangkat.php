<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;
    public $table = 'ranks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'golongan',
    ];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama', 'like', '%' . $query . '%')
            ->orWhere('golongan', 'like', '%' . $query . '%');
    }

    /**
     * Get all of the user for the pangkat.
     */
    public function riwayatPangkat()
    {
        return $this->hasMany(RiwayatPangkat::class);
    }
}

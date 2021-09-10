<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanMutasi extends Model
{
    use HasFactory;
    public $table = 'mutation_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'catatan',
        'tanggal',
        'user_id',
    ];


    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('tanggal', 'like', '%' . $query . '%')
            ->orWhere('user_id', 'like', '%' . $query . '%');
    }

    /**
     * Get all of the user that are assigned this jabatan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

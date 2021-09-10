<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use HasFactory;

    public $table = 'position_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jabatan_id',
        'user_id',
        'tmt',
        'skjabatan',
        'keterangan',
        'status',
    ];

    protected $dates = ['created_at', 'updated_at', 'tmt'];

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the jabatan that are assigned this user.
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}

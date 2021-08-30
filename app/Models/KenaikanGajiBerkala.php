<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanGajiBerkala extends Model
{
    use HasFactory;
    public $table = 'kenaikan_gaji_berkalas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tmt',
        'skkgb',
        'dateKenaikan',
    ];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('user_id', 'like', '%' . $query . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    public $table = 'educations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenjang_pendidikan',
        'nama',
        'tahun_lulus',
        'ijazah_path',
        'user_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = [
    //     'ijazah_url',
    // ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('tahun_lulus', 'like', '%' . $query . '%')
            ->orWhere('nama', 'like', '%' . $query . '%')
            ->orWhere('jenjang_pendidikan', 'like', '%' . $query . '%');
    }
}

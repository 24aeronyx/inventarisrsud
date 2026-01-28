<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cctv extends Model
{
    protected $fillable = [
        'ruangan',
        'brand',
        'kegiatan',
        'tahun'
    ];

    public function perbaikans()
    {
        return $this->morphMany(Perbaikan::class, 'asset');
    }
}

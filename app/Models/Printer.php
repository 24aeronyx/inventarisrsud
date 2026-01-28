<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    protected $fillable = [
        'ruangan',
        'brand',
        'jenis',
        'kegiatan',
        'tahun'
    ];

    public function perbaikans()
    {
        return $this->morphMany(Perbaikan::class, 'asset');
    }
}

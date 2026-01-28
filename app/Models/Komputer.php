<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komputer extends Model
{
    protected $fillable = [
        'ruangan',
        'unit',
        'brand',
        'processor',
        'ram',
        'os',
        'storage_type',
        'storage_capacity',
        'kegiatan',
        'tahun',
        'ip_address'
    ];

    public function perbaikans()
    {
        return $this->morphMany(Perbaikan::class, 'asset');
    }
}

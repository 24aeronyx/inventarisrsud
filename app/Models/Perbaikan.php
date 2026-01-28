<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    protected $fillable = [
        'tgl',
        'asset_id',
        'asset_type',
        'keterangan',
    ];

    public function asset()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Courier extends Model
{
    protected $fillable = [
        'nama_kurir',
        'nomor_telepon',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

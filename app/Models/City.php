<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'nama_kota',
    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}

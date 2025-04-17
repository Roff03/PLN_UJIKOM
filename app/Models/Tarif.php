<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_pelanggan',
        'biaya_beban',
        'tarif_kwh',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tarif) {
            // Hitung jumlah pelanggan yang ada
            $lastNumber = self::max('id') ?? 0;
            $tarif->jenis_pelanggan = 'TKT-' . ($lastNumber + 1);
        });
    }
    
}

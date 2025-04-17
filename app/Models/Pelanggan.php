<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable = [
        'No_kontrol',
        'nama',
        'alamat',
        'no_telepon',
        'jenis_pelanggan',
    ];
    protected static function boot()
{
    parent::boot();

    static::creating(function ($pelanggan) {
        // Hitung jumlah pelanggan yang ada
        $lastNumber = self::max('id') ?? 0;
        $pelanggan->No_kontrol = 'PLG-' . ($lastNumber + 1);
    });
}



}

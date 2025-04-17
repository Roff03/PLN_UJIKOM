<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;
    protected $fillable = [
        'No_kontrol',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir',
        'jumlah_pemakaian',
        'biaya_beban',
        'biaya_pemakaian',
        'tarif_kwh',
        'status_pembayaran',
    ];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($pemakaian) {
            // Hitung jumlah pemakaian
            $pemakaian->jumlah_pemakaian = $pemakaian->meter_akhir - $pemakaian->meter_awal;

            // Hitung biaya pemakaian
            if (
                is_numeric($pemakaian->jumlah_pemakaian) &&
                is_numeric($pemakaian->tarif_kwh) &&
                is_numeric($pemakaian->biaya_beban)
            ) {
                $pemakaian->biaya_pemakaian = ($pemakaian->jumlah_pemakaian * $pemakaian->tarif_kwh) + $pemakaian->biaya_beban;
            } else {
                $pemakaian->biaya_pemakaian = 0;
            }
        });
    }


// public function pemakaians()
// {
//     return $this->hasMany(Pemakaian::class, 'no_kontrol', 'no_kontrol');
// }

}

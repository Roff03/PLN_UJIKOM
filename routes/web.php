<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pemakaian;
use App\Http\Controllers\CekPelangganController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pemakaian', [CekPelangganController::class, 'index'])->name('pemakaian.index');

// Route::get('/cekpelanggan',[CekPelangganController::class,'index']);
// Route::post('cekpelanggan',[CekPelangganController::class,'cek']);

Route::get('/admin/lihat-pemakaians/print', function () {
    $query = Pemakaian::query();

    if (request('tableFilters')) {
        $filters = json_decode(request('tableFilters'), true);

        if (!empty($filters['bulan']['value'])) {
            $query->where('bulan', $filters['bulan']['value']);
        }
        if (!empty($filters['tahun']['value'])) {
            $query->where('tahun', $filters['tahun']['value']);
        }
        if (!empty($filters['no_kontrol']['value'])) {
            $query->where('no_kontrol', $filters['no_kontrol']['value']);
        }
    }

    $pemakaians = $query->get();

    return view('filament.print.filtered', compact('pemakaians'));
})->name('filament.print.filtered');

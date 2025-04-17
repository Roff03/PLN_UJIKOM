<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemakaian;
use App\Models\Pelanggan;

class CekpelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemakaian::query();

        if ($request->filled('no_kontrol')) {
            $query->where('no_kontrol', $request->no_kontrol);
        }

        $data = $query->latest()->paginate(10);

        $pelanggan = null;
        if ($request->filled('no_kontrol')) {
            $pelanggan = Pelanggan::where('no_kontrol', $request->no_kontrol)->first();
        }

        return view('cekpelanggan', [
            'data' => $data,
            'no_kontrol' => $request->no_kontrol,
            'pelanggan' => $pelanggan, // kirim ke view
        ]);
    }
}

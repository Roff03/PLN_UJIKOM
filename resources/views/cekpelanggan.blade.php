<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            input,
            form,
            h2,
            h3,
            button,
            label {
                display: none !important;
            }
        }
    </style>
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans p-6">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Data Pemakaian</h1>

        <!-- Form Filter -->
        <form method="GET" action="/pemakaian" class="mb-6 flex gap-4 flex-wrap">
            <div>
                <label for="no_kontrol" class="block text-sm font-medium text-gray-700">No Kontrol</label>
                <input
                    type="text"
                    name="no_kontrol"
                    id="no_kontrol"
                    value="{{ $no_kontrol ?? '' }}"
                    class="mt-1 block w-64 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Masukkan No Kontrol"
                >
            </div>
            <div class="self-end">
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700"
                >
                    Cari
                </button>
            </div>
        </form>

        <!-- Jika Tidak Ada Data -->
        @if ($data->isEmpty())
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded shadow">
                Data tidak ditemukan untuk No Kontrol tersebut.
            </div>
        @else
            <!-- Tabel Data -->
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">No Kontrol</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Nama Pelanggan</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Alamat</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Bulan</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Tahun</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Meter Awal</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Meter Akhir</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Jumlah Pemakaian</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Biaya Beban</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Tarif KWH</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Biaya Pemakaian</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($data as $pemakaian)
                        <tr class="hover:bg-gray-50 w-full">
                            <td class="px-4 py-2">{{ $pemakaian->no_kontrol }}</td>
                            <td class="px-4 py-2">{{ $pelanggan->nama }}</td>
                            <td class="px-4 py-2">{{ $pelanggan->alamat }}</td>
                            <td class="px-4 py-2">{{ $pemakaian->bulan }}</td>
                            <td class="px-4 py-2">{{ $pemakaian->tahun }}</td>
                            <td class="px-4 py-2">{{ $pemakaian->meter_awal }}</td>
                            <td class="px-4 py-2">{{ $pemakaian->meter_akhir }}</td>
                            <td class="px-4 py-2">{{ $pemakaian->jumlah_pemakaian }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($pemakaian->biaya_beban, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($pemakaian->tarif_kwh, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($pemakaian->biaya_pemakaian, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $pemakaian->status_pembayaran }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button
            onclick="window.print()"
            class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors no-print"
        >
        Print Laporan
        </button>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $data->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</body>
</html>

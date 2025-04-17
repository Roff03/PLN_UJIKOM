<!DOCTYPE html>
<html>
<head>
    <title>Print Pemakaian</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #333; padding: 8px; text-align: left; }
        .header { text-align: center; }
    </style>
</head>
<body onload="window.print()">

    <h2 class="header">Laporan Pemakaian</h2>

    <table>
        <thead>
            <tr>
                <th>No Kontrol</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Meter Awal</th>
                <th>Meter Akhir</th>
                <th>Jumlah Pemakaian</th>
                <th>Biaya Beban</th>
                <th>Tarif KWH</th>
                <th>Biaya Pemakaian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemakaians as $item)
                <tr>
                    <td>{{ $item->no_kontrol }}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->meter_awal }}</td>
                    <td>{{ $item->meter_akhir }}</td>
                    <td>{{ $item->jumlah_pemakaian }}</td>
                    <td>Rp {{ number_format($item->biaya_beban) }}</td>
                    <td>Rp {{ number_format($item->tarif_kwh) }}</td>
                    <td>Rp {{ number_format($item->biaya_pemakaian) }}</td>
                    <td>{{ $item->status_pembayaran }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

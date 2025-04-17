<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


// contoh html

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')

</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Daftar Pelanggan</h1>

        <!-- Tabel Pelanggan -->
        <table class="min-w-full table-auto bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Telepon</th>
                    <th class="px-6 py-3 text-left">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-4 text-gray-700">{{ $customer->id }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $customer->name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $customer->email }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $customer->phone }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $customer->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>


// contoh controller untuk memanggil data 
<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Tampilkan daftar pelanggan.
     */
    public function index()
    {
        // Ambil semua data customer dari database
        $customers = Customer::all(); // Bisa pakai paginate() juga

        // Kirim data ke view resources/views/customers/index.blade.php
        return view('customers.index', compact('customers'));
    }
}

//contoh table memanggil data saja
<?php

namespace App\Filament\Resources\CustomerResource;

use App\Models\Customer;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use App\Filament\Resources\CustomerResource;

class Table extends \Filament\Resources\Table
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),

                TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),

                TextColumn::make('phone')
                    ->label('Telepon'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Tanggal Buat'),
            ])
            ->filters([
                // Tambahkan filter di sini kalau butuh
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}

TextColumn::make('name') → Menampilkan kolom name dari tabel customers.

searchable() / sortable() → Bisa dicari dan diurutkan.

created_at->dateTime() → Format tanggal & waktu otomatis.

actions → Tombol edit, lihat, hapus di sebelah kanan tabel.

bulkActions → Bisa pilih banyak baris lalu hapus sekaligus.

// Uppercase teks
TextColumn::make('name')
    ->formatStateUsing(fn($state) => strtoupper($state));

// Relasi kolom (user.name)
TextColumn::make('user.name')
    ->label('Nama User');

// Format tanggal custom
TextColumn::make('created_at')
    ->date('d M Y');

// Kolom status + icon + warna
TextColumn::make('status')
    ->icon(fn($s) => $s == 'active' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
    ->color(fn($s) => $s == 'active' ? 'success' : 'danger');

// Email jadi klik mailto
TextColumn::make('email')
    ->url(fn($record) => 'mailto:' . $record->email)
    ->openUrlInNewTab();

// Truncate text panjang + tooltip
TextColumn::make('address')
    ->limit(30)
    ->tooltip(fn($record) => $record->address);

// Boolean Ya/Tidak
TextColumn::make('is_active')
    ->boolean()
    ->label('Aktif?');

// Searchable dan sortable
TextColumn::make('phone')
    ->searchable()
    ->sortable();

// Link ke detail route
TextColumn::make('name')
    ->url(fn($r) => route('customers.show', $r));

// Format nomor telepon
TextColumn::make('phone')
    ->formatStateUsing(fn($s) => '+62 ' . $s);

// Tampilkan panjang karakter
TextColumn::make('bio')
    ->formatStateUsing(fn($s) => strlen($s) . ' karakter');

// Status dengan emoji
TextColumn::make('status')
    ->formatStateUsing(fn($s) => $s == 'active' ? '✅ Aktif' : '❌ Tidak Aktif');

// Warna teks dinamis
TextColumn::make('score')
    ->color(fn($s) => $s > 80 ? 'success' : 'danger');

// Tanggal tanpa jam
TextColumn::make('created_at')
    ->date('d-m-Y');

// Kolom harga (Rp.)
TextColumn::make('price')
    ->money('IDR');

// Potong hanya 2 kata pertama
TextColumn::make('description')
    ->formatStateUsing(fn($s) => \Str::words($s, 2));

// Label kolom custom
TextColumn::make('full_name')
    ->label('Nama Lengkap');


//filament
use Filament\Forms\Components\TextInput;  (untuk text input)

use Filament\Tables\Table;  (untuk tabel)

use Filament\Tables\Columns\TextColumn;  (untuk text column)

use Filament\Tables\Columns\IconColumn;  (icon column)
IconColumn::make('status')
    ->icon(fn (string $state): string => match ($state) {
        'draft' => 'heroicon-o-pencil',
        'reviewing' => 'heroicon-o-clock',
        'published' => 'heroicon-o-check-circle',
    })

use Filament\Tables\Columns\ImageColumn;  (ImageColumn)
ImageColumn::make('avatar')
use Filament\Tables\Columns\SelectColumn;

SelectColumn::make('status')   (SelectColumn)
    ->options([
        'draft' => 'Draft',
        'reviewing' => 'Reviewing',
        'published' => 'Published',
    ])

use Filament\Tables\Columns\TextInputColumn;   (text TextInputColumn)
TextInputColumn::make('email')

// resources
php artisan make:filament-resource Test

//migrate dan model 
php artisan make:model nama -m

// template blade

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cek Data Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
    
            input,
            form,
            h2,
            h3,
            button {
                display: none !important;
            }
        }
    </style>
    
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Cari Pelanggan berdasarkan ID</h2>

        <form action="/cekpelanggan" method="POST" class="space-y-4">
            @csrf
            <input 
                type="number" 
                name="id" 
                placeholder="Masukkan ID Pelanggan" 
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors"
            >
                Cari
            </button>
       <button 
            onclick="window.print()" 
            class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors no-print"
        >
        Print Laporan
        </button>

        </form>

        @if(isset($pakai))
            <div class="mt-6">
                @if($pakai)
                    <h3 class="text-lg font-semibold text-green-600 mb-2">Data Ditemukan:</h3>
                    <ul class="space-y-1 text-gray-700">
                        <li><strong>Nama:</strong> {{ $pakai->meter_awal }}</li>
                        <li><strong>Alamat:</strong> {{ $pakai->meter_akhir }}</li>
                        <li><strong>Umur:</strong> {{ $pakai->pemakaian }}</li>
                        {{-- <li><strong>No hp:</strong> {{ $pelanggan->no_hp }}</li> --}}
                    </ul>
                @else
                    <p class="text-red-500 mt-4">Data dengan ID tersebut tidak ditemukan.</p>
                @endif
            </div>
        @endif
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cek Data Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
    
            input,
            form,
            h2,
            h3,
            button {
                display: none !important;
            }
        }
    </style>
    
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Cari Pelanggan berdasarkan ID</h2>

        <form action="/cekpelanggan" method="POST" class="space-y-4">
            @csrf
            <input 
                type="number" 
                name="id" 
                placeholder="Masukkan ID Pelanggan" 
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors"
            >
                Cari
            </button>
       <button 
            onclick="window.print()" 
            class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors no-print"
        >
        Print Laporan
        </button>

        </form>

        @if(isset($pelanggan))
            <div class="mt-6">
                @if($pelanggan)
                    <h3 class="text-lg font-semibold text-green-600 mb-2">Data Ditemukan:</h3>
                    <ul class="space-y-1 text-gray-700">
                        <li><strong>Nama:</strong> {{ $pelanggan->nama }}</li>
                        <li><strong>Alamat:</strong> {{ $pelanggan->alamat }}</li>
                        <li><strong>Umur:</strong> {{ $pelanggan->umur }}</li>
                        <li><strong>No hp:</strong> {{ $pelanggan->no_hp }}</li>
                    </ul>                                               
                @else
                    <p class="text-red-500 mt-4">Data dengan ID tersebut tidak ditemukan.</p>
                @endif
            </div>
        @endif
    </div>
</body>
</html>

// function model role untuk resource    

    public function isAdmin():bool
    {
        return $this->role == 'admin';
    }

    public function isUser():bool
    {
        return $this->role == 'user';
    }


// resource nya

use Filament\Forms\Components\Select;

Select::make('role')
                    ->options([
                        'admin' =>'Admin',
                        'user' =>'User',
                    ]),

use Filament\Forms\Components\Select; -> untuk select
use Filament\Tables\Columns\TextColumn; -> text column
use Filament\Forms\Components\TextInput; -> text input

// contoh controller untuk cek pelanggan

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class CekPelangganController extends Controller
{
    public function index()
    {
        return view ('cekpelanggan');
    }

    public function cek (Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);

        $pelanggan = pelanggan::find($request->id);
        return view ('cekpelanggan',compact('pelanggan'));

    }
}

// membatasi akses user / admin
public static function canAccess(): bool
{
    return auth()->check() && auth()->user()->role === 'admin';
}

// web php nya

use App\Http\Controllers\CekPelangganController;

Route::get('/cekpelanggan',[CekPelangganController::class,'index']);
Route::post('cekpelanggan',[CekPelangganController::class,'cek']);

// membawa data relasi dengan resource lain

   Select::make('tipe_nama')
                ->label('Tipe')
                ->options(\App\Models\Tipe::pluck('tipe_nama', 'tipe_nama')) /tamba key dan value = tipe_nama
                ->required(),

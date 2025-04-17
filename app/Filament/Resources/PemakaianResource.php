<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemakaianResource\Pages;
use App\Models\Pemakaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PemakaianResource extends Resource
{
    protected static ?string $model = Pemakaian::class;
    protected static ?string $label = 'Data Pemakaian';
    protected static ?string $navigationLabel = 'Tambah Data Pemakaian';
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('No_kontrol')
                    ->label('No Kontrol')
                    ->options(\App\Models\Pelanggan::pluck('No_kontrol', 'No_kontrol'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        $pelanggan = \App\Models\Pelanggan::where('No_kontrol', $state)->first();
                        if ($pelanggan) {
                            $tarif = \App\Models\Tarif::where('jenis_pelanggan', $pelanggan->jenis_pelanggan)->first();
                            if ($tarif) {
                                $set('biaya_beban', $tarif->biaya_beban);
                                $set('tarif_kwh', $tarif->tarif_kwh);
                            }
                        }
                    }),

                Select::make('bulan')
                    ->required()
                    ->label('Bulan')
                    ->options([
                        'Januari' => 'Januari',
                        'Februari' => 'Februari',
                        'Maret' => 'Maret',
                        'April' => 'April',
                        'Mei' => 'Mei',
                        'Juni' => 'Juni',
                        'Juli' => 'Juli',
                        'Agustus' => 'Agustus',
                        'September' => 'September',
                        'Oktober' => 'Oktober',
                        'November' => 'November',
                        'Desember' => 'Desember',
                    ])
                    ->placeholder('Pilih Bulan')
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, $get) =>
                        self::setMeterAwal($set, $get)
                    ),

                TextInput::make('tahun')
                    ->required()
                    ->label('Tahun')
                    ->numeric()
                    ->minValue(2025)
                    ->maxValue(2222)
                    ->placeholder('Tahun')
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, $get) =>
                        self::setMeterAwal($set, $get)
                    ),

                TextInput::make('meter_awal')
                    ->numeric()
                    ->readOnly()
                    ->default(0)
                    ->placeholder('Meter awal bernilai 0')
                    ->label('Meter Awal'),

                TextInput::make('meter_akhir')
                    ->required()
                    ->numeric()
                    ->label('Meter Akhir')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        $jumlah = $state - $get('meter_awal');
                        $set('jumlah_pemakaian', $jumlah);
                        self::calculateBiayaPemakaian($set, $get);
                    }),

                TextInput::make('jumlah_pemakaian')
                    ->readOnly()
                    ->numeric()
                    ->label('Jumlah Pemakaian'),

                Select::make('biaya_beban')
                    ->label('Biaya Beban')
                    ->options(\App\Models\Tarif::pluck('biaya_beban', 'biaya_beban'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, $get) =>
                        self::calculateBiayaPemakaian($set, $get)
                    ),

                Select::make('tarif_kwh')
                    ->label('Tarif KWH')
                    ->options(\App\Models\Tarif::pluck('tarif_kwh', 'tarif_kwh'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, $get) =>
                        self::calculateBiayaPemakaian($set, $get)
                    ),

                TextInput::make('biaya_pemakaian')
                    ->readOnly()
                    ->numeric()
                    ->label('Biaya Pemakaian')
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_kontrol'),
                TextColumn::make('bulan'),
                TextColumn::make('tahun'),
                TextColumn::make('meter_awal'),
                TextColumn::make('meter_akhir'),
                TextColumn::make('jumlah_pemakaian'),
                TextColumn::make('biaya_beban'),
                TextColumn::make('biaya_pemakaian'),
                TextColumn::make('tarif_kwh'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPemakaians::route('/'),
            'create' => Pages\CreatePemakaian::route('/create'),
            'edit' => Pages\EditPemakaian::route('/{record}/edit'),
        ];
    }

    // ✅ Fungsi hitung meter_awal dari bulan sebelumnya
    protected static function setMeterAwal(callable $set, callable $get): void
    {
        $no_kontrol = $get('No_kontrol');
        $bulan = $get('bulan');
        $tahun = $get('tahun');

        if (!$no_kontrol || !$bulan || !$tahun) {
            return;
        }

        $daftarBulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        $indexBulan = array_search($bulan, $daftarBulan);

        if ($indexBulan === false) return;

        if ($indexBulan === 0) {
            $bulanSebelumnya = 'Desember';
            $tahunSebelumnya = $tahun - 1;
        } else {
            $bulanSebelumnya = $daftarBulan[$indexBulan - 1];
            $tahunSebelumnya = $tahun;
        }

        $pemakaianSebelumnya = \App\Models\Pemakaian::where('No_kontrol', $no_kontrol)
            ->where('bulan', $bulanSebelumnya)
            ->where('tahun', $tahunSebelumnya)
            ->first();

        if ($pemakaianSebelumnya) {
            $set('meter_awal', $pemakaianSebelumnya->meter_akhir);
        } else {
            $set('meter_awal', 0);
        }
    }

    // ✅ Fungsi hitung biaya_pemakaian
    protected static function calculateBiayaPemakaian(callable $set, callable $get): void
    {
        $jumlah_pemakaian = $get('jumlah_pemakaian');
        $tarif_kwh = $get('tarif_kwh');
        $biaya_beban = $get('biaya_beban');

        if (is_numeric($jumlah_pemakaian) && is_numeric($tarif_kwh) && is_numeric($biaya_beban)) {
            $biaya_pemakaian = ($jumlah_pemakaian * $tarif_kwh) + $biaya_beban;
            $set('biaya_pemakaian', $biaya_pemakaian);
        } else {
            $set('biaya_pemakaian', 0);
        }
    }
}

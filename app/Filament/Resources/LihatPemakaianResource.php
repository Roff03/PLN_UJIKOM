<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LihatPemakaianResource\Pages;
use App\Filament\Resources\LihatPemakaianResource\RelationManagers;
use App\Models\Pemakaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\SelectColumn;



class LihatPemakaianResource extends Resource
{
    protected static ?string $model = Pemakaian::class;
    protected static ?string $navigationLabel = 'Proses pembayaran'; // Nama menu di sidebar
    protected static ?string $label = 'riwayat pembayaran'; // Label untuk resource
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_kontrol')->label('No Kontrol'),
                TextColumn::make('bulan')->label('Bulan'),
                TextColumn::make('tahun')->label('Tahun'),
                TextColumn::make('meter_awal')->label('Meter Awal'),
                TextColumn::make('meter_akhir')->label('Meter Akhir'),
                TextColumn::make('jumlah_pemakaian')->label('Jumlah Pemakaian'),
                TextColumn::make('biaya_beban')->label('Biaya Beban'),
                TextColumn::make('tarif_kwh')->label('Tarif KWH'),
                TextColumn::make('biaya_pemakaian')->label('Biaya Pemakaian'),

                      // Kolom Select untuk Status Pembayaran
                      SelectColumn::make('status_pembayaran')
                      ->label('Status Pembayaran')
                      ->options([
                          'Lunas' => 'Lunas',
                          'Belum Lunas' => 'Belum Lunas',
                      ])

                      ->sortable()
                      ->searchable(),
            ])

            ->filters([
                SelectFilter::make('bulan')
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
                    ]),
                SelectFilter::make('tahun')
                    ->label('Tahun')
                    ->options([
                        '2025' => '2025',
                        '2026' => '2026',
                        '2027' => '2027',
                        '2028' => '2028',
                        '2029' => '2029',
                        '2030' => '2030',
                    ]),

                    SelectFilter::make('no_kontrol')
                    ->label('No Kontrol')
                    ->options(fn () => Pemakaian::query()
                        ->pluck('no_kontrol', 'no_kontrol')
                        ->unique()
                        ->toArray()
                    )
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('printFiltered')
                    ->label('Print Filtered Data')
                    ->icon('heroicon-o-printer')
                    ->url(fn (Tables\Actions\Action $action) => url()->current() . '/print?' . request()->getQueryString())
                    ->openUrlInNewTab(),
            ])

            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLihatPemakaians::route('/'),
            'create' => Pages\CreateLihatPemakaian::route('/create'),
            'edit' => Pages\EditLihatPemakaian::route('/{record}/edit'),
        ];
    }
}

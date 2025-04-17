<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelangganResource\Pages;
use App\Filament\Resources\PelangganResource\RelationManagers;
use App\Models\Pelanggan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelangganResource extends Resource
{
    protected static ?string $model = Pelanggan::class;
    protected static ?string $navigationLabel = 'Pelanggan'; // Nama menu di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                    ->label('ID Kontrol')
                    ->disabled(),

                TextInput::make('nama')
                    ->required()
                    ->label('Nama'),
                TextInput::make('alamat')
                    ->required()
                    ->label('Alamat'),
                TextInput::make('no_telepon')
                    ->required()
                    ->label('No Telepon')
                    ->maxLength(12)
                    ->minvalue(1),
                Select::make('jenis_pelanggan')
                    ->label('jenis pelanggan')
                    ->options(\App\Models\Tarif::pluck('jenis_pelanggan', 'jenis_pelanggan')) // key dan value = tipe_nama
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No_kontrol'),
                TextColumn::make('nama'),
                TextColumn::make('alamat'),
                TextColumn::make('no_telepon'),
                TextColumn::make('jenis_pelanggan'),
                TextColumn::make('created_at'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListPelanggans::route('/'),
            'create' => Pages\CreatePelanggan::route('/create'),
            'edit' => Pages\EditPelanggan::route('/{record}/edit'),
        ];
    }
}

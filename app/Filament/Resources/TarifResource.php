<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TarifResource\Pages;
use App\Filament\Resources\TarifResource\RelationManagers;
use App\Models\Tarif;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TarifResource extends Resource
{
      public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }
    protected static ?string $model = Tarif::class;
    protected static ?string $navigationLabel = 'Tarif Listrik'; // Nama menu di sidebar

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('jenis_pelanggan')
                    ->disabled()
                    ->label('Jenis Pelanggan'),
                TextInput::make('biaya_beban')
                    ->required()
                    ->label('Biaya Beban')
                    ->numeric()
                    ->minValue(1),
                TextInput::make('tarif_kwh')
                    ->required()
                    ->label('tarif_kwh')
                    ->numeric()
                    ->minvalue(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_pelanggan')
                    ->label('Jenis Pelanggan'),
                TextColumn::make('biaya_beban')
                    ->label('Biaya Beban'),
                TextColumn::make('tarif_kwh')
                    ->label('Tarif KWH'),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListTarifs::route('/'),
            'create' => Pages\CreateTarif::route('/create'),
            'edit' => Pages\EditTarif::route('/{record}/edit'),
        ];
    }
}

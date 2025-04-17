<?php

namespace App\Filament\Resources;
use Illuminate\Support\Facades\Hash;

use App\Filament\Resources\TambahPetugasResource\Pages;
use App\Filament\Resources\TambahPetugasResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TambahPetugasResource extends Resource
{
            public static function canAccess(): bool
        {
            return auth()->check() && auth()->user()->role === 'admin';
        }
    protected static ?string $model = User::class;
    protected static ?string $label = 'Menambahklan user'; // Label untuk resource
    protected static ?string $navigationLabel = 'Tambah User (admin dan petugas)'; // Nama menu di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nama'),
                TextInput::make('email')
                    ->required()
                    ->label('Email')
                    ->email(),
                TextInput::make('password')
                    ->required()
                    ->label('Password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)), // Hash the password before saving // Ensure the input is treated as a password
                Select::make('role')
                    ->required()
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'petugas' => 'Petugas',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('role'),
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTambahPetugas::route('/'),
            'create' => Pages\CreateTambahPetugas::route('/create'),
            'edit' => Pages\EditTambahPetugas::route('/{record}/edit'),
        ];
    }
}

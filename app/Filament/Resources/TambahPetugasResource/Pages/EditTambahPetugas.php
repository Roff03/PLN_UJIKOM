<?php

namespace App\Filament\Resources\TambahPetugasResource\Pages;

use App\Filament\Resources\TambahPetugasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTambahPetugas extends EditRecord
{
    protected static string $resource = TambahPetugasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

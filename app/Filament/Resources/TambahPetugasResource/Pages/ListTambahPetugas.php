<?php

namespace App\Filament\Resources\TambahPetugasResource\Pages;

use App\Filament\Resources\TambahPetugasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTambahPetugas extends ListRecords
{
    protected static string $resource = TambahPetugasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

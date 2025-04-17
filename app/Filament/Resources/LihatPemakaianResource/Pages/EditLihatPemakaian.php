<?php

namespace App\Filament\Resources\LihatPemakaianResource\Pages;

use App\Filament\Resources\LihatPemakaianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLihatPemakaian extends EditRecord
{
    protected static string $resource = LihatPemakaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\LihatPemakaianResource\Pages;

use App\Filament\Resources\LihatPemakaianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLihatPemakaians extends ListRecords
{
    protected static string $resource = LihatPemakaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

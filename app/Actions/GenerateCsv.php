<?php

namespace App\Actions;
use Illuminate\Database\Eloquent\Collection;
class GenerateCsv
{
    public function __invoke (Collection $parcels)
    {
        $fileContents = 'Содержимое вашего файла';
    
        // Возвращаем файл для скачивания
        return response()->streamDownload(function () use ($fileContents) {
            echo $fileContents;
        }, 'filename.csv');
    }
}
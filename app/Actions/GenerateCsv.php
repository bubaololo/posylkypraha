<?php

namespace App\Actions;
use Illuminate\Database\Eloquent\Collection;
class GenerateCsv
{
    public function __invoke (Collection $parcels)
    {
        $fileName = 'parcels_export_' . date('Ymd') . '.csv';
        
        $headers = [
            "Content-Encoding" => "UTF-8",
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
    
        return response()->streamDownload(function () use ($parcels) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            // Заголовки столбцов
            fputcsv($file, ['Sender', 'Addressee',
                'Postcode', 'Region','Rayon','City, town','улица','дом','корпус','квартира', 'телефон',
                'Номер вложения','Описание вложения','weight kg', 'weight g','количество','объявленная ценность']);
            // Заполнение данных
            foreach ($parcels as $parcel) {
//                dd($parcel->enclosures);
                $enclosureIndex = 1;
                foreach($parcel->enclosures as $enclosure) {
                    
                    fputcsv($file, [
                        $parcel->sender->name.' '.$parcel->sender->surname,
                        $parcel->recipient->name.' '.$parcel->recipient->surname,
                        $parcel->address->postal_code,
                        $parcel->address->region,
                        $parcel->address->admin_area,
                        $parcel->address->city,
                        $parcel->address->street,
                        $parcel->address->house,
                        $parcel->address->building,
                        $parcel->address->apartment,
                        $parcel->recipient->tel,
                        $enclosureIndex,
                        $enclosure->description,
                        $enclosure->weight_kg,
                        $enclosure->weight_g,
                        $enclosure->quantity,
                        $enclosure->value,
                        ]);
                    $enclosureIndex++;
                }
            }
        
            fclose($file);
        }, $fileName, $headers);
    }
}
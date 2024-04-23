<?php

namespace App\Actions;
use Filament\Notifications\Notification;
use App\Models\Parcel;
use VyfakturujAPI;

class GenerateInvoice
{
    public function __invoke(Parcel $parcel) {
    
    $sender = $parcel->sender->name . ' ' . $parcel->sender->surnaname;
    
    $enclosures = $parcel->enclosures;
        $items = $enclosures->map(function ($enclosure) {
            return [
                'text' => $enclosure['description'], // Название вложения из 'description'
                'unit_price' => $enclosure['value'], // Цена вложения из 'value'
                'vat_rate' => 15 // Фиксированная ставка НДС
            ];
        })->toArray();
        
        $vyfakturuj_api = new VyfakturujAPI(env('VYFAKTURUJ_API_LOGIN'), env('VYFAKTURUJ_API_KEY'));
    
        $params = [
            'type' => 1,
            'calculate_vat' => 2,
            'id_payment_method' => 170033,
            'customer_IC' => '123456789',
            'customer_DIC' => 'CZ123456789',
            'customer_name' => $sender,
            'customer_street' => 'Pouliční 79/C',
            'customer_city' => 'Praha',
            'customer_zip' => '10300',
            'customer_country_code' => 'CZ',
            'currency' => 'EUR',
            'items' => $items
        ];
    
        $invoice = $vyfakturuj_api->createInvoice($params);
//        dd($invoice);
//        dd(json_encode($invoice, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    
        return Notification::make()
            ->title('Счёт фактура отправлена')
            ->success()
            ->persistent()
            ->send();
    
    }
}
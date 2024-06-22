<?php

namespace App\Actions;

use App\Models\Parcel;
use Filament\Notifications\Notification;
use VyfakturujAPI;

class GenerateInvoice
{
    public function __invoke(Parcel $parcel)
    {
        
        $sender = $parcel->sender->name . ' ' . $parcel->sender->surname;

//        $enclosures = $parcel->enclosures;
//        $items = $enclosures->map(function ($enclosure) {
//            return [
//                'text' => $enclosure['description'], // Название вложения из 'description'
//                'unit_price' => $enclosure['value'], // Цена вложения из 'value'
//                'vat_rate' => 15 // Фиксированная ставка НДС
//            ];
//        })->toArray();

//        $items = [['text' => 'delivery service', 'unit_price' => $parcel->delivery_cost, 'vat_rate' => 15]];
        
        $vyfakturuj_api = new VyfakturujAPI(env('VYFAKTURUJ_API_LOGIN'), env('VYFAKTURUJ_API_KEY'));
        $items = $this->formItemsObj($parcel);
        $params = [
            'type' => 1,
            'calculate_vat' => 2,
            'id_payment_method' => 170034,
            'customer_name' => $sender,
            'customer_street' => $parcel->sender->address,
            'customer_city' => $parcel->sender->city,
            'customer_zip' => $parcel->sender->postal_code,
            'customer_country_code' => 'CZ',
            'currency' => 'CZK',
            'items' => $items
        ];
        
        $invoice = $vyfakturuj_api->createInvoice($params);
        $invoiceId = $invoice['id'];
        
        $emailParams = [
            'type' => 1,
            'to' => $parcel->sender->email,
//    'cc' => '',
//    'bcc' => '',
//            'subject' => 'ururu',
//            'body' => 'azaza',
            'pdfAttachment' => true,
        ];
        $result = $vyfakturuj_api->invoice_sendMail($invoiceId, $emailParams);
        
        return Notification::make()
            ->title('Счёт фактура' . $invoiceId . ' отправлена')
            ->success()
            ->persistent()
            ->send();
    }
    
    protected function formItemsObj(Parcel $parcel): array
    {
        $courierDelivery = $parcel->custom_delivery;
        $serviceCost = ($courierDelivery) ? 400 : 200;
        $deliveryType = $parcel->delivery_type;
        switch ($deliveryType) {
            case 'ems':
                $deliveryText = 'Poštovné EMS';
                break;
            case 'post':
                $deliveryText = 'Poštovné';
                break;
            default:
                $deliveryText = 'Неизвестный тип услуги';
        }
        
        $items = [];
        $items[] = ['text' => $deliveryText, 'unit_price' => $parcel->delivery_cost - $serviceCost, 'vat_rate' => 15];
        $items[] = ['text' => 'Administrativní poplatek ', 'unit_price' => 200, 'vat_rate' => 15];
        if ($courierDelivery) {
            $items[] = ['text' => 'Výjezd kurira', 'unit_price' => 200, 'vat_rate' => 15];
        }
        return $items;
    }
    
}
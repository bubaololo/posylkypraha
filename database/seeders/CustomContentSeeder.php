<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('custom_contents')->insert([
            'checkout_thanks' => 'Спасибо, что воспользовались нашим сервисом!
Пожалуйста, распечатайте Ваш трек номер на принтере или напишите его разборчиво на коробке, для дальнейших инструкций свяжитесь с нашей поддержкой https://t.me/posylky_praha, указав свой номер заказа.',
        ]);
    }
}

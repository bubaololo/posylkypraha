<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Keyboard;
use Tests\DuskTestCase;

class CartTest extends DuskTestCase
{
    use DatabaseMigrations;
    
//    public function setUp(): void
//    {
//        parent::setUp();
//        $this->artisan('db:seed');
//    }
    
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://parcel.loc/parcel')
                    ->assertSee('Содержимое посылки')
            ->waitFor('.package-item')
            ->type('items[0][description]', 'описание первого вложения')
            ->type('items[0][weight_kg]', '2')
            ->type('items[0][weight_g]', '300')
            ->type('items[0][value]', '20')
            ->click('.btn-outline-secondary')
            ->type('items[1][description]', 'описание второго вложения')
            ->type('items[1][weight_kg]', '1')
            ->type('items[1][weight_g]', '200')
            ->type('items[1][value]', '15')
            ->click('.delivery-selector')
            ->click('.form-check-label')
            ->type('sender_surname', 'Фамилия Отправителя')
            ->type('sender_name', 'Имя Отправителя')
            ->type('sender_city', 'Praha')
            ->type('sender_address', 'Адрес в Праге')
            ->type('sender_postal_code', '55555')
            ->pause(2000)
            ->click('#sender-credentials-button')
            ->pause(1000)
            ->type('address', 'Калининград, улица Карла Маркса, 82')
            ->pause(10000)
//                ->press('[data-suggest="true"]')
//                ->pause(2000)
//                ->click('.delivery-selector')
//->keys('address', '{tab}')
            ->type('apartment', '56')
            ->click('#address-button')
            ->type('recipient_surname', 'Тереньтьев')
            ->type('recipient_name', 'Михаил')
            ->type('recipient_name', 'Михаил')
            ->type('telephone', '8968102559')
            ->pause(100000);

//            $browser->clickLink('в корзину');
//            $browser->pause(1000);
//            $browser->waitForTextIn('.cart-accent', '1', 1);
//            $browser->assertSeeIn('.cart-accent', '1');
//            $browser->scrollTo('.btn-accent-arrow');
//            $browser->pause(1000);
    
//            $browser->click('.btn-accent-arrow');
//            $browser->assertPathIs('/cart');//            foreach($browser->elements('.add-to-cart') as $toCart) {
//            $browser->click($toCart);
//                $browser->pause(1000);
//            }

        });
    }
}

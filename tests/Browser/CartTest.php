<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CartTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
    
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://muhostore.loc/')
                    ->assertSee('Сибирские');
            $browser->waitFor('.product-list');
            $browser->scrollTo('.product-list');
            $browser->pause(1000);

//            $browser->clickLink('в корзину');
            $browser->click('.add-to-cart');
            $browser->pause(1000);
            $browser->waitForTextIn('.cart-accent', '1', 1);
            $browser->assertSeeIn('.cart-accent', '1');
            $browser->scrollTo('.btn-accent-arrow');
            $browser->pause(1000);
    
            $browser->click('.btn-accent-arrow');
            $browser->assertPathIs('/cart');//            foreach($browser->elements('.add-to-cart') as $toCart) {
//            $browser->click($toCart);
//                $browser->pause(1000);
//            }

        });
    }
}

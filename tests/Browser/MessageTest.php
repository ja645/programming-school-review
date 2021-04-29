<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MessageTest extends DuskTestCase
{
    use DatabeseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testMessageComponent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                    ->assertVue('message["message"]');
        });
    }
}

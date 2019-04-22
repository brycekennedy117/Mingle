<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    private $appUrl;
    private $user = null;


    protected function setUp(): void
    {
        parent::setUp();
        if ($this->user == null) {
            $this->appUrl = getenv('APP_URL', 'http://localhost:8888');
            $this->user = factory(User::class)->create();
        }
    }

    public function testBasicExample()
    {
        $user = User::all()->random(1)[0];
        $this->actingAs($user)->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('.links > a')
                    ->assertUrlIs($this->appUrl.'/login');
        });
        $this->browse(function (Browser $browser) {
            $e = $browser->visit('/')->element('.links > a:nth-child(2n)')
                            ->getAttribute('innerHTML');
        });
    }

}

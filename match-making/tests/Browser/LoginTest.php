<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class LoginTest extends DuskTestCase
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
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    public function testValidLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('.links > a')
                ->assertUrlIs($this->appUrl.'/login')
                ->type('email', $this->user->email)
                ->type('password', 'password')
                ->press('Login')
                ->assertUrlIs($this->appUrl.'/dashboard');

        });
    }


    public function testInvalidLogin()
    {
        $this->actingAs($this->user)->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('.links > a')
                ->assertUrlIs($this->appUrl.'/login')
                ->type('email', $this->user->email)
                ->type('password', 'incorrect_password')
                ->press('Login')
                ->assertUrlIs($this->appUrl.'/login');
        });
    }

    public function testLoginWithIncompleteRegistration() {
        $this->browse(function (Browser $browser) {
            $incomplete_user = factory(User::class)->make();
            $incomplete_user->save();
            $browser->visit('/')
                ->click('.links > a')
                ->assertUrlIs($this->appUrl.'/login')
                ->type('email', $incomplete_user->email)
                ->type('password', 'password')
                ->press('Login')
                ->pause(2000)
                ->assertUrlIs($this->appUrl.'/attributes');
        });
    }

}

<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Auth;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class RegisterTest extends DuskTestCase
{
    private $appUrl;
    private $user = null;

    protected function setUp(): void
    {
        parent::setUp();
        if ($this->user == null) {
            $this->appUrl = getenv('APP_URL', 'http://localhost:8888');
            $this->user = factory(User::class)->make();
        }
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    public function testValidRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('.links > a:nth-child(2n)')
                ->assertUrlIs($this->appUrl.'/register')
                ->type('name', $this->user->name)
                ->type('email', $this->user->email)
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('Register')
                ->assertUrlIs($this->appUrl.'/attributes');
        });

    }

    public function testInvalidRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('.links > a:nth-child(2n)')
                ->assertUrlIs($this->appUrl.'/register')
                ->type('name', $this->user->name)
                ->type('email', "invalid-email")
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('Register')
                ->assertUrlIs($this->appUrl.'/register')
                ->type('email', $this->user->email)
                ->type('password_confirmation', 'nonmatchingpassword')
                ->press('Register')
                ->assertUrlIs($this->appUrl.'/register')
                ->type('name', "")
                ->type('password_confirmation', 'password')
                ->press('Register')
                ->assertUrlIs($this->appUrl.'/register')
                ->type('name', $this->user->name)
                ->type('email', "")
                ->press('Register')
                ->assertUrlIs($this->appUrl.'/register')
                ->type('email', $this->user->email)
                ->type('password', "")
                ->press('Register')
                ->assertUrlIs($this->appUrl.'/register')
                ->type('password', "password")
                ->type('password_confirmation', "")
                ->press('Register')
                ->assertUrlIs($this->appUrl.'/register');
        });

    }
}

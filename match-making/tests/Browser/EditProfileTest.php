<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Hash;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class EditProfileTest extends DuskTestCase
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

    public function testChangeEmail()
    {
        $this->browse(function (Browser $browser) {
            $originalEmail = $this->user->email;

            $browser->loginAs($this->user)->visit('/editprofile')
                ->type('email', 'testemail8@gmail.com')
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertEquals('testemail8@gmail.com', $this->user->email);
            $browser->loginAs($this->user)->visit('/editprofile')
                ->type('email', $originalEmail)
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();

            self::assertEquals($this->user->email, $originalEmail);
        });
    }

    public function testChangePostcode()
    {
        $this->browse(function (Browser $browser) {
            $originalPostcode = $this->user->Attributes->postcode;
            echo $this->user;
            $browser->loginAs($this->user)->visit('/profile')
                ->click('#edit-profile-button')
                ->type('#postcode', 3121)
                ->pause(1000)
                ->click('#suburb-table > .table-row')
                ->press('Submit')
                ->pause(1000);
            $this->user = User::all()->where('id', $this->user->id)->first();
            //echo $this->user->Attributes->postcodeObject;
            self::assertEquals(3121, $this->user->Attributes->postcodeObject->postcode);
//            $browser->loginAs($this->user)->visit('/editprofile')
//                ->type('postcode', $originalPostcode)
//                ->press('Submit');
//            $this->user = User::all()->where('id', $this->user->id)->first();
//
//            self::assertEquals($this->user->Attributes->postcode, $originalPostcode);
        });
    }

    public function testChangeInterestedIn()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)->visit('/editprofile')
                ->select('interested_in', "M")
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertEquals("M", $this->user->Attributes->interested_in);
            $browser->loginAs($this->user)->visit('/editprofile')
                ->select('interested_in', "F")
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertEquals("F", $this->user->Attributes->interested_in);
            $browser->loginAs($this->user)->visit('/editprofile')
                ->select('interested_in', "MF")
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertEquals("MF", $this->user->Attributes->interested_in);
        });
    }

    public function testChangePasswordValid()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)->visit('/editprofile')
                ->click('#password-toggle')
                ->type('password', "password")
                ->type('change-password', 'password123')
                ->type('change-password-confirm', 'password123')
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertTrue(Hash::check('password123', $this->user->password));
            $browser->loginAs($this->user)->visit('/editprofile')
                ->click('#password-toggle')
                ->type('password', "password123")
                ->type('change-password', 'password')
                ->type('change-password-confirm', 'password')
                ->press('Submit');

            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertTrue(Hash::check('password', $this->user->password));
        });
    }

    public function testChangePasswordInvalid()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)->visit('/editprofile')
                ->click('#password-toggle')
                ->type('password', "password123")
                ->type('change-password', 'password123')
                ->type('change-password-confirm', 'password123')
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertFalse(Hash::check('password123', $this->user->password));
            $browser->loginAs($this->user)->visit('/editprofile')
                ->click('#password-toggle')
                ->type('password', "password")
                ->type('change-password', 'password123')
                ->type('change-password-confirm', 'password')
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertFalse(Hash::check('password123', $this->user->password));
            $browser->loginAs($this->user)->visit('/editprofile')
                ->click('#password-toggle')
                ->type('password', "password")
                ->type('change-password', 'password')
                ->type('change-password-confirm', 'password123')
                ->press('Submit');
            $this->user = User::all()->where('id', $this->user->id)->first();
            self::assertFalse(Hash::check('password123', $this->user->password));
        });
    }

}

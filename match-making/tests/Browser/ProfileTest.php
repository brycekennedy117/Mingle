<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ProfileTest extends DuskTestCase
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


    public function testProfileName()
    {
        $this->browse(function (Browser $browser) {
            $html_name = $browser->loginAs($this->user)->visit('/profile')
                ->element('#name-cell')
                ->getAttribute('innerHTML');

            self::assertEquals($html_name, $this->user->name);
        });
    }

    public function testProfileDOB()
    {
        $this->browse(function (Browser $browser) {
            $html_dob = $browser->loginAs($this->user)->visit('/profile')
                ->element('#dob-cell')
                ->getAttribute('innerHTML');

            self::assertEquals($html_dob, date('d M Y', strtotime($this->user->Attributes->date_of_birth)));
        });
    }

    public function testProfilePostcode()
    {
        $this->browse(function (Browser $browser) {
            $html_postcode = $browser->loginAs($this->user)->visit('/profile')
                ->element('#postcode-cell')
                ->getAttribute('innerHTML');
            echo $html_postcode;
            self::assertEquals($html_postcode, $this->user->Attributes->postcodeObject->postcode);
        });
    }

    public function testProfileSuburb()
    {
        $this->browse(function (Browser $browser) {
            $html_suburb = $browser->loginAs($this->user)->visit('/profile')
                ->element('#suburb-cell')
                ->getAttribute('innerHTML');

            self::assertEquals($html_suburb, $this->user->Attributes->postcodeObject->suburb);
        });
    }

    public function testProfileGender()
    {
        $this->browse(function (Browser $browser) {
            $html_gender = $browser->loginAs($this->user)->visit('/profile')
                ->element('#gender-cell')
                ->getAttribute('innerHTML');
            if ($this->user->Attributes->gender == 'M') {
                self::assertEquals($html_gender, "Male");
            }
            else {
                self::assertEquals($html_gender, "Female");
            }

        });
    }

    public function testProfileInterestedIn()
    {
        $this->browse(function (Browser $browser) {
            $html_interested_in = $browser->loginAs($this->user)->visit('/profile')
                ->element('#interested-in-cell')
                ->getAttribute('innerHTML');

            if ($this->user->Attributes->interested_in == 'M') {
                self::assertEquals($html_interested_in, "Men");
            }
            elseif ($this->user->Attributes->interested_in == 'F'){
                self::assertEquals($html_interested_in, "Women");
            }
            else {
                self::assertEquals($html_interested_in, "Both");
            }
        });
    }

    public function testProfilePhotoURL()
    {
        $this->browse(function (Browser $browser) {
            $html_interested_in = $browser->loginAs($this->user)->visit('/profile')
                ->element('img')
                ->getAttribute('src');

            self::assertEquals($html_interested_in, $this->user->Attributes->image_url);
        });
    }
}

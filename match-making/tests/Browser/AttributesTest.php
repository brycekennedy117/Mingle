<?php

namespace Tests\Browser;

use App\MingleLibrary\Models\Postcode;
use App\MingleLibrary\Models\UserAttributes;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
class AttributesTest extends DuskTestCase
{
    private $appUrl;
    private $user = null;

    protected function setUp(): void
    {
        parent::setUp();
        if ($this->user == null) {
            $this->appUrl = getenv('APP_URL', 'http://localhost:8888');
            $this->user = factory(User::class)->make();
            $this->user->save();
        }
        else {
            echo "USER NOT NULL";
        }
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    public function testValidAttributes()
    {
        $this->actingAs($this->user)->browse(function (Browser $browser) {
            $browser->loginAs($this->user->email)
                ->visit($this->appUrl.'/attributes')
                ->assertUrlIs($this->appUrl.'/attributes')
                ->type('#postcode', 3121)
                ->pause(1000)
                ->click('#suburb-table > .table-row')
                ->type('date_of_birth', '07031992')
                ->type('#greeting', "This is the greeting message")
                ->press('Confirm')
                ->pause(1000)
                ->assertUrlIs($this->appUrl.'/dashboard');

        });
    }

    public function testValidAttributesRoute()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $browser->loginAs($user->email)
                ->visit($this->appUrl.'/attributes')
                ->assertUrlIs($this->appUrl.'/dashboard');

        });
    }

    public function testPostcodeListCount() {

        $this->actingAs($this->user)->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $postcodeID = UserAttributes::all()->where('user_id', $user->id)->first()->postcode;
            $postcode = Postcode::all()->where('id', $postcodeID)->first()->postcode;
            $suburbs = Postcode::all()->where('postcode', $postcode);
            $numOfSuburbs =  sizeof($suburbs);
            $browser->loginAs($this->user->email)
                ->visit($this->appUrl.'/attributes')
                ->assertUrlIs($this->appUrl.'/attributes')
                ->type('#postcode', $postcode)
                ->pause(1000);
                $numOfRows = sizeof($browser->elements('.table-row'));
                self::assertEquals($numOfRows, $numOfSuburbs);
        });
    }
}

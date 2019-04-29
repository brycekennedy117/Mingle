<?php

namespace Tests\Browser;

use App\MingleLibrary\Models\Like;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class DashboardTest extends DuskTestCase
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

    public function testMatchLimit()
    {
        $this->browse(function (Browser $browser) {
            $matches = $browser->loginAs($this->user)->visit('/dashboard')
                ->elements('#match-card');
            self::assertLessThanOrEqual(10, sizeof($matches), "Match Limit Is Greater Than 10");
            self::assertGreaterThanOrEqual(0, sizeof($matches), "Match Limit Is Less Than 0");

        });
    }

    public function testLikeFunction() {
        $this->browse(function (Browser $browser) {
            $id = $browser->loginAs($this->user)->visit('/dashboard')
                ->element('#user_id_liked')
                ->getAttribute('innerHTML');
            $browser->loginAs($this->user)->visit('/dashboard')
                ->element('#match-card')
                ->click('Like');

            echo json_encode( Like::all()->where('user_id_1', $this->user->id)->where('user_id_2', $id));


        });
    }

}

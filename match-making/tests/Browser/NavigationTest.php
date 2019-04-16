<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class NavigationTest extends DuskTestCase
{
    private $appUrl;
    private $user = null;
    private $dropdownLinks = ['Matches','My Profile','Logout'];
    private $landingLinks = ['LOGIN', 'REGISTER', 'HELP', 'CONTACT US'];

    protected function setUp(): void
    {
        parent::setUp();
        if ($this->user == null) {
            $this->appUrl = getenv('APP_URL', 'http://localhost:8888');
            $this->user = factory(User::class)->create();
        }
    }

    public function testNavOptionsDashboard()
    {

        $this->browse(function (Browser $browser) {

            $browser->loginAs($this->user->id)
                ->visit('/dashboard')
                ->clickLink($this->user->name)
                ->pause(100);
            $options = $browser->elements('.dropdown')[0]->getText();
            $menuOptions = explode("\n", $options);

            self::assertEquals($menuOptions[0], $this->user->name);
            self::assertEquals($menuOptions[1], $this->dropdownLinks[0]);
            self::assertEquals($menuOptions[2], $this->dropdownLinks[1]);
            self::assertEquals($menuOptions[3], $this->dropdownLinks[2]);

        });
    }

    public function testNavOptionsLanding()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/');
            $options =  $browser->elements('.top-right > a');
            $menuOptions = array();
            foreach ($options as $key=>$option) {
                array_push($menuOptions, $option->getText());
            }
            echo json_encode($menuOptions);
            self::assertEquals($menuOptions[0], $this->landingLinks[0]);
            self::assertEquals($menuOptions[1], $this->landingLinks[1]);
            self::assertEquals($menuOptions[2], $this->landingLinks[2]);
            self::assertEquals($menuOptions[3], $this->landingLinks[3]);

        });

    }
}

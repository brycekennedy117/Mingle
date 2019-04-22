<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationRoutingTest extends TestCase
{
    private $appUrl;
    private $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->appUrl = getenv('APP_URL', 'http://localhost:8888');
        $this->user = factory(User::class)->create();
        $this->user->save();
    }

    public function testUnAuthorisedDashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/login');

    }

    public function testUnAuthorisedHome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

    }

    public function testUnAuthorisedLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testUnAuthorisedRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function testUnAuthorisedAttributes()
    {
        $response = $this->get('/attributes');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/login');

    }

    public function testUnAuthorisedMatches()
    {
        $response = $this->get('/matches');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/login');

    }

    public function testUnAuthorisedProfile()
    {
        $response = $this->get('/profile');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/login');

    }

    public function testAuthorisedHome()
    {
        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/dashboard');

    }

    public function testAuthorisedLogin()
    {
        $response = $this->actingAs($this->user)->get('/login');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/dashboard');
    }

    public function testAuthorisedRegister()
    {
        $response = $this->actingAs($this->user)->get('/register');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/dashboard');
    }

    public function testAuthorisedDashboard()
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function testAuthorisedIncompleteAttributes()
    {   $user = factory(User::class)->make();
        $user->save();
        $response = $this->actingAs($user)->get('/attributes');
        $response->assertStatus(200);
    }

    public function testAuthorisedAttributes()
    {
        $response = $this->actingAs($this->user)->get('/attributes');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/dashboard');

    }

    public function testAuthorisedMatches()
    {
        $response = $this->actingAs($this->user)->get('/matches');
        $response->assertStatus(200);
    }

    public function testAuthorisedProfile()
    {
        $response = $this->actingAs($this->user)->get('/profile');
        $response->assertStatus(200);
    }
}

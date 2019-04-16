<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationRoutingTest extends TestCase
{
    private $appUrl;
    private $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->appUrl = getenv('APP_URL', 'http://localhost:8888');
        $this->user = factory(User::class)->make();
        $this->user->save();
    }

    public function testUnregisteredHome() {
        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/attributes');
    }

    public function testUnregisteredDashboard() {
        $response = $this->actingAs($this->user)->get('/dashboard');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/attributes');
    }

    public function testUnregisteredMatches() {
        $response = $this->actingAs($this->user)->get('/matches');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/attributes');
    }

    public function testUnregisteredProfile() {
        $response = $this->actingAs($this->user)->get('/profile');
        $response->assertStatus(302);
        $response->assertHeader('location', $this->appUrl.'/attributes');
    }

    public function testUnregisteredAttributes() {
        $response = $this->actingAs($this->user)->get('/attributes');
        $response->assertStatus(200);
    }
}

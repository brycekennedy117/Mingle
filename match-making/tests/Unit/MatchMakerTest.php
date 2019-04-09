<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\MingleLibrary\MatchMaker;

class MatchMakerTest extends TestCase
{
    private $matchMaker;

    protected function setUp() : void
    {   parent::setUp();
        $this->matchMaker = [];
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}

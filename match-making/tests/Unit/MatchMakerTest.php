<?php

namespace Tests\Unit;

use App\Http\Controllers\MatchController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\MingleLibrary\MatchMaker;
use App\User;
use Illuminate\Support\Facades\Auth;

class MatchMakerTest extends TestCase
{
    private $matchMaker;
    private $user;
    protected function setUp() : void
    {   parent::setUp();
        $this->matchMaker = new MatchMaker();
        $this->user = User::all()->random(1)->first();
    }

    public function testMatchMakerLimit() {
        $limit = 5;
        $potentialMatches =  $this->matchMaker->getPotentialMatches($this->user->Attributes, $orderBy=['score desc'], $limit=$limit);
        self::assertTrue(sizeof($potentialMatches) <= $limit);
        self::assertTrue(sizeof($potentialMatches) >= 0);
        $limit = 10;
        $potentialMatches =  $this->matchMaker->getPotentialMatches($this->user->Attributes, $orderBy=['score desc'], $limit=$limit);
        self::assertTrue(sizeof($potentialMatches) <= $limit);
        self::assertTrue(sizeof($potentialMatches) >= 0);
        $limit = 20;
        $potentialMatches =  $this->matchMaker->getPotentialMatches($this->user->Attributes, $orderBy=['score desc'], $limit=$limit);
        self::assertTrue(sizeof($potentialMatches) <= $limit);
        self::assertTrue(sizeof($potentialMatches) >= 0);
        $limit = 30;
        $potentialMatches =  $this->matchMaker->getPotentialMatches($this->user->Attributes, $orderBy=['score desc'], $limit=$limit);
        self::assertTrue(sizeof($potentialMatches) <= $limit);
        self::assertTrue(sizeof($potentialMatches) >= 0);
    }

    public function testMatchMakerDistance() {
        $distance = 50;
        $potentialMatches =  $this->matchMaker->getPotentialMatches($this->user->Attributes, $orderBy=['score desc'], $limit=10, 1, $maxDistance=$distance);
        $userLat = $this->user->Attributes->postcodeObject->latitude;
        $userLon = $this->user->Attributes->postcodeObject->longitude;

        foreach ($potentialMatches as $match) {
            $matchDistance = MatchController::distanceBetweenMatches($userLat, $userLon, $match->postcodeObject->latitude, $match->postcodeObject->longitude);
            self::assertLessThanOrEqual($distance, $matchDistance);
        }
        echo sizeof($potentialMatches);

        $distance = 30;
        $potentialMatches =  $this->matchMaker->getPotentialMatches($this->user->Attributes, $orderBy=['score desc'], $limit=10, 1, $maxDistance=$distance);
        $userLat = $this->user->Attributes->postcodeObject->latitude;
        $userLon = $this->user->Attributes->postcodeObject->longitude;

        foreach ($potentialMatches as $match) {
            $matchDistance = MatchController::distanceBetweenMatches($userLat, $userLon, $match->postcodeObject->latitude, $match->postcodeObject->longitude);
            self::assertLessThanOrEqual($distance, $matchDistance);
        }
        echo sizeof($potentialMatches);

    }

    public function testMatchMakerGender() {
        $distance = 50;
        $potentialMatches =  $this->matchMaker->getPotentialMatches($this->user->Attributes, $orderBy=['score desc'], $limit=10, 1, $maxDistance=$distance);

        foreach ($potentialMatches as $match) {
            self::assertEquals($this->user->Attributes->interested_in, $match->gender);
        }
        echo sizeof($potentialMatches);

    }

    public function testMatchMakerInterestedIn() {
        $distance = 50;
        $potentialMatches =  $this->matchMaker->getPotentialMatches($this->user->Attributes, $orderBy=['score desc'], $limit=10, 1, $maxDistance=$distance);

        foreach ($potentialMatches as $match) {
            self::assertEquals($this->user->Attributes->gender, $match->interested_in);
        }
        echo sizeof($potentialMatches);

    }
}

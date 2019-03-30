<?php

use Faker\Generator as Faker;

$factory->define(App\MingleLibrary\Models\UserAttributes::class, function (Faker $faker) {
    return [
        'user_id' => "johndoe@hotmail.com",
        'openness' => $faker->randomFloat(2,0,1),
        'conscientiousness' => $faker->randomFloat(2,0,1),
        'extraversion' => $faker->randomFloat(2,0,1),
        'agreeableness' => $faker->randomFloat(2,0,1),
        'neuroticism' => $faker->randomFloat(2,0,1),
        'gender' => 'M',
        'interested_in' => 'F',
        'latitude' => $faker->randomFloat(2,-37.81, -37.82),
        'longitude' => $faker->randomFloat(2,144.90, 144.96),
        'postcode' => $faker->randomNumber(4, true)
    ];
});

$factory->afterMaking(App\MingleLibrary\Models\UserAttributes::class, function ($attributes, $faker) {
    $attributes->save();
});

$factory->state(App\User::class, 'straight_male', [
    'gender' => 'M',
    'interested_in' => 'F'
]);
$factory->state(App\User::class, 'straight_female', [
    'gender' => 'F',
    'interested_in' => 'M'
]);
$factory->state(App\User::class, 'gay_male', [
    'gender' => 'M',
    'interested_in' => 'M'
]);
$factory->state(App\User::class, 'gay_female', [
    'gender' => 'F',
    'interested_in' => 'F'
]);


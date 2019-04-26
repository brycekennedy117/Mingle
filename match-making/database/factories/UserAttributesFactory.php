<?php

use Faker\Generator as Faker;
use App\MingleLibrary\Models\Postcode;

$factory->define(App\MingleLibrary\Models\UserAttributes::class, function (Faker $faker) {
    $int= mt_rand(1262055681,1262055681);
    $date = date("Y-m-d H:i:s",$int);
    $postcode = Postcode::all()->whereBetween('postcode', [3121, 3150])->random(1)->first();
    echo $postcode;
    return [
        'user_id' => 1,
        'openness' => $faker->randomFloat(2,0,1),
        'conscientiousness' => $faker->randomFloat(2,0,1),
        'extraversion' => $faker->randomFloat(2,0,1),
        'agreeableness' => $faker->randomFloat(2,0,1),
        'neuroticism' => $faker->randomFloat(2,0,1),
        'gender' => 'M',
        'interested_in' => 'F',
        'date_of_birth' => $faker->date("Y-m-d H:i:s"),
        'postcode' => $postcode->id,
        'image_url' => "https://profiles.utdallas.edu/img/default.png"
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


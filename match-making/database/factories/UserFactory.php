<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->afterMaking(App\User::class, function ($user, $faker) {
    $id = $user['id'];
    $email = $user['email'];


    $attr = factory(App\MingleLibrary\Models\UserAttributes::class)->make(['user_id' => $email,
        'gender' => $faker->randomElement($array = array ('M', 'F')),
        'interested_in' => $faker->randomElement($array = array ('M', 'F'))
    ]);

    $user->save();
});



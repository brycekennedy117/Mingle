<?php

use Faker\Generator as Faker;
use App\MingleLibrary\Models\UserAttributes;
$factory->define(\App\MingleLibrary\Models\Match::class, function (Faker $faker) {
    $user1 = UserAttributes::all()->random(1)[0];
    $user2 = UserAttributes::all()->where('interested_in', $user1['gender'])->random(1)[0];
    return [
        'user_id_1' => $user1['user_id'],
        'user_id_2' => $user2['user_id'],
    ];
});


$factory->afterMaking(App\MingleLibrary\Models\Match::class, function ($attributes, $faker) {
    try {
        $attributes->save();
    }
    catch (Exception $exception) {
        echo "Duplicate: Not Saving.\n";
    }
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produit;
use Faker\Generator as Faker;

$factory->define(Produit::class, function (Faker $faker) {
    return [
        // 'user_id' => factory(App\User::class),
        'user_id' => App\User::all(["id"])->pluck("id")->random(),
        'nom' => $faker->word,
        'media' => "",
        'description' => $faker->paragraph,
    ];
});

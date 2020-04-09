<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tag::class, function (Faker $faker) {
    $nom = $faker->name;
    return [
        // "nom" => $faker->word
        "nom" => $nom,
        "slug" => Str::slug($nom)
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,100000),
        'title' => $faker->sentence(rand(5,10), $variableNbWords = true),
        'description' => $faker->realText(rand(1000,4000)),
        'created_at' => $faker->dateTimeBetween('-3 days', '-1 days'),
        'updated_at' => $faker->dateTimeBetween('-3 days', '-1 days'),
    ];
});

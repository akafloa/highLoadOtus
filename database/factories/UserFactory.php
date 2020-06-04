<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'sex' => $faker->randomElement($array = array ('man', 'woman')) ,
        'fname' => $faker->lastName,
        'age' => rand(18,45),
        'interest'=> $faker->word,
        'city'=> $faker->city,
        'nickname'=> preg_replace('/[^a-zA-Z0-9]/ui', '',mb_strtolower($faker->firstName.'_'.$faker->lastName))
         
    ];
});

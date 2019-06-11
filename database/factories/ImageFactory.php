<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Address($faker));
    return [
        'user_id' => factory(User::class),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'location' => $faker->city,
        'is_public' => collect([true, false])->random(),
    ];
});

<?php

use App\Author;
use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'author_id' => rand(1, Author::all()->count()),
    ];
});

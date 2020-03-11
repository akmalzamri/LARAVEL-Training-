<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$userId = \App\User::get()->pluck('id');

$factory->define(Task::class, function (Faker $faker) use($userId) {
    return [
        'name' => $faker->name,
        'category' => $faker->randomElement(['main', 'secondary']),
        'user_id' => $faker->randomElement($userId),
        'content' => $faker->text,
        'active' => $faker->randomElement([0,1])

    ];
});

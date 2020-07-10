<?php

use App\Task;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'keep' => $faker->sentence
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Setting as ModelsSetting;
use Faker\Generator as Faker;

$factory->define(ModelsSetting::class, function (Faker $faker) {
    return [
        'nama'=>'Duwa Sisi',
    ];
});

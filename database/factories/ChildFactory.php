<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Child;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Child::class, function (Faker $faker) {
    return [
        'photo' => $faker->imageUrl(),
        'civility' => 'M',
        'first_name_fr' => $faker->name,
        'last_name_ar' => $faker->name,
        'birthday' => $faker->date(),
        'born_place_fr' => $faker->city,
        'entree_date' => $faker->date(),
        'inscription_number' => $faker->bankAccountNumber(),
        'rassm_number' => $faker->bankAccountNumber(),
        'province_fr' => $faker->citySuffix,
        'province_ar' => $faker->company,
        'health_state_ar' => $faker->companySuffix,
        'health_state_fr' => $faker->city,
        'judge_number' => $faker->numberBetween(),
        'description' => $faker->text,
    ];
});


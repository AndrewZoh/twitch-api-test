<?php
/**
 * Created by PhpStorm.
 * User: legat
 * Date: 08/02/2018
 * Time: 20:41
 */

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
    ];
});
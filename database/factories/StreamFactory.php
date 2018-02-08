<?php
/**
 * Created by PhpStorm.
 * User: legat
 * Date: 08/02/2018
 * Time: 20:37
 */

use Faker\Generator as Faker;

$factory->define(App\Stream::class, function (Faker $faker) {
    return [
        'channel_id' => $faker->numberBetween(1, 1000),
        'service' => 'twitch',
        'viewer_count' => $faker->numberBetween(1, 1000),
        'twitch_stream_id' => $faker->numberBetween(1, 1000),
        'is_current' => 1,
    ];
});
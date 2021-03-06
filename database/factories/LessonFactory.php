<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    // 明日から10日後までの間でランダムな日時を生成
    $startAt = $faker->dateTimeBetween('+1days', '+10days');
    $startAt->setTime(10, 0, 0);
    $endAt = clone ($startAt);
    $endAt->setTime(11, 0, 0);

    return [
        'name' => $faker->name,
        'coach_name' => $faker->name,
        'capacity' => $faker->randomNumber(2),
        'start_at' => $startAt->format('Y-m-d H:i:s'),
        'end_at' => $endAt->format('Y-m-d H:i:s'),
    ];
});

$factory->state(Lesson::class, 'past', function (Faker $faker) {
    // 明日から10日後までの間でランダムな日時を生成
    $startAt = $faker->dateTimeBetween('-10days', '-1days');
    $startAt->setTime(10, 0, 0);
    $endAt = clone ($startAt);
    $endAt->setTime(11, 0, 0);

    return [
        'start_at' => $startAt->format('Y-m-d H:i:s'),
        'end_at' => $endAt->format('Y-m-d H:i:s'),
    ];
});

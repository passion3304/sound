<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define('App\Src\User\User', function ($faker) {
    return [
        'name'           => 'zal',
        'email'          => 'admin@test.com',
        'password'       => bcrypt('admin'),
        'remember_token' => str_random(10),
        'active'         => 1,
        'isAdmin'        => 1
    ];
});

$factory->define('App\Src\Category\Category', function ($faker) {
    $name = $faker->word;

    return [
        'name_en'        => $name,
        'name_ar'        => $name,
        'slug'           => str_slug($name),
        'description_ar' => $faker->text,
        'description_en' => $faker->text,
        'created_at'     => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now')
    ];
});

$factory->define('App\Src\Album\Album', function ($faker) {
    $name = $faker->word;

    return [
        'category_id'    => App\Src\Category\Category::orderByRaw("RAND()")->first()->id,
        'name_en'        => $name,
        'name_ar'        => $name,
        'slug'           => str_slug($name),
        'description_ar' => $faker->text,
        'description_en' => $faker->text,
        'created_at'     => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now')
    ];
});

$factory->define('App\Src\Track\Track', function ($faker) {
    $name = $faker->word . '.mp3';

    return [
        'trackeable_id'   => $faker->numberBetween(1, 10),
        'trackeable_type' => $faker->randomElement(['Album', 'Category']),
        'name_ar'         => $name,
        'name_en'         => $name,
        'description_ar'  => $faker->text,
        'description_en'  => $faker->text,
        'slug'            => $name,
        'url'             => 'test.mp3',
        'created_at'      => $faker->dateTimeBetween($startDate = '-1 week', $endDate = 'now'),
    ];
});

$factory->define('App\Src\Blog\Blog', function ($faker) {
    $name = $faker->word;

    return [
        'title_en'       => $name,
        'title_ar'       => $name,
        'description_en' => $faker->text,
        'description_ar' => $faker->text,
        'slug'           => str_slug($name),
        'created_at'     => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now')
    ];
});

$factory->define('App\Src\Meta\Meta', function ($faker) {
    return [
        'meta_id'    => App\Src\Track\Track::orderByRaw("RAND()")->first()->id,
        'meta_type'  => $faker->randomElement(['Album', 'Category'], 1),
        'ip'         => $faker->ipv4,
        'created_at' => $faker->dateTimeBetween($startDate = '-2 week', $endDate = 'now')
    ];
});
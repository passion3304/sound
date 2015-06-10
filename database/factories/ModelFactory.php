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
        'name' => 'zal',
        'email' => 'z4ls@live.com',
        'password' => bcrypt('admin'),
        'remember_token' => str_random(10),
        'active' => 1
    ];
});

$factory->define('App\Src\Category\Category', function ($faker) {
    $name = $faker->word;
    return [
        'name_en' => $name,
        'name_ar' => $name,
        'slug' => str_slug($name),
        'description_ar'  => $faker->text,
        'description_en'  => $faker->text,
    ];
});

$factory->define('App\Src\Album\Album', function ($faker) {
    $name = $faker->word;
    return [
        'category_id' => 1,
        'name_en' => $faker->word,
        'name_ar' => $faker->word,
        'slug' => str_slug($name),
        'description_ar'  => $faker->text,
        'description_en'  => $faker->text,
    ];
});

$factory->define('App\Src\Track\Track', function ($faker) {
    $name = $faker->word;
    return [
        'views'=>'',
        'trackeable_id' => 1,
        'trackeable_type' => 'Category',
        'title_en' => $name,
        'title_ar' => $name,
        'description_ar'  => $faker->text,
        'description_en'  => $faker->text,
        'slug' => str_slug($name),
        'url'      => 'test.mp3',
    ];
});
<?php

Route::controllers([
    'auth'     => 'AuthController',
    'password' => 'PasswordController'
]);

Route::resource('track', 'TrackController');

Route::resource('category', 'CategoryController');

Route::resource('album', 'AlbumController');

Route::resource('blog', 'BlogController');

Route::get('locale/{lang}', ['as' => 'locale.select', 'uses' => 'LocaleController@setLocale']);

Route::get('profile', 'UserController@profile');

Route::get('track/download/{id}', 'TrackController@downloadTrack');

Route::get('about', 'PageController@getAbout');

Route::get('contact', 'PageController@getContact');

Route::post('contact', 'PageController@postContact');

Route::get('home', 'HomeController@index');

Route::get('/', 'HomeController@index');


/*********************************************************************************************************
 * Admin Routes
 ********************************************************************************************************/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::resource('category', 'CategoryController');

    Route::resource('album', 'AlbumController');

    Route::resource('track', 'TrackController');

    Route::resource('photo', 'PhotoController');

    Route::resource('blog', 'BlogController');

    Route::resource('user', 'UserController');

    Route::get('/', 'HomeController@index');

});

Route::get('test', function () {

//    $trackUploader = App::make('\App\Src\Track\TrackCrawler');
//
//    $trackUploader->syncTracks();
//
//    dd('done');

});
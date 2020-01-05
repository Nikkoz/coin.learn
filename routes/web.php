<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
], static function () {
    Route::group(['namespace' => 'Auth'], static function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');

        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    });

    Route::group(['middleware' => ['admin']], static function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('coins', 'CoinController@index')->name('coins');

        Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Settings'], static function () {
            Route::group(['prefix' => 'algorithms', 'as' => 'algorithms.', 'namespace' => 'Algorithms'], static function () {
                Route::resource('encryption', 'EncryptionController');
                Route::resource('consensus', 'ConsensusController');
            });
        });
    });
});

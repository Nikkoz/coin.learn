<?php

Route::redirect('/', '/login');

Route::group([
    //'prefix'    => 'admin',
    'as'        => 'admin.',
    'namespace' => 'Admin',
], static function () {
    Auth::routes(['register' => false]);

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

        Route::post('/ajax/upload/image', 'UploadController@image')->name('ajax.upload.image');

        Route::group(['prefix' => 'coins', 'as' => 'coins.'], static function () {
            Route::get('/', 'CoinController@index')->name('index');
            Route::get('/create', 'CoinController@create')->name('create');
            Route::get('/{id}/edit', 'CoinController@edit')->name('edit');
            Route::put('/{id}', 'CoinController@update')->name('update');
            Route::post('/', 'CoinController@store')->name('store');
            Route::delete('/{id}', 'CoinController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Settings'], static function () {
            Route::group(['prefix' => 'algorithms', 'as' => 'algorithms.', 'namespace' => 'Algorithms'], static function () {
                Route::group(['prefix' => 'encryption', 'as' => 'encryption.'], static function () {
                    Route::get('/', 'EncryptionController@index')->name('index');
                    Route::get('/create', 'EncryptionController@create')->name('create');
                    Route::get('/{id}/edit', 'EncryptionController@edit')->name('edit');
                    Route::put('/{id}', 'EncryptionController@update')->name('update');
                    Route::post('/', 'EncryptionController@store')->name('store');
                    Route::delete('/{id}', 'EncryptionController@destroy')->name('destroy');
                });

                Route::group(['prefix' => 'consensus', 'as' => 'consensus.'], static function () {
                    Route::get('/', 'ConsensusController@index')->name('index');
                    Route::get('/create', 'ConsensusController@create')->name('create');
                    Route::get('/{id}/edit', 'ConsensusController@edit')->name('edit');
                    Route::put('/{id}', 'ConsensusController@update')->name('update');
                    Route::post('/', 'ConsensusController@store')->name('store');
                    Route::delete('/{id}', 'ConsensusController@destroy')->name('destroy');
                });
            });

            Route::group(['prefix' => 'social', 'as' => 'social.', 'namespace' => 'SocialNetworks'], static function () {
                Route::group(['prefix' => 'networks', 'as' => 'networks.'], static function () {
                    Route::get('/', 'SocialNetworkController@index')->name('index');
                    Route::get('/create', 'SocialNetworkController@create')->name('create');
                    Route::post('/', 'SocialNetworkController@store')->name('store');
                    Route::get('/{id}/edit', 'SocialNetworkController@edit')->name('edit');
                    Route::put('/{id}', 'SocialNetworkController@update')->name('update');
                    Route::delete('/{id}', 'SocialNetworkController@destroy')->name('destroy');
                });
            });
        });
    });
});
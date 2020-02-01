<?php

Route::redirect('/', '/login');

Route::group([
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

        Route::group(['prefix' => 'coins', 'namespace' => 'Coins'], static function () {
            Route::group(['as' => 'coins.'], static function () {
                Route::get('/', 'CoinController@index')->name('index');
                Route::get('/create', 'CoinController@create')->name('create');
                Route::get('/{id}/edit', 'CoinController@edit')->name('edit');
                Route::put('/{id}', 'CoinController@update')->name('update');
                Route::post('/', 'CoinController@store')->name('store');
                Route::delete('/{id}', 'CoinController@destroy')->name('destroy');

                // handbooks
                Route::group(['prefix' => '{coinId}/handbooks', 'as' => 'handbooks.'], static function () {
                    Route::get('/', 'HandbookController@index')->name('index');
                    Route::get('/create', 'HandbookController@create')->name('create');
                    Route::get('/{id}/edit', 'HandbookController@edit')->name('edit');
                    Route::put('/{id}', 'HandbookController@update')->name('update');
                    Route::post('/', 'HandbookController@store')->name('store');
                    Route::delete('/{id}', 'HandbookController@destroy')->name('destroy');
                });
            });

            // links
            Route::group(['prefix' => '{coinId}/links', 'as' => 'links.'], static function () {
                Route::get('/', 'SocialLinkController@index')->name('index');
                Route::get('/create', 'SocialLinkController@create')->name('create');
                Route::get('/{id}/edit', 'SocialLinkController@edit')->name('edit');
                Route::put('/{id}', 'SocialLinkController@update')->name('update');
                Route::post('/', 'SocialLinkController@store')->name('store');
                Route::delete('/{id}', 'SocialLinkController@destroy')->name('destroy');
            });
        });

        Route::group(['namespace' => 'Posts'], static function () {
            Route::group(['prefix' => 'news', 'as' => 'news.'], static function () {
                Route::get('/', 'NewsController@index')->name('index');
                Route::get('/create', 'NewsController@create')->name('create');
                Route::get('/{id}/edit', 'NewsController@edit')->name('edit');
                Route::put('/{id}', 'NewsController@update')->name('update');
                Route::post('/', 'NewsController@store')->name('store');
                Route::delete('/{id}', 'NewsController@destroy')->name('destroy');
            });
        });

        Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Settings'], static function () {
            Route::redirect('/', 'settings/handbooks');

            Route::group(['prefix' => '/handbooks', 'as' => 'handbooks.'], static function () {
                Route::get('/', 'HandbookController@index')->name('index');
                Route::get('/create', 'HandbookController@create')->name('create');
                Route::get('/{id}/edit', 'HandbookController@edit')->name('edit');
                Route::put('/{id}', 'HandbookController@update')->name('update');
                Route::post('/', 'HandbookController@store')->name('store');
                Route::delete('/{id}', 'HandbookController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'algorithms', 'as' => 'algorithms.', 'namespace' => 'Algorithms'], static function (
            ) {
                Route::redirect('/', 'algorithms/encryption');

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
                Route::redirect('/', 'social/networks');

                Route::group(['prefix' => 'networks', 'as' => 'networks.'], static function () {
                    Route::get('/', 'SocialNetworkController@index')->name('index');
                    Route::get('/create', 'SocialNetworkController@create')->name('create');
                    Route::post('/', 'SocialNetworkController@store')->name('store');
                    Route::get('/{id}/edit', 'SocialNetworkController@edit')->name('edit');
                    Route::put('/{id}', 'SocialNetworkController@update')->name('update');
                    Route::delete('/{id}', 'SocialNetworkController@destroy')->name('destroy');
                });
            });

            Route::group(['prefix' => 'sites', 'as' => 'sites.'], static function () {
                Route::get('/', 'SiteController@index')->name('index');
                Route::get('/create', 'SiteController@create')->name('create');
                Route::get('/{id}/edit', 'SiteController@edit')->name('edit');
                Route::get('/{id}/edit', 'SiteController@edit')->name('edit');
                Route::put('/{id}', 'SiteController@update')->name('update');
                Route::post('/', 'SiteController@store')->name('store');
                Route::delete('/{id}', 'SiteController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'exchanges', 'as' => 'exchanges.'], static function () {
                Route::get('/', 'ExchangeController@index')->name('index');
                Route::get('/create', 'ExchangeController@create')->name('create');
                Route::get('/{id}/edit', 'ExchangeController@edit')->name('edit');
                Route::get('/{id}/edit', 'ExchangeController@edit')->name('edit');
                Route::put('/{id}', 'ExchangeController@update')->name('update');
                Route::post('/', 'ExchangeController@store')->name('store');
                Route::delete('/{id}', 'ExchangeController@destroy')->name('destroy');
            });
        });
    });
});
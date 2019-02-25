<?php

Route::get('index/search', 'AjaxController@search')->name('search');
Route::get('routes/search', 'AjaxController@routesSearch')->name('routes.search');
Route::post('images/upload', 'AjaxController@imageUpload')->name('images.upload');

Route::group(
    ['middleware' => ['can:view users']],
    function () {
        Route::get('users/active_counter', 'UserController@getActiveUserCounter')->name('users.active.counter');

        Route::get('users/search', 'UserController@search')->name('users.search');
        Route::get('users/{user}/show', 'UserController@show')->name('users.show');

        Route::resource('users', 'UserController', [
            'only' => ['store', 'update', 'destroy'],
        ]);

        Route::post('users/batch_action', 'UserController@batchAction')->name('users.batch_action');
        Route::post('users/{user}/active', 'UserController@activeToggle')->name('users.active');        
    }
);

Route::group(
    ['middleware' => ['can:view campaigns']],
    function () {
        Route::get('campaigns/search', 'CampaignController@search')->name('campaigns.search');
        Route::get('campaigns/{campaign}/show', 'CampaignController@show')->name('campaigns.show');

        Route::resource('campaigns', 'CampaignController', [
            'only' => ['store', 'update', 'destroy'],
        ]);

        Route::post('campaigns/batch_action', 'CampaignController@batchAction')->name('campaigns.batch_action');
        Route::post('campaigns/{campaign}/active', 'CampaignController@activeToggle')->name('campaigns.active');
    }
);

Route::group(
    ['middleware' => ['can:view payments']],
    function () {
        
        Route::get('payments/search', 'PaymentController@search')->name('payments.search');
        Route::get('payments/{campaign}/show', 'PaymentController@show')->name('payments.show');

        Route::resource('payments', 'PaymentController', [
            'only' => ['store', 'update', 'destroy'],
        ]);

        Route::post('payments/batch_action', 'PaymentController@batchAction')->name('payments.batch_action');
    }
);

Route::get('/{vue_capture?}', 'BackendController@index')
    ->where('vue_capture', '[\/\w\.-]*')
    ->name('home');

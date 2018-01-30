<?php

/*
|--------------------------------------------------------------------------
| BREAD Template Routes
|--------------------------------------------------------------------------
|
| This file is where we add BreadTemplates routes and may override any
| of the Voyager.
|
*/

Route::group(['as' => 'voyager.', 'middleware' => 'admin.user'], function () {
    $hookController = '\\'.config('voyager.controllers.namespace').'\\VoyagerBreadController';

    Route::resource('templates', $hookController);

    // Add custom Controller action
    Route::get('templates/create/', ['uses' => $hookController.'@create__', 'as' => 'templates.create']);
});

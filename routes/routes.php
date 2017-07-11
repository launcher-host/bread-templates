<?php

/*
|--------------------------------------------------------------------------
| Voyager Template Routes
|--------------------------------------------------------------------------
|
| This file is where we add VoyagerTemplates routes and may override any
| of the Voyager.
|
*/

Route::group(['as' => 'voyager.', 'middleware' => 'admin.user'], function () {
    $hookController = '\\akazorg\\VoyagerTemplates\\Http\\Controllers\\VoyagerTemplatesController';

    Route::resource('templates', $hookController);

    // Add custom Controller action
    Route::get('templates/create/', ['uses' => $hookController.'@create__', 'as' => 'templates.create']);
});

<?php

use TCG\Voyager\Models\DataType;

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


    // Overwrite any of the BREAD Controllers
    /*
    try {
        foreach (DataType::all() as $dataType) {
            $breadController = $dataType->controller
                             ? $dataType->controller
                             : $namespacePrefix.'VoyagerBreadController';

            Route::resource($dataType->slug, $breadController);
        }
    } catch (\InvalidArgumentException $e) {
        throw new \InvalidArgumentException("Custom routes hasn't been configured because: ".$e->getMessage(), 1);
    } catch (\Exception $e) {
        // do nothing, might just be because table not yet migrated.
    }
    */
});

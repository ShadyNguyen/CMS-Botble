<?php

use Illuminate\Support\Facades\Route;
use Theme\Shadow\Http\Controllers\ShadowController;

// Custom routes
// You can delete this route group if you don't need to add your custom routes.
Route::group(['controller' => ShadowController::class, 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        // Add your custom route here
        // Ex: Route::get('hello', 'getHello');

    });
});

Theme::routes();

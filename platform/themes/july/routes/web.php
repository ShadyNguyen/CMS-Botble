<?php

use Illuminate\Support\Facades\Route;
use Theme\July\Http\Controllers\JulyController;

// Custom routes
// You can delete this route group if you don't need to add your custom routes.
Route::group(['controller' => JulyController::class, 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        // Add your custom route here
        // Ex: Route::get('hello', 'getHello');
        Route::get('/product',[JulyController::class,'getProduct'])->name('product');

    });
});

Theme::routes();

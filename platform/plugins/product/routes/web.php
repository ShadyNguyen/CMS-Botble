<?php

use Botble\Base\Facades\BaseHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\Product\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
            Route::resource('', 'ProductController')->parameters(['' => 'product']);
            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'ProductController@deletes',
                'permission' => 'product.destroy',
            ]);
        });
        Route::group(['prefix' => 'product-categories', 'as' => 'product-categories.'], function () {
            Route::resource('', 'ProductCategoriesController')->parameters(['' => 'product-categories']);
            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'ProductCategoriesController@deletes',
                'permission' => 'product-categories.destroy',
            ]);
        });
        Route::group(['prefix' => 'product-items', 'as' => 'product-items.'], function () {
            Route::resource('', 'ProductItemsController')->parameters(['' => 'product-items']);
            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'ProductItemsController@deletes',
                'permission' => 'product-items.destroy',
            ]);
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('product', [
                'as'   => 'settings.product',
                'uses' => 'SettingController@getSetting',
            ]);
        
            Route::post('product', [
                'as'         => 'settings.product.post',
                'uses'       => 'SettingController@postSetting',
                'permission' => 'settings.product',
            ]);
        });
        // Route::get('media', [
        //     'as' => 'settings.media',
        //     'uses' => 'SettingController@getMediaSetting',
        // ]);

        // Route::post('media', [
        //     'as' => 'settings.media.post',
        //     'uses' => 'SettingController@postEditMediaSetting',
        //     'permission' => 'settings.media',
        //     'middleware' => 'preventDemo',
        // ]);
    });
});

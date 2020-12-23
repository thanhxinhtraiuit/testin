<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'service-group'], function () {
        Route::get('','ServiceGroupController@index')->name('service_gorup_index');
        Route::post('','ServiceGroupController@store')->name('service_gorup_store');
        Route::get('/{group_service_id}','ServiceGroupController@show')->name('service_group_show');  
        Route::put('{group_service_id}','ServiceGroupController@update')->name('service_group_update');
        Route::delete('{group_service_id}','ServiceGroupController@destroy')->name('service_group_delete');        
    });

    Route::group(['prefix' => 'service-group-map'], function () {
        Route::get('','ServiceGroupMapController@index');
        Route::post('','ServiceGroupMapController@store');
    });
}); 
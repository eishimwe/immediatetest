<?php


Auth::routes();

Route::get('/', 'LocationController@index');
Route::post('location','LocationController@find');
Route::get('images/{location}/{venue_id}','LocationController@getLocationImages');


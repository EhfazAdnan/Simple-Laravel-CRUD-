<?php

Route::get('/', 'PostController@index');
Route::get('/search', 'PostController@search');
Route::delete('/deleteall','PostController@deleteAll');
Route::resource('posts', 'PostController');

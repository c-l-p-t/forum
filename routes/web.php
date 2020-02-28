<?php

Route::get('/', function () {
    return redirect(route('threads.index'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('threads/{channel}/{thread}/replies', 'ReplyController@store')->name('threads.reply.store');

Route::get('threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
Route::resource('threads', 'ThreadController')->except('show');

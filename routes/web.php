<?php

Route::get('/', function () {
    return redirect(route('threads.index'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('threads/{thread}/replies', 'ReplyController@store')->name('threads.reply.store');
Route::resource('threads', 'ThreadController');

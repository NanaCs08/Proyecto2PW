<?php

    Route::post('/login','LogInController@login');
    Route::post('/register','LogInController@register');
    Route::post('/rMessage','ChatController@saveMessage');
    Route::get('/Message','ChatController@fetchMessages');
    Route::get('/logout', 'LogInController@logout');

    Route::dispatch();

?>

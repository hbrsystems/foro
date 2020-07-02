<?php
//posts
Route::get('posts/create', [
   'uses'=>'CreatePostController@create',
    'as'=>'posts.create'
]);

Route::post('posts/create', [
    'uses'=>'CreatePostController@store',
    'as'=>'posts.store'
]);

//comments
Route::post('posts/{post}/comment',[
    'uses'=>'commentController@store',
    'as'=>'comments.store',
]);

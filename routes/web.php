<?php

// lp
Route::get('/welcome', 'WelcomeController@index');

// 認証関係
Auth::routes();

Route::group(['middleware' => 'auth'], function() {
// 案件一覧
Route::get('/', 'ProjectController@index');

// 案件登録
Route::get('/project/create', 'ProjectController@create');

// 案件保存
Route::post('/project/store', 'ProjectController@store');

// 案件詳細
Route::get('/project/{id?}', 'ProjectController@show');

// マイページ
Route::get('/profile', 'ProfileController@index');

// プロフィール編集
Route::get('/profile/edit', 'ProfileController@edit');

// 投稿した案件一覧
Route::get('/profile/posted-projects', 'ProjectController@postedProjects');

// 申し込みをした案件一覧
Route::get('/profile/applied-projects', 'ProjectController@appliedProjects');

// メッセージ投稿した案件一覧
Route::get('/profile/public-messages', 'MessageController@publicMessages');

// DM一覧
Route::get('/profile/dmrooms', 'RoomController@index');

// dmページ
Route::get('/dmroom/{id}', 'RoomController@show');

});

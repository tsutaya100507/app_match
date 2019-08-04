<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 案件一覧の取得
Route::get('/projects', 'Api\ProjectController@index');

// ログインユーザーが投稿した案件一覧を取得
Route::get('/user/projects', 'Api\ProjectController@getLoginUserProject');

// 案件へ申し込み済みかどうかのチェック
Route::get('/application', 'Api\ApplicationController@check');

// 案件への申し込み
Route::post('/application/store', 'Api\ApplicationController@store');

// パブリックメッセージの取得
Route::get('/project/{project_id}/messages', 'Api\MessageController@show');

// パブリックメッセージの投稿
Route::post('/message', 'Api\MessageController@store');

// DMのやりとりをするスペースを作成
Route::post('/room/store', 'Api\RoomController@store');

// DMの一覧を取得
Route::get('/dms', 'Api\DirectMessageController@show');

// DMの投稿
Route::post('/dm', 'Api\DirectMessageController@store');

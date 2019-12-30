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
// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');
// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');
// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
// ログインユーザー
Route::get('/user', function () {
    return Auth::user();
})->name('user');
//スケジュール一覧
Route::get('/schedule', 'ScheduleController@index')->name('schedule.index');
//スケジュール新規作成
Route::post('/schedule', 'ScheduleController@createSchedule')->name('schedule.create');
//スケジュール削除
Route::delete('/schedule/{id}', 'ScheduleController@deleteSchedule'); 
//スケジュール編集
Route::patch('/schedule/{id}','ScheduleController@editSchedule');
//イベント一覧
Route::get('/{schedule_id}/events', 'EventController@index')->name('event.index');
//日付ごとのイベント一覧
Route::get('/{schedule_id}/events/{date}', 'EventController@dateindex')->name('event.dateindex');
//イベント詳細
Route::get('/{schedule_id}/event/{event_id}', 'ScheduleController@Eventdetail')->name('event.detail');
//イベント作成
Route::post('/event/{id}', 'EventController@createEvent')->name('event.create');

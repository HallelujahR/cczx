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

//已读单个
Route::middleware('api')->get('/readone', function (Request $request) {
	$user = App\User::findOrFail($request->get('user'));

	foreach ($user->unreadNotifications as $notification) {
		if($request->get('id') == $notification->id){
			$notification -> markAsRead();
		}
	}
});

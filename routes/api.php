<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UserController;
use App\Models\User;


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

// UserInfo endpoint
// Route::middleware('auth:api')->get('/user/get', [UserController::class, 'get']);
Route::middleware('auth:api')->get('/user/get', 'App\Http\Controllers\UserController@get');
Route::middleware('auth:api')->post('/user/get', 'App\Http\Controllers\UserController@get');
// OAuth token
// Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/posts', function (Request $request) {
    return $request->user();
});

Route::get('/api-testing', function (Request $request) {
    return ['message' => 'all good'];
})->middleware('auth:api');

// Register
Route::post('/register', 'Auth\RegisterController@register');



// Route::middleware('auth:api', 'scope:view-user')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/logmeout', function (Request $request) {
    $user =  $request->user();
    $accessToken = $user->token();
    DB::table('oauth_refresh_tokens')
    ->where('access_token_id', $accessToken->id)
    ->delete();
    $user->token()->delete();


    return response()->json([
        'message' => 'Successfully logged out',
        'session' => session()->all()
    ]);
});

<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ActivityMemberController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\MasterActivityController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\UserActivityController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::get('/getUserImage', [UserController::class, 'getUserImage']);
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::put('/editUser', [UserController::class, 'editUser']);
Route::get('/myActivities', [UserController::class, 'myActivities']);
Route::get('/myJoinActivities', [UserController::class, 'myJoinActivities']);

Route::put('editActivity/{id}', [ActivityController::class, 'editActivity']);
Route::post('createActivity', [ActivityController::class, 'createActivity']);
Route::get('getActivity/{id}', [ActivityController::class, 'getActivity']);
Route::get('getAllActivities', [ActivityController::class, 'getAllActivities']);
Route::post('joinActivity/{id}', [ActivityMemberController::class, 'joinActivity']);

Route::get('myFriends', [FriendController::class, 'showFriend']);
Route::post('statusFriend', [FriendController::class, 'statusFriend']);
Route::post('addFriend', [FriendController::class, 'addFriend']);
Route::delete('deleteFriend', [FriendController::class, 'deleteFriend']);

Route::get('allActivities', [MasterActivityController::class, 'allActivities']);
Route::post('selectActivities', [MasterActivityController::class, 'selectActivities']);

Route::get('userActivities', [UserActivityController::class, 'showUserActivities']);
Route::post('addUserActivity', [UserActivityController::class, 'addUserActivities']);
Route::delete('deleteUserActivity', [UserActivityController::class, 'deleteUserActivities']);

Route::get('myNotification', [NotificationController::class, 'myNotification']);
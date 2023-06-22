<?php

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SpecializationsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('doctors', [DoctorController::class, 'index']);
Route::get('doctors/{id}', [DoctorController::class, 'show']);
Route::get('doctors/specialization/{id}', [DoctorController::class, 'searchBySpec']);
Route::get('doctors/filter/vote', [DoctorController::class,'filterVote']);
Route::get('doctors/search/{text}',[DoctorController::class, 'search']);
Route::post('doctors/message',[MessageController::class, 'store']);
Route::post('doctors/review',[ReviewController::class, 'store']);

Route::get('specializations', [SpecializationsController::class, 'index']);

Route::get('users', [UserController::class, 'index']);

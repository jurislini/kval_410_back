<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReminderController;
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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->post('/reminders', [ReminderController::class, 'store']);
Route::middleware('auth:sanctum')->group(function() {
  
    Route::get('/test2', function(){
        return ['test'=> 'Success'];
    });
});
Route::get('/test', function(){
    return ['test'=> 'Success'];
});

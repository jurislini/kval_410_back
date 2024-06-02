<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/', function () {
    return view('welcome');
});

// use Illuminate\Support\Facades\DB;

// Route::get('/list-tables', function () {
//     $tables = DB::select('SHOW TABLES');
//     $dbName = env('DB_DATABASE');
//     $tableList = [];

//     foreach ($tables as $table) {
//         $tableList[] = $table->{"Tables_in_{$dbName}"};
//     }

//     return response()->json($tableList);
// });



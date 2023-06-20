<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DprController;
use App\Http\Controllers\SelectionOptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DprController::class, 'index'])->name('welcome');
Route::post('/kecamatan', [DprController::class, 'kecamatan'])->name('get.kecamatan');

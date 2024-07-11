<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FatoorhController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pay', [FatoorhController::class, 'index'])->name('fatoorh');
Route::get('/callback', [FatoorhController::class, 'callback'])->name('callback');
Route::get('/error', [FatoorhController::class, 'error'])->name('error');


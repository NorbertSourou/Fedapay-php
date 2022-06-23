<?php

use App\Http\Controllers\PayoutController;
use Illuminate\Support\Facades\Route;

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
Route::post('/payer', [PayoutController::class, 'post'])->name('payer');
Route::get('/success', [PayoutController::class, 'success'])->name('success');
Route::match(array('GET', 'POST'), '/', [PayoutController::class, 'test'])->name('get');

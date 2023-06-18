<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;

/*
|--------------------------------------------------------------------------ph
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StaticController::class,'index']);
Route::post('/facture', [StaticController::class,'facture'])->name('facture');

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\TypeController;

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


Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [WordController::class, 'index'])->name('index');
    // Route::get('/words/slot', [WordController::class, 'slot'])->name('slot');
    Route::get('/words/slot', [WordController::class, 'pickUp'])->name('displaySlotResult');
    Route::get('/words/{cache}', [WordController::class, 'showCache'])->name('showCache');
    Route::resource('/words', WordController::class)->except('index');
        Route::post('/words/search', [WordController::class, 'search_result'])->name('search_result');
    Route::resource('/types', TypeController::class)->except('index');
    Route::resource('/users', UserController::class)->except(('index'));
});

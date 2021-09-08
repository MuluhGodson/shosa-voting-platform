<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\CandidateController;

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

Route::domain('vote.'.config('app.domain'))->group(function () {
    //Route::get('/', [PageController::class, 'welcome'])->name('welcome');
    Route::get('/', [VoteController::class, 'index'])->name('welcome');
    Route::get('/apply', [PageController::class, 'apply'])->name('apply'); //If enabling the route below change this route name to simply apply.
    //Route::get('/apply/{contest}', [PageController::class, 'application'])->name('candidate.apply');
    Route::get('/vote', [VoteController::class, 'index'])->name('vote');
    Route::get('/vote/{contest}', [VoteController::class, 'show'])->name('vote.candidate');

    Route::middleware(['web', 'auth:sanctum', 'verified'])->group(function () {
        Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
        Route::get('/contest', [ContestController::class, 'index'])->name('contest.index');
        Route::get('/{contest}/candidates', [CandidateController::class, 'index'])->name('candidate.index');

        Route::get('/finance', [PageController::class, 'finance'])->name('finance.index');
    });
});

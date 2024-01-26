<?php

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


Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('match')->group(function() {
    Route::prefix('/team')->group(function() {
        Route::get('/list-match', [App\Http\Controllers\MatchController::class, 'indexTeam'])->name('match.team.index');
        Route::get('/reset-match', [App\Http\Controllers\MatchController::class, 'resetTeam'])->name('match.team.reset');
        Route::post('/make-match-team', [App\Http\Controllers\MatchController::class, 'makeMatchTeam'])->name('match.team.make');
    });
    Route::prefix('/tunggal')->group(function() {
        Route::get('/list-match', [App\Http\Controllers\MatchController::class, 'indexIndividu'])->name('match.individu.index');
        Route::get('/make-match-tunggal', [App\Http\Controllers\MatchController::class, 'matchTunggal'])->name('match.individu.make');
        Route::get('/reset-match', [App\Http\Controllers\MatchController::class, 'resetIndividu'])->name('match.individu.reset');
    });
});

Route::prefix('member')->group(function() {
    Route::get('/list-member', [App\Http\Controllers\MemberController::class, 'index'])->name('member.index');
    Route::post('/store-member', [App\Http\Controllers\MemberController::class, 'store'])->name('member.store');
    Route::get('/destroy-member/{id}', [App\Http\Controllers\MemberController::class, 'destroy'])->name('member.destroy');
    Route::get('/reset-member', [App\Http\Controllers\MemberController::class, 'resetMember'])->name('member.reset');
});


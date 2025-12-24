<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Manager\TicketController;
use App\Http\Middleware\IsManager;
use Illuminate\Support\Facades\Route;

Route::view('/', 'main')->name('main');

Route::view('/feedback-widget', 'feedback.widget')->withoutMiddleware('web');

Route::name('manager.tickets.')
    ->prefix('manager/tickets')
    ->controller(TicketController::class)
    ->middleware(IsManager::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{ticket}', 'show')->name('show');
        Route::put('/{ticket}', 'update')->name('update');
    });

Route::view('/auth', 'auth.form')->name('auth.form')->middleware('guest');
Route::post('/auth', [AuthController::class, 'authorize'])->name('auth.login')->middleware('guest');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

<?php

use App\Http\Controllers\TicketStatisticsController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;


Route::post('/tickets', [WidgetController::class, 'store'])->name('ticket.store');

Route::get('/tickets/statistics', TicketStatisticsController::class);

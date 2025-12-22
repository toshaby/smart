<?php

use App\Enums\StatusEnum;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Manager\TicketController;
use App\Http\Middleware\IsManager;
use App\Http\Requests\Auth\AuthorizeRequest;
use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

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

Route::get('/test', function () {
    $rez = 'newr';
    $rez = User::find(5)->hasRole('manager');
    //$rez = StatusEnum::{$rez}->getName();
    /*
    $ticket = Ticket::find(15);
    foreach($ticket->getMedia() as $file)
        $rez .= $file->getUrl() . " ";
    */
    dump($rez);
    return $rez;
});

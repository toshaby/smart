<?php

use App\Enums\StatusEnum;
use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/feedback-widget', 'feedback.widget');


Route::get('/test', function () {
    $rez = '';
    /*
    $ticket = Ticket::find(15);
    foreach($ticket->getMedia() as $file)
        $rez .= $file->getUrl() . " ";
    */
    dump($rez);
    return $rez;
});

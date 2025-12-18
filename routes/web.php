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


Route::get('/test', function () {
    $rez = '';

    //$rez = Ticket::find(132)->getMedia();

    $rez = User::find(4)->getRoleNames();

    //$rez = Ticket::find(1)->getMedia()[1]->getUrl();
    dump($rez);
    return $rez;
});

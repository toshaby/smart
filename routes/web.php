<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/test', function(){
    //Storage::disk('public')->put('example.txt', 'my new file surok');
    return asset('storage/example.txt');
});
*/

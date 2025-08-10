<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/court', function () {
    return view('cliplist');
});
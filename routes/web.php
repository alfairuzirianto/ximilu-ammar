<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('layouts.admin');
});

Route::get('/login', function () {
    return view('login');
});

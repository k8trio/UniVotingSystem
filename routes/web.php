<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/ballot', function () {
    return view('ballot');
});

Route::get('/review', function () {
    return view('review');
});

Route::get('/voted', function () {
    return view('voted');
});

Route::get('/transparency', function () {
    return view('transparency');
});

Route::get('/admin', function () {
    return view('admin');
});
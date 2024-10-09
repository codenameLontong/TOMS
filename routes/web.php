<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function () {
//     return view('/Login/login');
// });

// Route::get('/dashboard', function () {
//     return view('/Dashboard/dashboard');
// });


// Route::get('/pegawai', function () {
//     return view('/Dashboard/pegawai');
// });

<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/curah-hujan', function () {
    return Inertia::render('CurahHujan');
})->name('curah-hujan');

Route::get('/tma-debit', function () {
    return Inertia::render('TmaDebit');
})->name('tma-debit');

Route::get('/iklim', function () {
    return Inertia::render('Iklim');
})->name('iklim');

Route::get('/kualitas-air', function () {
    return Inertia::render('KualitasAir');
})->name('kualitas-air');

Route::get('/permohonan-data', function () {
    return Inertia::render('PermohonanData');
})->name('permohonan-data');

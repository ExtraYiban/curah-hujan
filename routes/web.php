<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Weather API routes
Route::prefix('api')->group(function () {
    Route::get('/weather', [WeatherController::class, 'index'])->name('api.weather');
    Route::post('/weather/refresh', [WeatherController::class, 'refresh'])->name('api.weather.refresh');
});

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

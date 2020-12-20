<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'series'], function() {
    Route::get('/', [SeriesController::class, 'index'])->name('serie.index');
    Route::get('/create', [SeriesController::class, 'create'])->name('serie_create');
    Route::post('/create', [SeriesController::class, 'store'])->name('serie_store');
    Route::delete('/remove/{id}', [SeriesController::class, 'destroy'])->name('serie_destroy');
    Route::get('/{serieId}/temporadas', [TemporadasContoller::class, 'index'])->name('temporada.index');
    Route::post('/{id}/editar-nome', [SeriesController::class, 'updateName']);
});



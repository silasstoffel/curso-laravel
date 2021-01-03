<?php

use App\Http\Controllers\EntrarController;
use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasContoller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'series'], function () {
    Route::get('/', [SeriesController::class, 'index'])->name('serie.index');
    Route::get('/create', [SeriesController::class, 'create'])->name('serie_create')->middleware('autenticador');
    Route::post('/create', [SeriesController::class, 'store'])->name('serie_store')->middleware('autenticador');
    Route::delete('/remove/{id}', [SeriesController::class, 'destroy'])->name('serie_destroy');
    Route::post('/{id}/editar-nome', [SeriesController::class, 'updateName']);
    Route::get('/{serieId}/temporadas', [TemporadasContoller::class, 'index'])->name('temporada.index');
});

Route::group(['prefix' => 'temporadas'], function () {
    Route::get('/{temporada}/episodios', [EpisodiosController::class, 'index']);
    Route::post('/{temporada}/episodios/assistir', [EpisodiosController::class, 'watch']);
});

Route::get('/entrar', [EntrarController::class, 'index']);
Route::post('/entrar', [EntrarController::class, 'entrar']);

Route::get('/registrar', [RegistrarController::class, 'create']);
Route::post('/registrar', [RegistrarController::class, 'store']);

Route::get('/sair', function() {
    Auth::logout();
    return redirect('/entrar');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mail', function() {
    return new \App\Mail\SerieCriada('Arrow', 4, 23);
});

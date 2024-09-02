<?php

use App\Http\Controllers\UFController;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\RodoviasController;
use App\Http\Controllers\TrechoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return inertia('Cadastro');
})->name('home');

Route::get('/ufs', [UFController::class, 'show'])->name('ufs.show');
Route::get('/rodovias/{id}', [RodoviasController::class, 'show'])->name('rodovias.show');
Route::post('/geo', [GeoController::class, 'processGeoData'])->name('geoData.process');
Route::get('/trechos', [TrechoController::class, 'fetchTrechos'])->name('trechos.fetch');
Route::delete('/trechos/{id}', [TrechoController::class, 'deleteTrecho'])->name('trecho.delete');
Route::get('/trechos/{id}/edit', [TrechoController::class, 'edit'])->name('trechos.edit');
Route::put('/trechos/{id}', [TrechoController::class, 'update'])->name('trechos.update');

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemon', [App\Http\Controllers\pokemon::class, 'index']);
Route::post('/pokemon', [App\Http\Controllers\pokemon::class, 'store'])->name('pokemon.store');
Route::put('/pokemon/{id}', [App\Http\Controllers\pokemon::class, 'edit'])->name('pokemon.edit');
Route::delete('/pokemon/{id}', [App\Http\Controllers\pokemon::class, 'delete'])->name('pokemon.delete');

Route::get('/tipo_pokemon', [App\Http\Controllers\tipo_pokemon::class, 'index']);
Route::post('/tipo_pokemon', [App\Http\Controllers\tipo_pokemon::class, 'store'])->name('tipo_pokemon.store');
Route::put('/tipo_pokemon/{id}', [App\Http\Controllers\tipo_pokemon::class, 'edit'])->name('tipo_pokemon.edit');
Route::delete('/tipo_pokemon/{id}', [App\Http\Controllers\tipo_pokemon::class, 'delete'])->name('tipo_pokemon.delete');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchZipcode;
use App\Http\Livewire\Show\Show;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('/', SearchZipcode::class)->name('search-zip');
Route::get('/show', Show::class)->name('show-zip');

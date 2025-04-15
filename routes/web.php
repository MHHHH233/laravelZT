<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routage;
use App\Http\Controllers\control;
Route::get('/', function () {
    return view('welcome');
});
Route::Resource('action',control::class)->names('action');
Route::post('autho',[control::class,"autho"])->name('autho');
Route::get('logout',[control::class,"logout"])->name('logout');
Route::get('orm',[control::class,"orm"])->name('orm');

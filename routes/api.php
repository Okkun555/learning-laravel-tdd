<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::post('/lessons/{lesson}/reserve', 'Lesson\ReserveController')->name('lessons.reserve');
});

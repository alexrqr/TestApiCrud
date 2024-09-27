<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* CODIGO DE TEST PARA API'S */
Route::get('/recetas', [RecetsController::class, 'index']);
Route::post('/recetas', [RecetsController::class, 'store'])->middleware('auth:sanctum');
Route::put('/recetas/{receta}', [RecetsController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/recetas/{receta}', [RecetsController::class, 'destroy'])->middleware('auth:sanctum');


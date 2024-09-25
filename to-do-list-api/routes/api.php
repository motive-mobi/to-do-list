<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// TASKS API ROUTES
Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index');
    Route::post('/tasks', 'store');
    Route::put('/tasks/{id}', 'update');
    Route::delete('/tasks/{id}', 'destroy');
});
<?php

use App\Http\Controllers\Api\ToDoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return sprintf("%s API", config('app.name'));
});

Route::prefix('todo')->controller(ToDoController::class)->group(function () {
    Route::get('/', 'getAll');
    Route::get('{toDoId}', 'getOne');
    Route::post('/', 'create');
    Route::put('{toDoId}', 'update');
    Route::delete('{toDoId}', 'delete');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

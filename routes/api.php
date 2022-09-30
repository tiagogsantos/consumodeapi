<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

// Retorno de todos os estudantes
Route::get('studants', [ApiController::class, 'getAllStudentes']);

// Criação de estudantes
Route::post('studants', [ApiController::class, 'createStudant']);

// Retorno de um estudante em especifico
Route::get('studants/{id}', [ApiController::class, 'getStudant']);

// Atualizando um usuário em expecifico
Route::put('studants/{id}', [ApiController::class, 'updateStudant']);

// Deletando um usuário em especifico
Route::delete('studants/{id}', [ApiController::class, 'deleteStudant']);

<?php

use App\Http\Controllers\ExposicaoController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TipoDeItemController;
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

/* Exposição */
Route::get('/exposicao', [ExposicaoController::class, 'index'])->middleware('cors');
Route::get('/exposicoesAtivas', [ExposicaoController::class, 'activeExhibitions'])->middleware('cors');
Route::get('/exposicao/{id}', [ExposicaoController::class, 'show'])->middleware('cors');
Route::get('/exposicao/instituicao/{id}', [ExposicaoController::class, 'getExhibitionsByInstitution'])->middleware('cors');
Route::post('/exposicao', [ExposicaoController::class, 'store'])->middleware('cors', 'checkToken');
Route::post('/exposicao/{id}', [ExposicaoController::class, 'update'])->middleware('cors', 'checkToken');
Route::delete('/exposicao/{id}', [ExposicaoController::class, 'destroy'])->middleware('cors', 'checkToken');

/* Item */
Route::get('/item', [ItemController::class, 'index'])->middleware('cors');
Route::get('/item/{id}', [ItemController::class, 'show'])->middleware('cors');
Route::post('/item', [ItemController::class, 'store'])->middleware('cors', 'checkToken');
Route::post('/item/{id}', [ItemController::class, 'update'])->middleware('cors', 'checkToken');
Route::delete('/item/{id}', [ItemController::class, 'destroy'])->middleware('cors', 'checkToken');

/* Tipo de Item */
Route::get('/tipoDeItem', [TipoDeItemController::class, 'index'])->middleware('cors');

/* Instituição */
Route::post('/login', [InstituicaoController::class, 'login'])->middleware('cors');

/* When the Token is Invalid */
Route::get('/tokenError', function () {
    return json_encode(["message" => "Access Denied"])->middleware('cors');
});

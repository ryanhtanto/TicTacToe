<?php

use App\Http\Controllers\GameController;
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

Route::get('/', [GameController::class, 'homeIndex']);
Route::get('/new-game', [GameController::class, 'newGameIndex']);
Route::get('/history', [GameController::class, 'historyIndex']);
Route::get('/csrf-token', function() {
        return response()->json(['csrfToken' => csrf_token()]);
});
Route::post('/save', [GameController::class, 'save']);
Route::get('/game-history/{id}', [GameController::class, 'show']);

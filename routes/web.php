<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Route::get('/index', [TodoController::class, 'index']);
Route::get('/find', [TodoController::class, 'find']);
Route::post('/find', [TodoController::class, 'search']);
Route::post('/add', [TodoController::class, 'create']);
Route::post('/edit', [TodoController::class, 'update']);
Route::post('/delete', [TodoController::class, 'remove']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransacaoController;
use App\Http\Controllers\SiteController;

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

Route::redirect('/', '/login');

Route::get('/home', [SiteController::class, 'home'])->middleware(['auth'])->name('dashboard');

Route::post('/transacao', [TransacaoController::class, 'CriarTransacao']);

require __DIR__.'/auth.php';

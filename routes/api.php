<?php

declare(strict_types=1);

use App\Http\Controllers\CounterController;
use App\Http\Controllers\PlayerController;
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

Route::get(
    uri: '/create/',
    action: [PlayerController::class, 'create']
)->name(name: 'user_create');

Route::get(
    uri: '/counter-reset/',
    action: [CounterController::class, 'reset']
)->name(name: 'counter_reset');

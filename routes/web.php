<?php

use App\Http\Controllers\OverpickerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$DATES = include(config_path('dates.php'));

Route::get('/', [OverpickerController::class, 'home']);

Route::get('/tiers', [OverpickerController::class, 'tiers']);

Route::get('/about', [OverpickerController::class, 'about']);

Route::get('/sources', [OverpickerController::class, 'sources']);

Route::get('/privacy', [OverpickerController::class, 'privacy']);

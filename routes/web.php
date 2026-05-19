<?php

use App\Http\Controllers\HeroController;
use App\Http\Controllers\OverpickerController;
use App\Http\Controllers\PageController;
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

Route::get('/', [OverpickerController::class, 'home']);

Route::get('/tiers', [OverpickerController::class, 'tiers']);

Route::get('/heroes', [HeroController::class, 'heroes']);
Route::get('/heroes/{hero}', [HeroController::class, 'heroDetail']);

Route::get('/counters', [OverpickerController::class, 'counters']);

Route::get('/synergies', [OverpickerController::class, 'synergies']);

Route::get('/maps', [OverpickerController::class, 'maps']);

Route::get('/about', [PageController::class, 'about']);

Route::get('/privacy', [PageController::class, 'privacy']);

Route::get('/trackers', [PageController::class, 'trackers']);

Route::get('/sitemap.xml', [PageController::class, 'sitemap']);

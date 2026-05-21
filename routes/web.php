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

Route::get('/local-api/{resource}', function (\Illuminate\Http\Request $request, $resource) {
    if (!$request->ajax()) {
        abort(403);
    }

    $allowed = [
        'map-info'       => 'map-data/map-info.json',
        'map-type'       => 'map-data/map-type.json',
        'hero-tiers'     => 'hero-data/hero-tiers.json',
        'hero-info'      => 'hero-data/hero-info.json',
        'hero-img'       => 'hero-data/hero-img.json',
        'hero-counters'  => 'hero-data/hero-counters.json',
        'hero-synergies' => 'hero-data/hero-synergies.json',
        'hero-maps'      => 'hero-data/hero-maps.json',
        'hero-adc'       => 'hero-data/hero-adc.json',
        'version'        => 'version.json',
    ];

    if (!isset($allowed[$resource])) {
        abort(404);
    }

    $path = storage_path('api/' . $allowed[$resource]);
    return response()->json(json_decode(file_get_contents($path)));
});

<?php

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

Route::get('/', function () use ($DATES) {
    $title = ' - Overwatch tool made to build Composition based in Counter and Synergies';
    return view('calculator',[
        'title' => $title,
        'dates' => $DATES,
    ]);
});

// Route::get('/tiers', function () {
//     return view('tiers');
// });

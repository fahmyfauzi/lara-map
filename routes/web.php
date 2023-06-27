<?php

use App\Http\Livewire\MapLocation;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MapLivewire;
use App\Models\Location;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/map', MapLocation::class)->middleware('auth');
Route::get('/', MapLivewire::class);

// show readmore or virtual tour
Route::get('/{id}', function ($locationId) {
    $data = Location::where('id', $locationId)->first();
    return view('show', ['data' => $data]);
});

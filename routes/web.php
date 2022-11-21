<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Http\Request;
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

// Show all listings
Route::get('/', [ListingController::class, 'index']);

// Store a new listing
Route::post('/listings', [ListingController::class, 'store']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create']);



// Show a single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);






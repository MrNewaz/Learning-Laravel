<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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
Route::get('/', [ListingController::class, 'index']) ;

// Store a new listing
Route::post('/listings', [ListingController::class, 'store']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create']) -> middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage']) -> middleware('auth');

// Show edit form
Route::get('/listing/{listing}/edit', [ListingController::class, 'edit']) -> middleware('auth');

// Update a listing
Route::put('/listing/{listing}', [ListingController::class, 'update']) -> middleware('auth');

// Delete a listing
Route::delete('/listing/{listing}', [ListingController::class, 'destroy']) -> middleware('auth');

// Show a single listing
Route::get('/listing/{listing}', [ListingController::class, 'show']);

// Show registration form
Route::get('/register', [UserController::class, 'create']) -> middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Logout
Route::post('/logout', [UserController::class, 'logout']) -> middleware('auth');

// Show login form
Route::get('/login', [UserController::class, 'loginForm']) -> name('login') -> middleware('guest');

// Login
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



<?php

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

Route::get('/', function () {
    return view('listings', [
        'heading' => 'Latest Listings',
        'listings' => Listing::all(),
    ]);
});

Route::get('/listing/{id}', function ($id) {
    return view('listing', [
        'heading' => 'Latest Listings for ' . $id,
     
    ]);
});



// Route::get('/hello/{id}', function ($id) {
//     // ddd($id);
//     return response ('<h1>Hello '.$id.'</h1>',200);
// }) -> where('id','[0-9]+');


// Route::get('/hm', function (Request $request) {
//     $name = $request->input('name');
//     return response ('<h1>Hello '.$name.'</h1>',200);
// });
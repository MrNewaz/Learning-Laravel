<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest() // Get all listings
                ->filter(request(['tag','search'])) // Filter by search
                ->get() // Get the results,
        ]);
    }

    // Show a single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    // Show create form
    public function create()
    {
        return view('listings.create');
    }

    // Store a new listing
    public function store( Request $request )
    {
        $attributes = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($attributes);

        return redirect('/')->with('success', 'Listing created successfully!');
    }
}

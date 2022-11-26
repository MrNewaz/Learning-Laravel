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
                ->paginate(6) // Get the results,
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

        if( $request->hasFile('logo') ) {
            $attributes['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $attributes['user_id'] = auth()->id();

        Listing::create($attributes);

        return redirect('/')->with('success', 'Listing created successfully!');
    }

    // Show edit form
    public function edit(Listing $listing)
    {
        return view('listings.edit', [
            'listing' => $listing,
        ]);
    }

     // Update a new listing
     public function update( Request $request, Listing $listing )
     {
        if($listing -> user_id !== auth()->id()) {
           abort(403 , 'You are not authorized to edit this listing');
        }
         $attributes = $request->validate([
             'title' => 'required',
             'company' => ['required'],
             'location' => 'required',
             'website' => 'required',
             'email' => ['required', 'email'],
             'tags' => 'required',
             'description' => 'required'
         ]);
 
         if( $request->hasFile('logo') ) {
             $attributes['logo'] = $request->file('logo')->store('logos', 'public');
         }
 
         $listing->update($attributes);
 
         return back()->with('success', 'Listing updated successfully!');
     }

    // Delete a listing
    public function destroy(Listing $listing)
    {
        if($listing -> user_id !== auth()->id()) {
            abort(403 , 'You are not authorized to delete this listing');
         }
        $listing->delete();

        return redirect('/')->with('success', 'Listing deleted successfully!');
    }

    // Manage Listings
    public function manage()
    {
        return view('listings.manage', [
            'listings' => Listing::where('user_id', auth()->id()) // Get all listings
                ->latest() // Get all listings
                ->paginate(6) // Get the results,
        ]);
    }
}

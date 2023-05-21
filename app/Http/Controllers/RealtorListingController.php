<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function show(Listing $listing)
    {
        return inertia(
            'Realtor/Show',
            ['listing' => $listing->load('offers','offers.bidder')]
        );
    }

    public function index(Request $request)
    {   
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by','order'])
        ];

        return inertia(
            'Realtor/Index',
            [   'filters' => $filters,
                'listings' => Auth::user()
                            ->listings()
                            ->filter($filters)
                            ->withCount('images')
                            ->withCount('offers')
                            ->paginate(5)
                            ->withQueryString()
            ]
        );
    }

    public function create()
    {
        return inertia("Realtor/Create");
    }

    public function store(Request $request)
    {
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:2|max:20',
                'baths' => 'required|integer|min:2|max:20',
                'area' => 'required|integer|min:15|max:15000',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect()->route('realtor.listing.index')->withSuccess('Listing was created!');
    }

    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:2|max:20',
                'baths' => 'required|integer|min:2|max:20',
                'area' => 'required|integer|min:15|max:15000',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect()->route('realtor.listing.index')->withSuccess('Listing was changed!');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->back()->withSuccess('Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->withSuccess('Listing was restored!');
    }
}
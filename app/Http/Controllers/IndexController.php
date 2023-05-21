<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() {
        Listing::make([
            'beds' => 2,'baths' => 2,'area' => 100,'city' => 'North','street' => 'Tinker st','street_nr' => 20,'code' => 'TS','price' => 200_000
        ]);
        return inertia(
        "Index/Index",
        [
            'content' => "This is index page"
            ]
        );
    }

    public function show() {
        return inertia(
            "Index/Show",
            [
                'content' => "This is show page"
            ]
        );
    }
}

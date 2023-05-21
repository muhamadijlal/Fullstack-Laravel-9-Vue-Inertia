<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function store(RegisterFormRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password
        ]);

        Auth::login($user);
        event(new Registered($user));

        return redirect()->route('listing.index')->withSuccess('Account created!');
    }
}

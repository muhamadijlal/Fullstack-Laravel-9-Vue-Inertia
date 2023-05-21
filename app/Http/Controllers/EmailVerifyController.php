<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerifyController extends Controller
{
    public function notVerifiedYet()
    {
        return inertia('Auth/VerifyEmail');
    }

    public function verifiedEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()
                ->route('listing.index')
                ->withSuccess('Email was verified!');
    }

    public function resendEmailVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->back()->withSuccess('Verification link sent!');
    }
}
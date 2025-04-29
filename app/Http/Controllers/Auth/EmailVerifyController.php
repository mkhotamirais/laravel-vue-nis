<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function notice(Request $request)
    {
        if (request()->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }
        $status = session('status');
        return inertia('Auth/VerifyEmail', compact('status'));
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'Link verifikasi telah dikirim!');
    }
}

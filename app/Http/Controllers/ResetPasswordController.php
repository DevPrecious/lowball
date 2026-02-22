<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /**
     * Show the reset password page.
     */
    public function index()
    {
        return view('reset-password');
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        if ($user) {
            $user->update([
                'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            ]);

            return back()->with('success', 'Password updated successfully.');
        }

        return back()->with('error', 'Unable to update password.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show the settings page.
     */
    public function index()
    {
        return view('settings');
    }

    /**
     * Update the user's profile settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . optional(auth()->user())->id,
            'job_title' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        if ($user) {
            $user->update($validated);
            return back()->with('success', 'Profile updated successfully.');
        }

        return back()->with('error', 'Unable to update profile.');
    }
}

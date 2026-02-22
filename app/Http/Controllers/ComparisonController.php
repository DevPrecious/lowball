<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SavedOffer;

class ComparisonController extends Controller
{
    /**
     * Show the AI negotiation strategy dashboard.
     */
    public function index(?SavedOffer $offer = null)
    {
        if (!$offer) {
            $offer = auth()->user()->savedOffers()->latest()->first();
            if (!$offer) {
                return redirect()->route('saved-offers');
            }
        } elseif ($offer->user_id !== auth()->id()) {
            abort(403);
        }

        $targetSalary = $offer->salary * 1.20; // Example target calculation

        return view('comparison', compact('offer', 'targetSalary'));
    }
}

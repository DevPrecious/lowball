<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedOfferController extends Controller
{
    /**
     * Show the saved offers dashboard.
     */
    public function index()
    {
        $offers = Auth::user()->savedOffers()->latest()->get();

        // Compute summary stats
        $avgOffer = $offers->count() > 0 ? $offers->avg('salary') : 0;
        $avgScore = $offers->count() > 0 ? $offers->avg('lowball_score') : 0;

        // Negotiation leverage based on average lowball score
        $leverage = match (true) {
            $avgScore >= 70 => 'High',
            $avgScore >= 40 => 'Medium',
            $avgScore > 0 => 'Low',
            default => '—',
        };

        // Market percentile derived from average score
        $percentile = $offers->count() > 0 ? round($avgScore) : 0;

        // Potential upside: difference between best offer and average
        $bestOffer = $offers->max('salary') ?? 0;
        $potentialUpside = $offers->count() > 1 ? $bestOffer - $avgOffer : 0;

        return view('saved-offers', compact(
            'offers',
            'avgOffer',
            'leverage',
            'percentile',
            'potentialUpside',
        ));
    }
}

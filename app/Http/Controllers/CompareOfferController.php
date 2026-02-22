<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompareOfferController extends Controller
{
    /**
     * Show the offer comparison page.
     */
    public function index(Request $request)
    {
        $ids = $request->query('ids', []);

        if (count($ids) !== 2) {
            return redirect()->route('saved-offers')->with('error', 'Please select exactly two offers to compare.');
        }

        $offers = \App\Models\SavedOffer::whereIn('id', $ids)
            ->where('user_id', auth()->id())
            ->get();

        if ($offers->count() !== 2) {
            return redirect()->route('saved-offers')->with('error', 'One or both offers could not be found.');
        }

        return view('compare-offers', [
            'offerA' => $offers[0],
            'offerB' => $offers[1],
        ]);
    }
}

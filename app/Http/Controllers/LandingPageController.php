<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Show the landing page.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the offer details form.
     */
    public function offerDetails()
    {
        return view('offer-details');
    }
}

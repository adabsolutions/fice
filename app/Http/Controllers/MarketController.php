<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pr_market;
use App\ce_currency_ref;

class MarketController extends Controller
{
    //
    public function index()
    {

    	$cecurrencies = ce_currency_ref::all();
        $pr_markets = pr_market::orderBy('currency_right', 'ASC')->get();
        return view('market', compact('pr_markets', 'cecurrencies'));
    }
}

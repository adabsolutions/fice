<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\ce_currency_ref;
use App\pr_market;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
class Balances extends Controller
{
    public function index()
    {

    	$wallets1 = Wallet::where('user_id', '=', Auth::user()->id)->first();
    	if(empty($wallets1)){
		$wallets1 = new Wallet();
		$wallets1->create_wallets(Auth::user()->id);
	}





        $wallets = Wallet::all();
        $cecurrencies = ce_currency_ref::all();
        $pr_markets = pr_market::all();
        return view('balances', compact( 'wallets', 'cecurrencies', 'pr_markets'));
    }
}

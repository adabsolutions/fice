<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ce_currency_ref;
use DB;
use Auth;

class wallet extends Model
{
    //
    protected $table = 'wl_wallets';


	public function create_wallets($data)
	{
	   $currencies =ce_currency_ref::all();
	   
	  
	   foreach($currencies as $currency){
	   		
	   			$user_id=$data;
	   			$currency1 =$currency->id;
	   		
	   		 $table=new Wallet;
	   		 $table->user_id=$user_id;
	   		 $table->currency=	$currency1;
	   		 if($currency->currency=='BTC'){
	   		 $table->balance=1;
	   		}
	   		elseif($currency->currency=='ETH'){
	   			$table->balance=10;
	   		}
	   		elseif($currency->currency=='ADAB'){
	   			$table->balance=1000;
	   		}
	   		elseif($currency->currency=='USD'){
	   			$table->balance=10000;
	   		}
	   		else{
	   			$table->balance=100;
	   		}

	   		 $table->save();
	   		
	   		}
	   		// DB::create('insert into wl_wallets (user_id, currency) values (?, ?)', [$user_id, $currency1]);
	   		}
	    
	   
	   
	

   
}









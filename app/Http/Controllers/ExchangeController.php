<?php

namespace App\Http\Controllers;


//use Illuminate\Http\Request;
use App\Exchange_glass;
use App\Wallet;
use App\ce_trans;
use App\ce_currency_ref;
use App\User;
use App\pr_market;
use Auth;
use DB;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{

//protected $table = 'dc_orders';


    public function index($currency1_POST, $currency2_POST)
   
    {
        $orders = DB::select("select ce_glass.id as id,ce_glass.status as status, ce_glass.currency_from as currency_from, ce_glass.currency_to as currency_to, ce_glass.trade_type as type, ce_glass.price as price, ce_glass.amount as amount, price*amount as total
from ce_glass 
where user_id=?", [Auth::id()]);
        $glasses = Exchange_glass::where([
            ['status', '=', '1'],
            //['wallet', '=', '1'],
        ])->orderBy('id', 'DESC')
        ->limit(20)
        ->get();
        $cetrans = ce_trans::where([
           ['trans_type','=', '1'],
        ])->orderBy('id', 'DESC')
        ->limit(20)
        ->get();
        $pr_markets = pr_market::orderBy('currency_left', 'ASC')->get();
	$cecurrencies = ce_currency_ref::all();


        
        $trade_histories=DB::select("select dc_orders.created_at as time, dc_orders.currency_from as currency_from, 
dc_orders.currency_to as currency_to, dc_orders.trade_type as type, dc_orders.price as price, 
dc_orders.amount as amount, dc_orders.price*dc_orders.amount as total
from dc_orders order By dc_orders.created_at DESC LIMIT 50");
        


     
        

            $wallets = DB::select("SELECT DISTINCT ON(currency) wl_wallets.user_id, ce_currency_refs.currency as currency, ce_trans.balance as balance , wl_wallets.block_balance as block_balance
              FROM ce_trans
              LEFT JOIN wl_wallets ON ce_trans.wallet_from = wl_wallets.id
              LEFT JOIN ce_currency_refs ON wl_wallets.currency=ce_currency_refs.id
              WHERE wl_wallets.user_id = ?
              ORDER BY currency, ce_trans.id desc", [Auth::id()]);


return view('exchange', compact('glasses', 'orders', 'wallets', 'cetrans', 'pr_markets', 'cecurrencies', 'currency1_POST', 'currency2_POST', 'trade_histories'));        


    }



     function getGlassOrdersSell(Request $request){




        if($request->ajax()){
          $output='';
          $request->all();
         $currency_from=$request->get('currencyFrom');
$currency_to=$request->get('currencyTo');
        $data=Exchange_glass::where([
            ['status', '=', '1'],
            ['currency_from', '=', $currency_from],
            ['currency_to', '=', $currency_to],
            ['trade_type', '=', 1],
        ])->orderBy('id', 'DESC')
        ->limit(20)
        ->get();
        foreach($data as $row)
       {
        $output .= '
        <tr class="tableItems" >
         <td>'.$row->price.'</td>
         <td>'.$row->amount.'</td>
         <td>'.$row->price*$row->amount.'</td>
         
        </tr>
        ';
       }     
}    
else{
$output .= '
        <tr class="tableItems" >
         <td>Нет данных</td>
         
         
        </tr>
        ';
}
  echo json_encode($output);
   }


      function getGlassOrdersBuy(Request $request){
        if($request->ajax()){
          $output='';
          $request->all();
          $currency_from=$request->get('currencyFrom');
          $currency_to=$request->get('currencyTo');
          $data=Exchange_glass::where([
            ['status', '=', '1'],
            ['currency_from', '=', $currency_from],
            ['currency_to', '=', $currency_to],
            ['trade_type', '=', 2],
        ])->orderBy('id', 'DESC')
        ->limit(20)
        ->get();
        foreach($data as $row)
       {
        $output .= '
        <tr class="tableItems" >
         <td>'.$row->price.'</td>
         <td>'.$row->amount.'</td>
         <td>'.$row->price*$row->amount.'</td>
        </tr>
        ';
       }
}    
else{
$output .= '
        <tr class="tableItems" >
         <td>Нет данных</td>      
        </tr>
        ';
}
  echo json_encode($output);
    }



          function getTradeHistory(Request $request){
        if($request->ajax()){
          $output='';
          $request->all();
          $currency_from=$request->get('currencyFrom');
          $currency_to=$request->get('currencyTo');
       
        $data=DB::select("SELECT dc_orders.created_at as time, currency1.currency as currency1, currency2.currency as currency2, 
          dc_orders.trade_type as trade_type, dc_orders.price as price, 
          dc_orders.amount, (dc_orders.price*dc_orders.amount) as total
          FROM dc_orders
          LEFT JOIN ce_currency_refs currency1 on dc_orders.currency_from=currency1.id
          LEFT JOIN ce_currency_refs currency2 on dc_orders.currency_to=currency2.id
          WHERE dc_orders.currency_from=? and dc_orders.currency_to=?
          ORDER BY dc_orders DESC
          LIMIT 20", [$currency_from, $currency_to]);
        
        foreach($data as $row)
       {
        $output .= '
        <tr class="tableItems" >
         <td>'.$row->time.'</td>
         <td>'.$row->currency1+'/'+$row->currency2.'</td>
          <td>'.$row->trade_type.'</td>
         <td>'.$row->price.'</td>
          <td>'.$row->amount.'</td>
          <td>'.$row->price*$row->amount.'</td>
        </tr>
        ';
       }
}    
else{
$output .= '
        <tr class="tableItems" >
         <td>Нет данных</td>      
        </tr>
        ';
}
  echo json_encode($output);
    }



   

}





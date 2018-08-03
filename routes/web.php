<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'PostsController@index');
Auth::routes();

//Route::get('/home', 'HomeController@index')->middleware('2fa');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', '2fa']);

Route::get('/market', 'MarketController@index')->name('market');

Route::get('/auth/logout', function() {
    Auth::logout();
    return Redirect::to('/')->with('success', 'You have successfully logged out');
});

Route::get('users/{user}/request-confirmation', 'UserEmailConfirmationController@request')->name('request-confirm-email')->middleware('auth');

Route::post('/users/{user}/send-confirmation-email', 'UserEmailConfirmationController@sendEmail')->name('send-confirmation-email')->middleware('auth');

Route::get('/users/{user}/confirm-email/{token}', 'UserEmailConfirmationController@confirm')->name('confirm-email');





Route::get('/2fa','PasswordSecurityController@show2faForm')->middleware('auth');

Route::post('/generate2faSecret','PasswordSecurityController@generate2faSecret')->name('generate2faSecret')->middleware('auth');

Route::post('/enable2fa','PasswordSecurityController@enable2fa')->name('enable2fa')->middleware('auth');

Route::post('/disable2fa','PasswordSecurityController@disable2fa')->name('disable2fa')->middleware('auth');

Route::post('/2faVerify', function () {
    return redirect(URL()->previous());
})->name('2faVerify')->middleware('2fa');       



Route::get('/balances', 'Balances@index')->name('balances')->middleware(['auth', '2fa']);


Route::get('/getGlassOrdersSell', 'ExchangeController@getGlassOrdersSell');
Route::get('/getGlassOrdersBuy', 'ExchangeController@getGlassOrdersBuy');
Route::get('/getTradeHistory', 'ExchangeController@getTradeHistory');



/*Route::any('/getGlassOrders(:num?)', array(
    'as'   => 'getGlassOrders',
    'uses' => 'ExchangeController@getGlassOrders'
));
*/

//Route::get('/getGlassOrders?currencyFrom={currencyFromId}&currencyTo={currencyToId}', 'ExchangeController@getGlassOrders');

//Route::get('getGlassOrders', ['as' => 'getGlassOrders', 'uses' => 'ExchangeController@getGlassOrders']);


Route::post('{currency_from}/{currency_to}/exchangeBuy', function($currency_from, $currency_to, Request $request){

    $currency_from_id=App\ce_currency_ref::where([
        ['currency','=', $currency_from],
    ])->value('id');

    $currency_to_id=App\ce_currency_ref::where([
        ['currency','=', $currency_to],
    ])->value('id');

    $wallet_id=App\Wallet::where([
        ['user_id', '=', Auth::id()],
        ['currency', '=', $currency_from_id],
    ])->value('id');
    $wallet = $wallet_id;
    $trade_type = 2;    
    $price = $request->priceBuy;
    $amount = $request->amountBuy;
    $users = DB::select('select core_start_point (?, ?, ?, ?, ?, ?)', [$trade_type, Auth::id(), $currency_from_id, $currency_to_id, $price,  $amount]);
return redirect('/exchange/'.$currency_from.'/'.$currency_to);

});


Route::post('{currency_from}/{currency_to}/exchangeSell', function($currency_from, $currency_to, Request $request){
    $currency_from_id=App\ce_currency_ref::where([
        ['currency','=', $currency_from],
    ])->value('id');

    $currency_to_id=App\ce_currency_ref::where([
        ['currency','=', $currency_to],
    ])->value('id');
    
    $wallet_id=App\Wallet::where([
        ['user_id', '=', Auth::id()],
        ['currency', '=', $currency_from_id],
    ])->value('id');
    
    $wallet = $wallet_id;
    $trade_type = 1;
    $price = $request->priceSell;
    $amount = $request->amountSell;
    $users = DB::select('select core_start_point (?, ?, ?, ?, ?, ?)', [$trade_type, Auth::id(), $currency_from_id, $currency_to_id, $price,  $amount]);
    return redirect('/exchange/'.$currency_from.'/'.$currency_to);

});


Route::post('/exchange/{currency_from}/{currency_to}/delete/{orderId}', function($currency_from, $currency_to, \App\Exchange_glass $orderId){
    $orderId->status=2;
    $orderId->save();   
    return redirect('/exchange/'.$currency_from.'/'.$currency_to);
});



//Route::get('exchange/{pair}', 'ExchangeController@index')->name('exchange');

Route::get('exchange/{currency1}/{currency2}', 'ExchangeController@index')->name('exchange');

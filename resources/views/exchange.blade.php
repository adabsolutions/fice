@extends('layout')






@section('content')

<?php


foreach($cecurrencies as $cecurrency){
    if($cecurrency->currency==$currency1_POST){
        $currency1_POST_id=$cecurrency->id;
    }
    if($cecurrency->currency==$currency2_POST){
        $currency2_POST_id=$cecurrency->id;
    }
}



?>


<div id="exchangeTemplate">
    <div class="container">

        <div class="row">
            <div class="col-md-2">
                   @if (Auth::check())
                <!--//////////////////WalletWidget///////////////////////////////////////-->
                <div class="vh-2 widgets" id="wallet">
                  
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-auto">
                            <h4>Wallets</h4>
                        </div>
                        <!-- /.col-md-8 -->
                        <div class="col-md-auto">
                            <span class="walletSum"><b>USD</b> 250</span>
                            <span class="walletSum"><b>BTC</b> 0.0256892</span>
                        </div>
                        <!-- /.col-md-2 -->
                        <div class="col-md-auto">
                            <a href="/balances"><i class="fas fa-wallet"></i></a>
                        </div>
                        <!-- /.col-md-2 -->

                    </div>
                    <!-- /.row -->

                    <table class="table">
                        <thead>
                        <tr>

                            <th scope="col">Currency</th>
                            <th scope="col">Total</th>
                            <th scope="col">Blocked</th>

                        </tr>
                        </thead>
                        
                        <tbody class="tableItems">

                        @foreach($wallets as $wallet)
                           
                                <tr class="tableItems">
                                    
                                    <td>{{$wallet->currency}}</td>
                                    <td>{{$wallet->balance}}</td>
                                    <td>{{$wallet->block_balance}}</td>

                                </tr>
                         
                        @endforeach

                        </tbody>
                        
                    </table>
                    <!--Market -->
                   
                </div>
                
                <!--/WalletWidget-->
                <!-- /.vh-2 -->
<!--//////////////////MarketWidget///////////////////////////////////////-->
                
                <div class="vh-2 widgets" id="market">
                     @else
                  <div class="vh-1 widgets" id="market">    
                     @endif

                     <div class="row justify-content-between align-items-center">
                        <div class="col-md-auto">
                            <h4>Market</h4>
                        </div>
                        <!-- /.col-md-auto -->
                        <div class="col-md-auto">
                            <input type="search" class="inputSearch" placeholder="Search...">
                        </div>
                        <!-- /.col-md-auto -->

                    </div>
                    <!-- /.row -->
   
                    <table class="table">
                        <thead>
                        <tr>

                            <th scope="col">Pair</th>
                            <th scope="col">Price</th>
                            <th scope="col">%</th>
                            <th scope="col">Amount</th>

                        </tr>
                        </thead>
                       
                        <tbody class="scrollTable">
                        @foreach($pr_markets as $pr_market)
                             <?php foreach($cecurrencies as $cecurrencie)
                                {if($cecurrencie->id==$pr_market->currency_left) {

                                $currency1=$cecurrencie->currency;
                            }
                                
                                }
                                foreach($cecurrencies as $cecurrencie){
                                if($cecurrencie->id==$pr_market->currency_right)  {
                               
                                $currency2=$cecurrencie->currency;
                            }
                            }
                                
                                ?>
                                
                         
                                <tr class="tableItems" onclick="javascript:document.location.href='/exchange/{{$currency1}}/{{$currency2}}'">

                               
                                @foreach($cecurrencies as $cecurrencie)
                                @if($cecurrencie->id==$pr_market->currency_left)  

                                <td>{{$cecurrencie->currency}}/
                                @endif
                                @endforeach                     
                                @foreach($cecurrencies as $cecurrencie)
                                @if($cecurrencie->id==$pr_market->currency_right)  
                               
                                {{$cecurrencie->currency}}</td>
                                @endif
                                @endforeach

                               <td>{{round($pr_market->price, 6)}}</td>
                               <td>{{round($pr_market->change, 2)}}</td>
                               <td>{{round($pr_market->volume, 6)}}</td>
                    


                                </tr>
   
                        @endforeach


                        </tbody>
                      
                    </table>


                
                </div>
                <!-- /.vh-2 -->
        </div>
            <!-- /.col-sm-2 -->
            
            <div class="col-md-8">
                
                <div class="vh-3 widgets" id="graphic">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                    <div id="tradingview_6d21f"></div>

                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript" scr="/js/jquery-3.3.1.min.js">
                        

                        new TradingView.widget(
                            {
                                "width": (window.innerWidth/12*8)-20,
                                "height": (window.innerHeight-80)/3,
                                "symbol": '{{$currency1_POST}}{{$currency2_POST}}',
                                "interval": "D",
                                "timezone": "Etc/UTC",
                                "theme": "Dark",
                                "style": "2",
                                "locale": "en",
                                "toolbar_bg": "rgba(255,255,255, 0.2)",// "#f1f3f6",
                                "enable_publishing": false,
                                "allow_symbol_change": true,
                               
                            }
                        );
                    </script>




                </div>
                <!-- TradingView Widget END -->
                </div>
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="vh-3 ">
                            <div class="widgets">
                            <div class="row">
                           <div class="col-md-6 ">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-auto"><h4>Buy {{$currency1_POST}}</h4></div>
                                    <!-- /.col-md-auto-->
                                    <div class="col-md-auto"><i class="fas fa-wallet"></i> 
                                        
                                            @foreach($wallets as $wallet)
                                                @if($wallet->currency == $currency2_POST)
                                                 {{$wallet->balance}}
                                                
                                                @endif
                                            @endforeach
                                            
                                          {{$currency2_POST}}
                                         </div>
                                    <!-- /.col-md-auto -->
                                </div>
                                <!-- /.row -->

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <form action="{{secure_url($currency1_POST.'/'.$currency2_POST.'/exchangeBuy')}}" method="POST" id="formBuyExchange">
                                            {{ csrf_field() }}
                                           
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Amount</span>
                                                </div>
                                                <input required type="number" step="0.000001" min="0.000001" class="form-control" name="amountBuy" id="amountBuy" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                                <span class="currency_input">{{$currency1_POST}}</span>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Price</span>
                                                </div>
                                                <input required type="number" step="0.000001" min="0.000001" class="form-control" name="priceBuy" id="priceBuy" placeholder="" aria-label="Username" aria-describedby="basic-addon1" >
                                                <span class="currency_input">{{$currency2_POST}}</span>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Total</span>
                                                </div>
                                                <input required type="number" step="0.000001" min="0.000001" class="form-control" name="totalBuy" id="totalBuy" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                                <span class="currency_input">{{$currency2_POST}}</span>
                                            </div>
                                            <input type="hidden" name="currencyFrom" id="currencyFrom" value="{{$currency1_POST}}">
                                            <input type="hidden" name="currencyTo" id="currencyTo" value="{{$currency2_POST}}">
                                            <input type="hidden" name="currencyFromId" id="currencyFromId" value="{{$currency1_POST_id}}">
                                            <input type="hidden" name="currencyToId" id="currencyToId" value="{{$currency2_POST_id}}">
                                            <button class="btn buttonGreen mx-auto d-flex" type="submit" id="buttonBuyExchange">BUY {{$currency1_POST}}</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6 ">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-auto"><h4>Sell {{$currency1_POST}}</h4></div>
                                    <!-- /.col-md-auto-->
                                    <div class="col-md-auto"><i class="fas fa-wallet"></i> 

                                     @foreach($wallets as $wallet)
                                                @if($wallet->currency == $currency1_POST)
                                                 {{$wallet->balance}}
                                                
                                                @endif
                                            @endforeach

                                    {{$currency1_POST}}</div>
                                    <!-- /.col-md-auto -->
                                </div>
                                <!-- /.row -->
                                

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <form action="{{secure_url($currency1_POST.'/'.$currency2_POST.'/exchangeSell')}}" method="POST" id="formSellExchange">
                                            {{ csrf_field() }}
                                            
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Amount</span>
                                                </div>
                                                <input required type="number" step="0.000001" min="0.000001" name="amountSell" id="amountSell" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                                <span class="currency_input">{{$currency1_POST}}</span>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Price</span>
                                                </div>
                                                <input required type="number" step="0.000001" min="0.000001" name="priceSell" id="priceSell" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                                <span class="currency_input">{{$currency2_POST}}</span>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Total</span>
                                                </div>
                                                <input required type="number" step="0.000001" min="0.000001" name="totalSell" id="totalSell"  class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                                <span class="currency_input">{{$currency2_POST}}</span>
                                            </div>
                                            <input type="hidden" name="currencyFrom" id="currencyFrom" value="{{$currency1_POST}}">
                                            <input type="hidden" name="currencyTo" id="currencyTo" value="{{$currency2_POST}}">
                                            <input type="hidden" name="currencyFromId" id="currencyFromId" value="{{$currency1_POST_id}}">
                                            <input type="hidden" name="currencyToId" id="currencyToId" value="{{$currency2_POST_id}}">
                                            <button class="btn buttonRed mx-auto d-flex" type="submit" id="buttonSellExchange">SELL {{$currency1_POST}}</span></button>
                                        </form>
                                    </div>
</div>
                            <!-- /.widgets -->
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
                        </div>
                        <!-- /.row -->
                        <!-- /Orders Forms-->
                        </div>
                        <!-- /.widgets -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-12 col-lg-6">
                        <div class="widgets vh-3 ">
                            <div class="row">
                                
                            <div class="col-md-6">

                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-auto">
                                        <h4>Buy Orders</h4>
                                    </div>
                                    <!-- /.col-md-auto -->

                                </div>
                                <!-- /.row -->
                                <div class="tableGlass exchangeTableBody">
                                    <table class="table buy">
                                        <thead>
                                        <tr class="tableItems">

                                            <th scope="col">Price</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody style="">
                                        @foreach($glasses as $glass)
                                            @if($glass->trade_type==2 && $glass->currency_from==$currency1_POST_id && $glass->currency_to==$currency2_POST_id)
                                                <tr class="tableItems">

                                                    <td>{{$glass->price}} </td>
                                                    <td>{{$glass->amount}} <span class="firstCurrency">{{$currency1_POST}}</span></td>
                                                    <td>{{$glass->amount*$glass->price}} <span class="firstCurrency">{{$currency2_POST}}</span></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tableGlass -->
                                </div>
                                <!-- /.col-md-6 -->

                                <div class="col-md-6">
                                    <div class="row justify-content-between align-items-center">
                                    <div class="col-md-auto">
                                        <h4>Sell Orders</h4>
                                    </div>
                                    <!-- /.col-md-auto -->

                                </div>
                                <!-- /.row -->
                                <div class="">
                                    <table class="table sell">
                                        <thead>
                                        <tr class="tableItems">

                                            <th scope="col">Price</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($glasses as $glass)
                                            @if($glass->trade_type==1 && $glass->currency_from==$currency1_POST_id && $glass->currency_to==$currency2_POST_id)
                                                <tr class="tableItems" >

                                                    <td>{{round($glass->price, 6)}} </td>
                                                    <td>{{$glass->amount}} <span class="secondCurrency">{{$currency1_POST}}</span></td>
                                                    <td>{{$glass->amount*$glass->price}} <span class="firstCurrency">{{$currency2_POST}}</span></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tableGlass -->
                            </div>
                            <!-- /.col-md-6 -->
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.widgets -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
              <div class="vh-3 widgets">


                        <h4>Trade history</h4>
                    
                    
                
                <div class="" id="">
                    <table class="table trade_history" id="">
                        <thead>
                        <tr class="tableItems">
                            <th scope="col">Time</th>
                            <th scope="col">Pair</th>
                            <th scope="col">Type</th>
                            <th scope="col">Price</th>
                            <th scope="col">Amount</th>

                            <th scope="col">Total</th>

                        </tr>
                        </thead>

                        <tbody>


                        @foreach($trade_histories as $trade_history)
                            @if($trade_history->currency_from==$currency1_POST_id && $trade_history->currency_to==$currency2_POST_id)
                            <tr class="tableItems">

                                <td>{{$trade_history->time}}</td>
@foreach($cecurrencies as $cecurrencie)
 @if($cecurrencie->id==$trade_history->currency_from)
                                <td>{{$cecurrencie->currency}}/
                                @endif
                                @endforeach                                

                                @foreach($cecurrencies as $cecurrencie)
                                @if($cecurrencie->id==$trade_history->currency_to)
                                {{$cecurrencie->currency}}</td>
                                @endif
                                @endforeach




                                
                                @if($trade_history->type)
                                <td>BUY</td>

                                @else
                                    <td>SELL</td>
                                @endif
                                <td>{{round($trade_history->price, 8)}}</td>
                                <td>{{round($trade_history->amount, 8)}}</td>
                                <td>{{round($trade_history->total, 8)}}</td>
                            </tr>
@endif
                        @endforeach
                        </tbody>


                        </tbody>
                    </table>
                </div>
               
                
</div>
            </div>
            <!-- /.col-sm-8 -->
            <div class="col-md-2">

<div class="vh-1 widgets">
    <div class="row justify-content-between align-items-center">
                            <div class="col-md-auto">
                                <h4>My Orders</h4>
                            </div>
                            <!-- /.col-md-auto -->
                            <div class="col-md-auto">
                                <input type="checkbox" id="openedOrders" name="openedOrders"
                                       value="openedOrders" />
                                <label for="openedOrders">Opened Orders</label>
                            </div>
                            <!-- /.col-md-auto -->
                            <div class="col-md-auto">
                                <input type="search" class="inputSearch" placeholder="Search..." id="myOrdersSearch">
                            </div>
                            <!-- /.col-md-auto -->
                        </div>
                        <!-- /.row -->

                        <div id="myOrders">
                            <table class="table">
                                <thead>
                                <tr class="tableItems">
                                    <th scope="col">Status</th>
                                    <th scope="col">Pair</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Amount</th>

                                    <th scope="col">Total</th>

                                </tr>
                                </thead>

                                <tbody>


                                @foreach($orders as $order)

                                    <tr class="tableItems">
                                        

                                        @if($order->status==1)
                                            <td><span class="statusMyOrder">Open</span></td>
                                        @elseif($order->status==0)
                                            <td><span class="statusMyOrder">Close</span></td>
                                        @else
                                            <td><span class="statusMyOrder">Cancel</span></td>
                                        @endif

                                      
                                        
                                         @foreach($cecurrencies as $cecurrencie)
                                    
                                @if($cecurrencie->id==$order->currency_from)
                                <td>{{$cecurrencie->currency}}/
                                @endif
                                @endforeach                                

                                @foreach($cecurrencies as $cecurrencie)
                                @if($cecurrencie->id==$order->currency_to)
                                {{$cecurrencie->currency}}</td>
                                @endif
                                @endforeach



                                        @if($order->type)
                                            <td>BUY</td>

                                        @else
                                            <td>SELL</td>
                                        @endif
                                        <td>{{$order->price}}</td>
                                        <td>{{$order->amount}}</td>
                                        <td>{{$order->price*$order->amount}}</td>
                                        <td>
                                            <form action="{{secure_url('/exchange/'.$currency1_POST.'/'.$currency2_POST.'/delete/'.$order->id)}}" method="POST">
                                    {{csrf_field()}}
                                   <!-- {{method_field('UPDATE')}}-->
                                    @if ($order->status==1)
                                    <button class="rowDelete" type="submit"><i class="fas fa-ban"></i></button>
                                    @endif
                                    </form>
                                        </td>
                                        
                                    </tr>

                                @endforeach
                                </tbody>


                                </tbody>
                            </table>
                        </div>
</div>
<!-- /.vh-1 -->

                
            </div>
            <!-- /.col-sm-2 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
    <!-- /#exchangeTemplate -->
   @endsection

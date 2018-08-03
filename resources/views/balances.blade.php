@extends('layout')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-auto">
                <h2>Balances</h2>
            </div>
            <!-- /.col-md-auto -->
            <div class="col-md-auto">

            </div>
            <!-- /.col-md-auto -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-3"></div>
            <!-- /.col-md-3 -->
            <div class="col-md-3"></div>
            <!-- /.col-md-3 -->
            <div class="col-md-3"></div>
            <!-- /.col-md-3 -->
            <div class="col-md-3"></div>
            <!-- /.col-md-3 -->
        </div>
        <!-- /.row -->
        <table class="table sell">
            <thead>
            <tr class="tableItems">

                <th scope="col">Coin</th>
                <th scope="col">Name</th>
                <th scope="col">Total balance</th>
                <th scope="col">Available balance</th>
                <th scope="col">In order</th>
                <th scope="col">BTC Value</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>

            @foreach($wallets as $wallet)
                @if($wallet->user_id==Auth::user()->id)
                    <tr class="tableItems">
                        @foreach($cecurrencies as $cecurrencie)
                        @if($cecurrencie->id==$wallet->currency)
                        
                        <td>{{$cecurrencie->currency}}</td>
                        <td>{{$cecurrencie->fullname}}</td>
                        @endif
                        @endforeach
                        
                        <td>{{$wallet->balance}}</td>
                        <td>{{$wallet->balance-$wallet->block_balance}}</td>
                        <td></td>
                        
                            @foreach($pr_markets as $pr_market)
                                @if($pr_market->currency_left==$cecurrencie->id && $pr_market->currency_right==1)
                                    @if($pr_market->currency_left==1)
                                        <td>{{$wallet->amount}}</td>
                                    @elseif ($pr_market->price==0)
                                         <td>{{$wallet->amount/$pr_market->prev_price}}</td>
                                    @else
                                          <td>{{$wallet->amount/$pr_market->price}}</td>
                                    @endif

                                @endif
                            @endforeach

                       
                        <td>
                            <div class="row">
                                <div class="col-4">
                                    <button>Deposit</button>
                                </div>
                                <!-- /.col-4 -->
                                <div class="col-4">
                                    <button>Withdrawal</button>
                                </div>
                                <!-- /.col-4 -->
                                <div class="col-4">
                                    <button>Trade</button>
                                </div>
                                <!-- /.col-4 -->
                            </div>
                            <!-- /.row -->
                        </td>

                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.container -->
    @endsection

@section ('marketWidget')


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
                            <a href="balances"><i class="fas fa-wallet"></i></a>
                        </div>
                        <!-- /.col-md-2 -->

                    </div>
                    <!-- /.row -->

                    <table class="table">
                        <thead>
                        <tr>

                            <th scope="col">Currency</th>
                            <th scope="col">Amount</th>

                        </tr>
                        </thead>
                        <tbody class="tableItems">

                        @foreach($wallets as $wallet)
                            @if($wallet->user==Auth::user()->id)
                                <tr class="tableItems">
                                    @foreach($cecurrencies as $cecurrencie)
                                    @if($cecurrencie->id==$wallet->currency)
                                    <td>{{$cecurrencie->currency}}</td>
                                    @endif
                                    @endforeach
                                    <td>{{$wallet->amount}}</td>

                                </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                    <!--Market -->

@endsection
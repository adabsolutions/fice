@extends('layout')


@section('content')

<div class="container">

                <h2>Market</h2>
            

       
        <table class="table">
            <thead>
            <tr class="tableItems">

                <th scope="col">Pair</th>
                <th scope="col">Currency</th>
                <th scope="col">24Hr %</th>

                <th scope="col">24Hr Vol</th>

                <th scope="col">Price</th>

                <th scope="col">24Hr High</th>
                <th scope="col">24Hr Low</th>

            </tr>
            </thead>
            <tbody>
			@foreach($pr_markets as $pr_market)
                    <tr class="tableItems">
            
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
                      @foreach($cecurrencies as $cecurrencie)
                        		@if($cecurrencie->id==$pr_market->currency_left)  
                      			<td>{{$cecurrencie->fullname}}</td>
                      			@endif
                                @endforeach 
                       
                         <td></td>
                          <td></td>
                          @if($pr_market->price!=0)
                           <td>{{$pr_market->price}}</td>
                           @else
                           <td>{{$pr_market->prev_price}}</td>
                           @endif
                            <td>{{$pr_market->high}}</td>                       
                        <td>{{$pr_market->low}}</td>

                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.container -->

@endsection
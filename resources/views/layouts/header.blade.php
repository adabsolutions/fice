<header class="notMain">
    <div class="container">
        <div class="topPanel">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-auto">
                    <div class="logo">
                        <a href="/"><img src="https://mvp.adabsolutions.com/img/fice-logo.png" alt=""></a>
                    </div>
                </div>
                <!-- /.col-md-auto -->
                <div class="col-md-auto">
                    <div id="topMenu">
                        <div class="row">
                            <div class="col-md-auto"><a href="/exchange/BTC/USD">Exchange</a></div>
                            <!-- /.col-md-auto -->
                            <div class="col-md-auto"><a href="/market">Market</a></div>
                            <!-- /.col-md-auto -->
                            @if (Auth::check())
                            <div class="col-md-auto"><a href="/balances">Balances</a></div>
                            <!-- /.col-md-auto -->
                            @endif
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.col-md-auto -->
               
                <div class="col-md-auto">
                    @if (Auth::check()==0)
                        <a href="/login">Log In</a> /
                        <a href="/register">Sign up</a>
                        @else
                        <a href="/home"><i class="fas fa-user"></i> {{Auth::user()->name}}</a>
                    @endif
                </div>
                <!-- /.col-md-auto -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.topPanel -->
    </div>
    <!-- /.container -->
</header>
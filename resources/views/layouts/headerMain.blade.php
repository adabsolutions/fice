<header>
    <div class="container">
        <div class="topPanel">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-auto">
                    <div class="logo">
                        <img src="http://mvp.adabsolutions.com/img/fice-logo.png" alt="">
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
                        <a href="login">Log In</a> /
                        <a href="register">Sign up</a>
                    @else
                        <a href="home"><i class="fas fa-user"></i> {{Auth::user()->name}}</a>
                    @endif
                </div>
                <!-- /.col-md-auto -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.topPanel -->
        <div id="banner">
            <h1>First Islamic Crypto Exchange</h1>
            <div class="row justify-content-center">
                <div class="col-auto justify-content-end">
                    <button class="btn buttonLight">Open Account</button>
                </div>
                <!-- /.col-6 -->
                <div class="col-auto">
                    <button class="btn buttonDark">VIEW DEMO</button>
                </div>
                <!-- /.col-6 -->
            </div>
            <!-- /.row -->
            <div id="newsScrollPanel">
                <div class="row justify-content-between">
                    <div class="col-md-3"><img src="http://dummyimage.com/250x120/99cccc.gif&text=News+1" alt=""></div>
                    <!-- /.col-md-3 -->
                    <div class="col-md-3"><img src="http://dummyimage.com/250x120/99cccc.gif&text=News+2" alt=""></div>
                    <!-- /.col-md-3 -->
                    <div class="col-md-3"><img src="http://dummyimage.com/250x120/99cccc.gif&text=News+3" alt=""></div>
                    <!-- /.col-md-3 -->
                    <div class="col-md-3"><img src="http://dummyimage.com/250x120/99cccc.gif&text=News+4" alt=""></div>
                    <!-- /.col-md-3 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#newsScrollPanel -->
        </div>
        <!-- /#banner -->
    </div>
    <!-- /.container -->
</header>
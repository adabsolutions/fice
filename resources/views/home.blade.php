@extends('layout')




@section('content')

<!--

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! {{Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
-->

    <div class="container" id="personalAccount">
    <div class="row align-items-center justify-content-between" id="personalCabinet">
        <div class="col-md-auto items">
            <a href="exchange"><i class="fab fa-stack-exchange"></i><br>Exchange</a>
        </div>
        <!-- /.col-md-auto -->
        <div class="col-md-auto items">
            <a href="auth/logout"><i class="fas fa-sign-out-alt"></i><br>Logout</a>
        </div>
        <!-- /.col-md-auto -->
    </div>
    <!-- /.row -->

        <div class="row align-items-center justify-content-between" id="nameUserAccount">
            <div class="col-md-4">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <i class="fas fa-user" id="imgPerson"></i>
                    </div>
                    <!-- /.col-md-3 -->
                    <div class="col-md-9">

        
                        <h3>{{Auth::user()->email}}</h3>
                        @if(!Auth::user()->is_confirmed)
                        <a href="/balances">E-mail is not confirmed</a>
                        @endif
                    </div>
                    <!-- /.col-md-9 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-4 align-content-end">
                <h4>Your budget (USD)</h4>
                <a href="balances"><p><span>250 USD</span></p></a>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->

        <div class="row justify-content-between" id="personalAccountTools">
            <div class="col-md-3 personalAccountTools__items">
                <h5>SMS Authentication</h5>
                <p>Used for withdrawals and security modifications</p>
                <button class="mx-auto d-flex btnCabinet buttonLight">Enable</button>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-3 personalAccountTools__items">
                <h5>Google Authentication</h5>
                <p>Used for withdrawals and security modifications</p>
                <button class="mx-auto d-flex btnCabinet buttonLight" onclick="javascript:document.location.href='/2fa'">Enable</button>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-3 personalAccountTools__items">
                <h5>Change Your Password</h5>
                <p>For security your account</p>
                <button class="mx-auto d-flex btnCabinet buttonLight">Change</button>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-3 personalAccountTools__items">
                <h5>API</h5>
                <p>For developers</p>
                <button class="mx-auto d-flex btnCabinet buttonLight">API Settings</button>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->


        <div class="row" id="deviceSecurity">
            <div class="col-md-6">
                <h5>Device Management</h5>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Device</th>
                        <th scope="col">Location</th>
                        <th scope="col">Recent activity</th>
                        <th scope="col">IP Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td>Chrome V67.0.3396.99 (Windows)</td>
                        <td>Almaty Kazakhstan</td>
                        <td>@2018-07-20 11:44:45</td>
                        <td>178.88.48.11</td>
                    </tr>

                    </tbody>
                </table>


            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-6">
                <h5>Last login</h5>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">IP Address</th>
                        <th scope="col">Location</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td>2018-07-20 11:44:45</td>
                        <td>178.88.48.11</td>
                        <td>Almaty Kazakhstan</td>

                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->


    </div>
    <!-- /.container -->

@endsection

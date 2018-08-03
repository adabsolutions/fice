<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

  </head>
  <body>
    <h1>For Condirm your email, click link below</h1>

    <a href="{{ route ('confirm-email', [$user, $token])}}">Нажмите здесь</a>

  </body>
</html>
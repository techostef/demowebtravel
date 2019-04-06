<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('bootstrap/3.3.0/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
    <link href="{{asset('css/login.css')}}" rel="stylesheet" id="bootstrap-css">
    <title>{{config('app.name')}}</title>
    <style>
        body{
            padding:10px;
        }
    </style>
</head>
<body>
    @include('inc.message')
    <div class="row">
        <div class="container">
            <div class="loginmodal-container">
                <h1>Travel</h1><br>
                {!!Form::open(['action'=>'LoginController@auth','method'=>"POST"])!!}
                <input type="text" name="username" placeholder="Username" autocomplete="off">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="login" class="login loginmodal-submit" value="Login">
                {!!Form::close()!!}
                
              <div class="login-help">
              </div>
            </div>
        </div>
    </div>
</body>
</html>
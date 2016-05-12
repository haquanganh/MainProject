<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="UFT-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('third-library/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="login">
            <div class="login-top">
                <img src="images/enclave_logo.png">
            </div>
            <div class="login-bottom">
            <form method="POST" action="{{ url('/login')}}">
                 {!! csrf_field() !!}
                <div class="login-input">
                    <input type="email" name="Email" class="form-control" placeholder="Email" value="{{ Session::get('usersess') }}" required="">
                    <input type="password" name="Password" class="form-control" placeholder="Password" required="">
                    @if ($errors->has('Password'))
                        <div style="color: red; text-align: center; margin-top: 10px; font-size: 12px;">
                            <label><strong>{{ $errors->first('Password') }}</strong></label>
                        </div>
                    @endif
                </div>
                <div class="sub-button">
                    <input type="submit"  class="btn btn-primary btn-md" value="LOGIN">
                    <a href="/reset-request" id="forgot-pass"style="">Forgot password?</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
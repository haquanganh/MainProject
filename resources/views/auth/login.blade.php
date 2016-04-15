<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Page</title>
	<meta charset="UFT-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
		                    <div style="color: red; margin-left: 75px; margin-top: 10px; font-size: 12px;">
		                        <strong>{{ $errors->first('Password') }}</strong>
		                    </div>
		                @endif
					</div>
					<div class="sub-button">
						<input type="submit"  class="btn btn-primary btn-md" value="LOGIN">
					</div>
				</form>
				</div>
			</div>
		</div>
</body>
</html>
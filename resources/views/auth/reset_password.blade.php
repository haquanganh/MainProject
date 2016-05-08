<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<meta charset="UFT-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="{{ asset('third-library/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('third-library/font-awesome-4.6.1/css/font-awesome.min.css') }}">
	<style type="text/css">
		.container{
			margin-top: 10%;
		}
		.help-block{
			color: red;
		}
		.error{
			color: red;
			font-size: 12px;
		}
		.clear{
			clear: both;
		}
	</style>
</head>
<body>
	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password
					<a href="{{ url('/login') }}" class="pull-right">Go to login page</a>
                </div>

                <div class="panel-body">
                	@if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form id="form-reset"class="form-horizontal" role="form" method="POST" action="{{ url('/reset-password') }}/{{ $token }}/{{ $email }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" id="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i> Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	<script src="{{ asset('third-library/jquery/jquery-2.2.3.min.js') }}"></script>
	<script src="{{ asset('third-library/bootstrap/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-validate/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-validate/additional-methods.js') }}"></script>
	<script type="text/javascript">
	$('#form-reset').validate({
		rules: {
			password: {
				required: true,
				minlength: 6,
				maxlength: 16
			},
			password_confirmation: {
				equalTo: "#password"
			}
		},
		messages: {
			password: {
				required: 'Please enter your new password!',
				minlength: 'Your password must be equal or more than 6 characters!',
				maxlength: 'Your password must be between 6 and 16 characters!'
			},
			password_confirmation: {
				equalTo: 'Your new password and password confirmation must match!'
			}
		}
	});
	</script>
</body>
</html>
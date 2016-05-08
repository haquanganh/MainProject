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
		.panel-default a{
			float: right;
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
                    <a href="{{ url('/login') }}" class="pull-right">Return to login page</a>
                <div class="clear"></div>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/reset-request') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" required="" value="{{ session('old_email') }}">
                                @if (session('email'))
                                    <span class="help-block">
                                        {{ session('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 btn-gruop">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
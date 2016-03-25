<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/changepass.css') }}">

	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset('css/jquery/jquery.validate.js') }}"></script>
</head>
<body>
		@if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{Session::get('message')}}
            </div>
        @endif

	<div class="change-pass-container">
		<h1>Change password</h1>
		<form id="form-change-pass" method="POST" action="{{ url('/change-password') }}">
		{!! csrf_field() !!}
			<div class="input-text">
				<input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Old password"></input>
				@if ($errors->has('old_pass'))
		          	<div style="color: red; font-size: 12px;">
		            	<strong>{{ $errors->first('old_pass') }}</strong>
		          	</div>
		        @endif
		    </div>
		    <div class="input-text">
				<input type="password" class="form-control"  id="new_pass" name="new_pass" placeholder="New password"></input>
			</div>
			<div class="input-text">
				<input type="password" class="form-control" id="renew_pass" name="renew_pass" placeholder="Comfirm password"></input>
			</div>
			@if ($errors->has('button'))
		          	<div style="color: red; font-size: 12px; margin-left: 33px;">
		            	<strong>{{ $errors->first('button') }}</strong>
		          	</div>
		        @endif
			<div class="change-pass-button">
				<input type="submit" name="button" id="save-button" class="btn btn-primary" value="Save"></input>
			</div>

		</form>
	</div>
	<script type="text/javascript">
		$('#form-change-pass').validate({
			rules:{
				old_pass:{
					required:true,
				},
				new_pass:{
					required:true,
					minlength:6,
					maxlength:16
				},
				renew_pass:{
					equalTo:"#new_pass"
				}
			},
			messages:{
				old_pass:{
					required:"Please enter your old password!",
				},
				new_pass:{
					required:"Please enter your new password!",
					minlength:"Min length password is equal or more than 6!",
					maxlength:"Max length password is equal or less than 16! "
				},
				renew_pass:{
					equalTo:"Password comfirm is invalid!"
				}
			}
		});
	</script>
</body>
</html>

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
	<script type="text/javascript" src="{{ asset('css/jquery/additional-methods.js') }}"></script>
</head>
<body>
	<div>
        @if(Session::has('message'))            
            <a data-toggle="modal" id="modal" href='#modal-id'></a>
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                   <div class="modal-content">
                        <div class="modal-body">
                            {{Session::get('message')}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
         @endif
    </div>
	<div class="change-pass-container">
		<h1>Change password</h1>
		<form id="form-change-pass" method="POST" action="{{ url('/change-password') }}">
		{!! csrf_field() !!}
			<div class="input-text">
				<input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Old password"></input>
		    </div>
		    <div class="input-text">
				<input type="password" class="form-control"  id="new_pass" name="new_pass" placeholder="New password"></input>
			</div>
			<div class="input-text">
				<input type="password" class="form-control" id="renew_pass" name="renew_pass" placeholder="Comfirm password"></input>
			</div>
			<div class="change-pass-button">
				<input type="submit" name="button" id="save-button" class="btn btn-primary" value="Save"></input>
				<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Cancel</a>
			</div>
			<div class="modal fade" id="modal-id">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<h3>Are you kidding me?</h3>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
							<a type="button" class="btn btn-primary" href="{{ url('/') }}">Yes</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
		
	<script type="text/javascript">
		$('#form-change-pass').validate({
			rules:{
				old_pass:{
					required:true,
					remote:{
						url:"{{asset('check/check-pass')}}",
						type:"POST",
						data: {
							'_token': $('input[name=_token]').val()
	          			}
					}   
				},
				new_pass:{
					required:true,
					minlength:6,
					maxlength:16,
					notEqualTo: "#old_pass"
				},
				renew_pass:{
					equalTo:"#new_pass"
				}
			},
			messages:{
				old_pass:{
					required:"Please enter your current password!",
					remote: "Your current password is incorrect!"
				},
				new_pass:{
					required:"Please enter your new password!",
					minlength:"Min length password is equal or more than 6!",
					maxlength:"Max length password is equal or less than 16!",
					notEqualTo: "New password and current password must not match!"
				},
				renew_pass:{
					equalTo:"New password and password comfirm must match!"
				}
			}
		});
	</script>
</body>
</html>

@extends('layout.admin')
@section('title','Register')
@section('name','Register')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/register.css') }}">
@stop
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/register') }}" enctype="multipart/form-data" Files="true">
{!! csrf_field() !!}
@if(count($errors) >0)
<ul>
	@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	@endforeach

</ul>
@endif
<div class="col-md-7 right-regis">
			<div class="row form-group {{ $errors->has('in_Email') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Email
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Email" type="email" class="form-control" value="{{old('in_Email')}}">
				</div>
				@if ($errors->has('in_Email'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Email') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Password') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Password
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Password" type="password" class="form-control" value="{{old('in_Password')}}">
				</div>
				@if ($errors->has('in_Password'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Password') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Repassword') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Re-password
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Repassword" type="password" class="form-control" value="{{old('in_Repassword')}}">
				</div>
				@if ($errors->has('in_Repassword'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Repassword') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_id') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">ID of Employee
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_id" type="text" class="form-control" value="{{old('in_id')}}">
				</div>
				@if ($errors->has('in_id'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_id') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_EName') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">English Name
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_EName" type="text" class="form-control" value="{{old('in_EName')}}">
				</div>
				@if ($errors->has('in_EName'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_EName') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Name') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Full Name
						<span type="text" class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Name" class="form-control" value="{{old('in_EName')}}">
				</div>
				@if ($errors->has('in_Name'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Name') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Dateofbirth') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Date of Birth
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Dateofbirth" type="date" class="form-control" value="{{old('in_Dateofbirth')}}">
				</div>
				@if ($errors->has('in_Dateofbirth'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Dateofbirth') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Address') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Address
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Address" type="text" class="form-control" value="{{old('in_Address')}}">
				</div>
				@if ($errors->has('in_Address'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Address') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Phone') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Phone Number
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Phone" onkeypress="validate(event)" type="text" class="form-control" value="{{old('in_Phone')}}">
				</div>
				@if ($errors->has('in_Phone'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Phone') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Skype') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Skype Address
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Skype" type="text" class="form-control" value="{{old('in_Skype')}}">
				</div>
				@if ($errors->has('in_Skype'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Skype') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Email') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Role
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<select name="sl_Role" class="form-control">
						<option>Administrator</option>
						<option>Manager</option>
						<option>Leader</option>
						<option>Member</option>
						<option>Client</option>
					</select>
				</div>
				@if ($errors->has('in_Email'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Email') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Email') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Cost/Hour
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_CostHour" onkeypress="validate(event)" type="number" type="text" class="form-control" min="0" value="{{old('in_CostHour')}}">
				</div>
				@if ($errors->has('in_Email'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Email') }}</strong>
                    </div>
                @endif
			</div>
		</div><!--col-md-7-->

		<div class="col-md-5 left-regis">
			<div class="avatar-img">
				<img src="{{ asset('images/user.JPG') }}" style="margin:0px;">
				<div class="box">
	                <input type="file" name="in_img" id="img" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" value="{{old('in_img')}}" />
	                <label for="img" class="label_img">
	                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
	                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
	                </svg> <span>Choose a file&hellip;</span></label>
                </div>
			</div>
			<div style="margin-top: 10px;margin-left: 5px;"><a onclick="myFunction()" class="glyphicon glyphicon-plus has-error"></a>
			<?php $count = $num_skill = App\Skill::all()->count();?>
			@for ($i = 0 ; $i < $count  ; $i++)
				@if($errors->has('in_Year.'.$i))
					<strong style="margin-left:60px; color:#AF4442;">{{ $errors->first('in_Year.'.$i) }}</strong>
				@break
				@endif
			@endfor
			</div>
			<div id="skill_list">
				<table class="table" id="table" style="width: 100%; height: 100%;" >
				<thead>
					<tr>
						<td class="text-center"><b>Year</b></td>
						<td class="text-center"><b>Skill</b></td>
					</tr>
				</thead>
				<tbody class="content-skill text-center">
				</tbody>
				</table>
			</div>
		</div><!--col-md-5-->
		<div class="clear"></div>
		<div class="regis-button">
			<input type="submit" class="btn btn-primary" value="Create">
			<input type="button" class="btn btn-primary" value="Cancel">
		</div>
		</form>
@stop
@section('script')
<script src="{{ asset('js/custom-file-input.js') }}"></script>
<script>
function myFunction() {
	var table = document.getElementById("table");
    var content = document.getElementById("table").getElementsByTagName('tbody')[0];
    var row = content.insertRow(0);
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	var t = table.rows.length;
	var name_old = 'in_Year['+(t-2)+']';
	var old =  'old('+name_old+')';
	console.log(old);
    cell1.innerHTML = '<input type="number" onkeypress="validate(event)" min="1" max="100" name="in_Year['+(t-2)+']"></input>';

    var text = '<select name="sl_Skill'+(t-2)+'">';
    @foreach ($list_skill as $skill)
    	text = text+ '<option>{{$skill->Skill}}</option>';
    @endforeach
    var text1 = text+ '</select>';

	cell2.innerHTML= text1;

}
function validate(evt){
	var theEvent = evt || window.event;
  	var key = theEvent.keyCode || theEvent.which;
  	key = String.fromCharCode( key );
  	var regex = /[0-9]|\./;
  	if( !regex.test(key) ) {
	    theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
  	}
}
</script>
@stop
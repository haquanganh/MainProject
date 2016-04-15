@extends('layout.admin')
@section('title','Register')
@section('name','Register')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/register.css') }}">
@stop
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/register') }}" enctype="multipart/form-data" Files="true">
{!! csrf_field() !!}
<div class="col-md-7 right-regis">
	<div class="row form-group {{ $errors->has('in_Email') ? ' has-error' : '' }}">
		<div class="col-md-4">
			<label class="pull-right">Email
				<span class="pull-right">*</span>
			</label>
		</div>
		<div class="col-md-8">
			<input name="in_Email" type="email" onkeypress="validate_spec3(event)" class="form-control" value="{{old('in_Email')}}">
		</div>
		@if ($errors->has('in_Email'))
            <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                <strong>{{ $errors->first('in_Email') }}</strong>
            </div>
        @endif
        @if ($errors->has('wrong_email'))
            <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                <strong>{{ $errors->first('wrong_email') }}</strong>
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
		<div class="row form-group {{ $errors->has('in_Repassword') ? 'has-error' : $errors->has('password_not_match') ? 'has-error' : ''}}">
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
            @if ($errors->has('password_not_match'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('password_not_match') }}</strong>
                </div>
            @endif
		</div>
		<div id="idEmployee" class="row form-group {{ $errors->has('in_id') ? ' has-error' : '' }}">
			<div class="col-md-4">
				<label class="pull-right">ID of Employee
					<span class="pull-right">*</span>
				</label>
			</div>
			<div class="col-md-8">
				<input name="in_id" type="number" class="form-control" value="{{old('in_id')}}">
			</div>
			@if ($errors->has('in_id'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('in_id') }}</strong>
                </div>
            @endif
		</div>
		<div id="EnglishName" class="row form-group {{ $errors->has('in_EName') ? ' has-error' : '' }}">
			<div class="col-md-4">
				<label class="pull-right">English Name
					<span class="pull-right">*</span>
				</label>
			</div>
			<div class="col-md-8">
				<input name="in_EName" type="text" class="form-control" onkeypress="validate_spec5(event)" value="{{old('in_EName')}}">
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
				<input name="in_Name" class="form-control" onkeypress="validate_spec4(event)" value="{{old('in_Name')}}">
			</div>
			@if ($errors->has('in_Name'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('in_Name') }}</strong>
                </div>
            @endif
		</div>
		<div id="Sex" class="row form-group">
			<div class="col-md-4">
				<label class="pull-right">Sex
					<span type="text" class="pull-right">*</span>
				</label>
			</div>
			<div class="col-md-8">
				<select name="sl_Sex" class="form-control">
					<option>Male</option>
					<option>Female</option>
				</select>
			</div>
		</div>
		<div id="dateofbirth" class="row form-group {{ $errors->has('in_Dateofbirth') ? ' has-error' : '' }}">
			<div class="col-md-4">
				<label class="pull-right">Date of Birth
				</label>
			</div>
			<div class="col-md-8">
				<input name="in_Dateofbirth" type="date" max="2100-12-31" min="1930-01-01" class="form-control" value="{{old('in_Dateofbirth')}}">
			</div>
			@if ($errors->has('in_Dateofbirth'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('in_Dateofbirth') }}</strong>
                </div>
            @endif
            @if ($errors->has('wrong_year'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('wrong_year') }}</strong>
                </div>
            @endif
		</div>
		<div class="row form-group {{ $errors->has('in_Address') ? ' has-error' :$errors->has('wrong_address') ? 'has-error': '' }}">
			<div class="col-md-4">
				<label class="pull-right">Address
				</label>
			</div>
			<div class="col-md-8">
				<input name="in_Address" type="text" class="form-control" onkeypress="validate_spec1(event)" value="{{old('in_Address')}}">
			</div>
			@if ($errors->has('in_Address'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('in_Address') }}</strong>
                </div>
            @endif
            @if ($errors->has('wrong_address'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('wrong_address') }}</strong>
                </div>
            @endif
		</div>
		<div class="row form-group {{ $errors->has('in_Phone') ? ' has-error' : $errors->has('wrong_phone') ? 'has-error' : '' }}">
			<div class="col-md-4">
				<label class="pull-right">Phone Number
					<span class="pull-right">*</span>
				</label>
			</div>
			<div class="col-md-8">
				<input name="in_Phone" onkeypress="validate(event)" type="text" class="form-control" onkeypress="validate(event)" value="{{old('in_Phone')[0] == '0' ? old('in_Phone') : '0'.old('in_Phone') }}">
			</div>
			@if ($errors->has('in_Phone'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('in_Phone') }}</strong>
                </div>
            @endif
            @if ($errors->has('wrong_phone'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('wrong_phone') }}</strong>
                </div>
            @endif
		</div>
		<div class="row form-group {{ $errors->has('in_Skype') || $errors->has('wrong_skype') ? ' has-error' : '' }}">
			<div class="col-md-4">
				<label class="pull-right">Skype Address
					<span class="pull-right">*</span>
				</label>
			</div>
			<div class="col-md-8">
				<input name="in_Skype" type="text" class="form-control" onkeypress="validate_spec(event)" value="{{old('in_Skype')}}">
			</div>
			@if ($errors->has('in_Skype'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('in_Skype') }}</strong>
                </div>
            @endif
            @if ($errors->has('wrong_skype'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('wrong_skype') }}</strong>
                </div>
            @endif
		</div>
		<div class="row form-group {{ $errors->has('sl_Role') ? ' has-error' : '' }}">
			<div class="col-md-4">
				<label class="pull-right">Role
					<span class="pull-right">*</span>
				</label>
			</div>
			<div class="col-md-8">
					<select id="typeaccount" name="sl_Role" class="form-control" >
						<option value="Manager" {{old('sl_Role') == 'Manager' ? 'selected' :''}}>Manager</option>
						<option value="Leader" {{old('sl_Role') == 'Leader' ? 'selected' :''}}>Leader</option>
						<option value="Member" {{old('sl_Role') == 'Member' ? 'selected' :''}}>Member</option>
						<option value="Client" {{old('sl_Role') == 'Client' ? 'selected' :''}}>Client</option>
					</select>
			</div>
			@if ($errors->has('sl_Role'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('sl_Role') }}</strong>
                </div>
            @endif
		</div>
		<div id="costhour" class="row form-group {{ $errors->has('in_CostHour') ? ' has-error' : '' }}">
			<div class="col-md-4">
				<label class="pull-right">Cost/Hour
					<span class="pull-right">*</span>
				</label>
			</div>
			<div class="col-md-8">
				<input id="CostHour" name="in_CostHour" onkeypress="validate_spec0(event)" type="number" type="text" class="form-control" min="1" max="500" step="any" value="{{old('in_CostHour')}}">
			</div>
			@if ($errors->has('in_CostHour'))
                <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                    <strong>{{ $errors->first('in_CostHour') }}</strong>
                </div>
            @endif
		</div>
		<div class="row form-group pull-right">
			<div class="col-md-12">
				<input type="submit" id="submit" class="btn btn-primary" value="Create" >
				<a class="btn btn-default" data-toggle="modal" href='#modal-id'>Cancel</a>
			</div>
			 <div class="modal fade" id="modal-id">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                               <h4><i>Do you really want to cancel?</i></h4>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-primary" href="{{route('admin.personal-information.index')}}" style="margin-left: 5px">Yes</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
              </div>
		</div>
	</div><!--col-md-7-->

	<div class="col-md-5 left-regis">
		<div class="avatar-img">
			<img src="{{ asset('images/upload.png') }}" style="margin:0px;">
			@if($errors->has('in_img'))
                    <span style="color: #AF4442"><strong>{{ $errors->first('in_img') }}</strong></span>
			@endif
			<div class="box">
                <input type="file" name="in_img" id="img" class="inputfile inputfile-2" data-multiple-caption="{count} files selected"  />
                <label for="img" class="label_img">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                </svg> <span>Choose a file&hellip;</span></label>
            </div>
		</div>
		<div id="addskill" style="margin-top: 10px;margin-left: 5px;"><a onclick="myFunction()" class="glyphicon glyphicon-plus has-error"></a>
		<?php $count = $num_skill = App\Skill::all()->count();?>
		@for ($i = 0 ; $i < $count  ; $i++)
			@if($errors->has('in_Year.'.$i))
				<strong style="margin-left:60px; color:#AF4442;">{{ $errors->first('in_Year.'.$i) }}</strong>
			@break
			@endif
		@endfor
			@if($errors->has('duplicated'))
				<strong style="margin-left:60px; color:#AF4442;">{{ $errors->first('duplicated') }}</strong>
			@endif
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
		<input type="hidden" id="number_rows" name="number_rows" value="document.getElementById("table").rows.length" />
	</div><!--col-md-5-->
	</form>
@stop
@section('script')
<script src="{{ asset('js/custom-file-input.js') }}"></script>
<script type="text/javascript">
	$('#submit').click(function(){
		var num_rows  = $('table#table tr').length -1;
		$('#number_rows').val(num_rows);
	});
</script>
<script>
function myFunction() {
	var table = document.getElementById("table");
	var thead = document.getElementById("table").getElementsByTagName('thead')[0];
	var t_row = thead.rows[0];
	if(t_row.cells.length == 2){
		var n_cell = t_row.insertCell(2);
		n_cell.innerHTML = '<b></b>';
	}
    var content = document.getElementById("table").getElementsByTagName('tbody')[0];
    var row = content.insertRow(0);
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
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
	cell3.innerHTML = '<a class="aDel">Remove</a>';

}
$('#table').on('click','.aDel',function(){
	$(this).closest('tr').remove();
});
function validate_spec0(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9.]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }

}
function validate(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }

}
function validate_spec(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[a-zA-Z0-9_.]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }

}
function validate_spec1(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[a-zA-Z0-9/, ]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }

}
function validate_spec2(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[a-zA-Z0-9 ]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }

}
function validate_spec3(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[a-zA-Z0-9.@]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }

}
function validate_spec4(evt){
	var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[a-zA-Z ]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
function validate_spec5(evt){
	var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[a-zA-Z]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		if($('#typeaccount').val() == "Client"){
			$('#skill_list').hide();
			$('#addskill').hide();
			$('#costhour').hide();
			$('.left-regis').hide();
			$('#EnglishName').hide();
			$('#idEmployee').hide();
			$('#dateofbirth').hide();
			$('#Sex').hide();
		}
		else{
			$('#skill_list').show();
			$('#addskill').show();
			$('#costhour').show();
			$('.left-regis').show();
			$('#EnglishName').show();
			$('#idEmployee').show();
			$('#dateofbirth').show();
			$('#Sex').show();
		}
	});
	$('#typeaccount').change(function(){
		if($('#typeaccount').val() == "Client"){
			$('#skill_list').hide();
			$('#addskill').hide();
			$('#costhour').hide();
			$('.left-regis').hide();
			$('#EnglishName').hide();
			$('#idEmployee').hide();
			$('#dateofbirth').hide();
			$('#Sex').hide();
		}
		else{
			$('#skill_list').show();
			$('#addskill').show();
			$('#costhour').show();
			$('.left-regis').show();
			$('#EnglishName').show();
			$('#idEmployee').show();
			$('#dateofbirth').show();
			$('#Sex').show();
		}
	});

</script>
@stop
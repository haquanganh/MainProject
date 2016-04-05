@extends('layout.admin')
@section('title','Edit Personal')
@section('name','Edit Personal')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/edit_personal.css') }}">
@stop
@section('content')
{!!Form::open(array('route'=>array('admin.personal-information.update',$employee['idEmployee']),'method'=>'PUT','enctype'=> 'multipart/form-data'))!!}
{!! csrf_field() !!}
<div class="col-md-7 right-regis">
			<div class="row form-group {{ $errors->has('in_EName') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">English Name
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_EName" type="text" onkeypress="validate_spec3(event)" class="form-control" value="{{isset($employee->E_EngName) && $errors->has('in_EName') == false && old('E_EngName') == '' ? $employee->E_EngName : old('E_EngName')}}">
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
					<input name="in_Name" onkeypress="validate_spec4(event)" class="form-control" value="{{isset($employee->E_Name) && $errors->has('in_Name') == false && old('in_Name') == '' ? $employee->E_Name : old('in_Name')}}">
				</div>
				@if ($errors->has('in_Name'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_Name') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_Dateofbirth') ? ' has-error' : $errors->has('wrong_year') ? 'has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Date of Birth
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Dateofbirth" type="date" max="2100-12-31" min="1930-01-01" class="form-control" value="{{isset($employee->E_DateofBirth) && $errors->has('in_Dateofbirth') == false && $errors->has('wrong_year') == false && old('in_Dateofbirth') == '' ? $employee->E_DateofBirth : old('in_Dateofbirth')}}">
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
			<div class="row form-group {{ $errors->has('in_Address')  ? ' has-error' : $errors->has('wrong_address') ? 'has-error': ''  }}">
				<div class="col-md-4">
					<label class="pull-right">Address
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Address" onkeypress="validate_spec5(event)" type="text" class="form-control" value="{{isset($employee->E_Address) && $errors->has('in_Address') == false && $errors->has('wrong_address') == false && old('in_Address') == '' ? $employee->E_Address : old('in_Address')}}">
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
					<input name="in_Phone" onkeypress="validate(event)" type="text" class="form-control" value="{{isset($employee->E_Phone) && $errors->has('in_Phone') == false && $errors->has('wrong_phone') == false && old('in_Phone') == '' ? '0'.$employee->E_Phone : old('in_Phone')}}">
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
			<div class="row form-group {{ $errors->has('in_Skype') ||$errors->has('wrong_skype') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Skype Address
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_Skype" onkeypress="validate_spec(event)"  maxlength="32" type="text" class="form-control" value="{{isset($employee->E_Skype) && $errors->has('in_Skype') == false && $errors->has('wrong_skype') == false && old('in_Skype') == '' ? $employee->E_Skype : old('in_Skype')}}">
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
				<?php
			        $id_Role = App\User::find($employee->idAccount)->idRole;
			        $role_name = App\Role::find($id_Role)->Role;
				?>
				<div class="col-md-8">
					<select name="sl_Role" class="form-control">
						<option {{$role_name == 'Manager' ? 'selected' : null}}>Manager</option>
						<option {{$role_name == 'Leader' ? 'selected' : null}}>Leader</option>
						<option {{$role_name == 'Member' ? 'selected' : null}}>Member</option>
						<option {{$role_name == 'Client' ? 'selected' : null}}>Client</option>
					</select>
				</div>
				@if ($errors->has('sl_Role'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('sl_Role') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group {{ $errors->has('in_CostHour') ? ' has-error' : '' }}">
				<div class="col-md-4">
					<label class="pull-right">Cost/Hour
						<span class="pull-right">*</span>
					</label>
				</div>
				<div class="col-md-8">
					<input name="in_CostHour" onkeypress="validate_spec0(event)" type="number" type="text" class="form-control" min="1" max="500" step="any" value="{{isset($employee->E_Cost_Hour) && $errors->has('in_CostHour') == false && old('in_CostHour') == '' ? $employee->E_Cost_Hour : old('in_CostHour')}}">
				</div>
				@if ($errors->has('in_CostHour'))
                    <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                        <strong>{{ $errors->first('in_CostHour') }}</strong>
                    </div>
                @endif
			</div>
			<div class="row form-group pull-right">
				<div class="col-md-12">
					<a type="submit" data-toggle="modal" href='#modal-id-1' id="submit" class="btn btn-primary">Update</a>
					<a type="button" data-toggle="modal" href='#modal-id-2' class="btn btn-default" style="margin-left: 5px">Cancel</a>
				</div>
				<div class="modal fade" id="modal-id-1">
                     <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                            	<h4><i>Do you really want to update?</i></h4>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Yes">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="modal fade" id="modal-id-2">
                     <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                            	<h4><i>Do you really want to cancel?</i></h4>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-primary" href="{{ route('admin.personal-information.index') }}">Yes</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div><!--col-md-7-->

		<div class="col-md-5 left-regis">
			<div class="avatar-img">
				<img src="{{($employee->E_Avatar != NULL && File::exists(public_path('images/personal_images/'.$employee->E_Avatar)) ) ? asset('images/personal_images/'.$employee->E_Avatar): asset('images/notfound.jpg')}}" style="margin:0px;">
				@if($errors->has('in_img'))
                        <span style="color: #AF4442"><strong>{{ $errors->first('in_img') }}</strong></span>
				@endif
				<div class="box">
	                <input type="file" name="in_img" id="img" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" />
	                <label for="img" class="label_img">
	                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
	                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
	                </svg> <span>Choose a file&hellip;</span></label>
                </div>
			</div>
			<div style="margin-top: 10px;margin-left: 5px;"><a onclick="myFunction()" ><i class="glyphicon glyphicon-plus has-error" style="font-size: 15px;border: 1px solid #ccc;margin-bottom: 10px"></i></a>
			<?php $count = $num_skill = App\Skill::all()->count();?>
			@for ($i = 0 ; $i < $count  ; $i++)
				@if($errors->has('in_Year.'.$i))
					<strong style="margin-left:120px; color:#AF4442;">{{ $errors->first('in_Year.'.$i) }}</strong>
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
						<td><b>Year</b></td>
						<td><b>Skill</b></td>
						<td><b>Remove</b></td>
					</tr>
				</thead>
				<?php $list_all_skill = App\Skill::all()
				?>
				<tbody class="content-skill text-center">
					@foreach ($employee->Skill()->get() as $k=>$e)
						<tr>
							<td><input type="text" onkeypress="validate(event)" name="in_Year[{{$k}}]" value="{{$e->pivot->S_Rate}}"></td>
							<td><select name="sl_Skill{{$k}}">
							@foreach ($list_all_skill as $key=>$l)
								<option  {{$l->Skill == $e->Skill ? 'selected' : null}}>{{$l->Skill}}</option>
							@endforeach
							</select></td>
							<td><a class="aDel">Remove</a></td>
						</tr>
					@endforeach
				</tbody>
				</table>
			</div>
			<input type="hidden" id="number_rows" name="number_rows" value="document.getElementById("table").rows.length" />
		</div><!--col-md-5-->
		{!! Form::close()!!}
@stop
@section('script')

<script type="text/javascript">
	$('#submit').click(function(){
		var num_rows  = $('table#table tr').length -1;
		$('#number_rows').val(num_rows);
	});
</script>
<script src="{{ asset('js/custom-file-input.js') }}"></script>
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
    cell1.innerHTML = '<input type="number" onkeypress="validate(event)" min="1" max="100" name="in_Year['+(t-2)+']"></input>';

    var text = '<select name="sl_Skill'+(t-2)+'">';
    <?php $list_skill = App\Skill::all();?>
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
    var regex = /[a-zA-Z0-9/ ]/;
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
    var regex = /[a-zA-Z]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
function validate_spec4(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[a-zA-Z()). ]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
function validate_spec5(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[a-zA-Z0-9/, ]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }

}
</script>
@stop
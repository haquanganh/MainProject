@extends('layout.admin')
@section('title','Edit Client')
@section('name','Edit Client')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/edit_personal.css') }}">
@stop
@section('content')
<form method="POST" action="{{ url('admin/personal-information/client/edit') }}/{{ $client->idClient }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="col-md-7 right-regis">
		<div class="row form-group {{ $errors->has('in_Name') ? ' has-error' : '' }}">
			<div class="col-md-4">
				<label class="pull-right">Client Name
					<span type="text" class="pull-right">*</span>
				</label>
			</div>
			<div class="col-md-8">
				<input name="in_Name" onkeypress="validate_spec4(event)" class="form-control" value="{{isset($client->ClientName) && $errors->has('in_Name') == false && old('in_Name') == '' ? $client->ClientName : old('in_Name')}}">
			</div>
			@if ($errors->has('in_Name'))
	            <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
	                <strong>{{ $errors->first('in_Name') }}</strong>
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
				<input name="in_Phone" onkeypress="validate(event)" type="text" class="form-control" value="{{isset($client->C_Phone) && $errors->has('in_Phone') == false && $errors->has('wrong_phone') == false && old('in_Phone') == '' ? '0'.$client->C_Phone : old('in_Phone')}}">
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
				<input name="in_Skype" onkeypress="validate_spec(event)"  maxlength="32" type="text" class="form-control" value="{{isset($client->C_Skype) && $errors->has('in_Skype') == false && $errors->has('wrong_skype') == false && old('in_Skype') == '' ? $client->C_Skype : old('in_Skype')}}">
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
		<div class="row form-group {{ $errors->has('in_Address')  ? ' has-error' : $errors->has('wrong_address') ? 'has-error': ''  }}">
			<div class="col-md-4">
				<label class="pull-right">Address
				</label>
			</div>
			<div class="col-md-8">
				<input name="in_Address" onkeypress="validate_spec5(event)" type="text" class="form-control" value="{{isset($client->C_Address) && $errors->has('in_Address') == false && $errors->has('wrong_address') == false && old('in_Address') == '' ? $client->C_Address : old('in_Address')}}">
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
		<div class="row form-group">
			<div class="col-md-4">
				<label class="pull-right">Client Company</label>
			</div>
			<div class="col-md-8">
				<select class="form-control" name="sl_Company">
					@foreach (App\Client_Company::all() as $cp)
						<option value="{{ $cp->idClientCompany }}" {{ $cp->idClientCompany == $client->idClientCompany  ? 'selected' : null}}>{{ $cp->CC_Name }}</option>
					@endforeach
				</select>
			</div>
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
	</div>
	<div class="col-md-5 left-regis">
		<div class="avatar-img">
			<img src="{{($client->C_Avatar != NULL && File::exists(public_path('images/personal_images/'.$client->C_Avatar)) ) ? asset('images/personal_images/'.$client->C_Avatar): asset('images/notfound.jpg')}}" style="margin:0px;">
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
	</div>
</form>
@stop
@section('script')
<script src="{{ asset('js/custom-file-input.js') }}"></script>
<script type="text/javascript">
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
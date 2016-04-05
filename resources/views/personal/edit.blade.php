@extends('layout.master')
@section('title','Edit Personal Information')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/view_personal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/edit_personal.css') }}">
@stop
@section('content')
<ul>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</ul>
 <div id="content">
        <div class="container">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Basic Information
                    </div>
                    <div class="panel-body">
                    {!!Form::open(array('route'=>array('personal-information.update',$employee['idEmployee']),'method'=>'PUT','enctype'=> 'multipart/form-data'))!!}
                            <div class="row">
                                <div class="col-md-3 img-status text-center {{ $errors->has('in_img') ? ' has-error' : '' }}">
                                    <div class="img"><img src="{{($employee->E_Avatar != NULL && File::exists(public_path('images/personal_images/'.$employee->E_Avatar)) ) ? asset('images/personal_images/'.$employee->E_Avatar): asset('images/notfound.jpg')}}"></div>
                                    <div class="box">
                                        <input type="file" name="in_img" id="img" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
                                        <label for="img" class="label_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                            </svg> <span>Choose a file&hellip;</span></label>
                                    </div>
                                    @if ($errors->has('in_img'))
                                        <div class="help-block text-center" style="margin-right: 15px;margin-bottom: 0px">
                                            <strong>{{ $errors->first('in_img') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="col-md-9 basic-info">
                                <?php $idAccount = $employee->idAccount;
                                    $id_Role = App\User::find($idAccount)->idRole;
                                ?>
                                @if ($id_Role == 4)
                                    <div class="row {{ $errors->has('in_Skype') || $errors->has('wrong_skype') ? ' has-error' : '' }}">
                                        <div class="col-md-3">
                                            <label class="control-label">Skype</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="in_Skype" maxlength="32" type="text" class="form-control" value="{{isset($employee->E_Skype) && $errors->has('in_Skype') == false && $errors->has('wrong_skype') == false && old('in_Skype') == '' ? $employee->E_Skype : old('in_Skype')}}">
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
                                @endif
                                <div class="row {{ $errors->has('in_DateofBirth') || $errors->has('wrong_year') ? ' has-error' : '' }}">
                                        <div class="col-md-3">
                                            <label class="control-label">Date of Birth</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" name="in_DateofBirth" max="2100-12-31" min="1930-01-01" value="{{isset($employee->E_DateofBirth) && $errors->has('wrong_year') == false && old('in_DateofBirth') == '' ? $employee->E_DateofBirth : old('in_DateofBirth')}}">
                                        </div>
                                        @if ($errors->has('in_DateofBirth'))
                                            <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                                                <strong>{{ $errors->first('in_DateofBirth') }}</strong>
                                            </div>
                                        @endif
                                        @if ($errors->has('wrong_year'))
                                            <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                                                <strong>{{ $errors->first('wrong_year') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row {{ $errors->has('in_phone') || $errors->has('wrong_phone') ? ' has-error' : '' }}">
                                        <div class="col-md-3">
                                            <label class="control-label">Phone</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" onkeypress="validate(event)" minlength="0" maxlength="11" name="in_phone" placeholder="Phone Number" value="{{isset($employee->E_Phone) && $errors->has('in_phone') == false && $errors->has('wrong_phone') == false && old('in_phone') == '' ? '0'.$employee->E_Phone : old('in_phone')}}">
                                        </div>
                                        @if ($errors->has('in_phone'))
                                        <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                                            <strong>{{ $errors->first('in_phone') }}</strong>
                                        </div>
                                        @endif
                                        @if ($errors->has('wrong_phone'))
                                        <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                                            <strong>{{ $errors->first('wrong_phone') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row {{ $errors->has('in_address') || $errors->has('wrong_address') ? ' has-error' : '' }}">
                                        <div class="col-md-3">
                                            <label class="control-label">Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="in_address" onkeypress="validate_spec1(event)" placeholder="Address" minlength="0" maxlength="75" value="{{isset($employee->E_Address) && $errors->has('in_address') == false && $errors->has('wrong_address')  == false && old('in_address') == '' ? ($employee->E_Address) : old('in_address')}}">
                                        </div>
                                        @if ($errors->has('in_address'))
                                        <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                                            <strong>{{ $errors->first('in_address') }}</strong>
                                        </div>
                                        @endif
                                        @if ($errors->has('wrong_address'))
                                        <div class="help-block pull-right" style="margin-right: 15px;margin-bottom: 0px">
                                            <strong>{{ $errors->first('wrong_address') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row submit pull-right">
                                        <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Submit</a>
                                        <a class="btn btn-default" data-toggle="modal" href='#modal-id1'>Close</a>
                                    </div>
                                    <div class="modal fade" id="modal-id">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h4><i>Do you really want to edit?</i></h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Yes" class="btn btn-primary">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-id1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h4><i>Do you really want to close?</i></h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('personal-information.index')}}" class="btn btn-primary">Yes</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
<script src="{{ asset('js/custom-file-input.js') }}"></script>
<script type="text/javascript">
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
</script>
@stop
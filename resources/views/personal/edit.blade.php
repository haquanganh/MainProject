@extends('layout.master')
@section('title','Edit Personal Information')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/view_personal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/edit_personal.css') }}">
@stop
@section('content')
 <div id="content">
        <div class="container">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Basic Information
                    </div>
                    <div class="panel-body">
                    {!!Form::open(array('route'=>array('personal-information.update',$employee['idEmployee']),'method'=>'PUT','enctype'=> 'multipart/form-data','files' => true))!!}
                            <div class="row">
                                <div class="col-md-3 img-status text-center">
                                    <div class="img"><img src="{{ asset('images/personal_images/') }}/{{$employee->E_Avatar}}"></div>
                                    <div class="box">
                                        <input type="file" name="in_img" id="img" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
                                        <label for="img" class="label_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                            </svg> <span>Choose a file&hellip;</span></label>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-9 basic-info">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Email address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" name="in_email" class="form-control" placeholder="Email" value="{{old('in_email',isset($employee) ? $employee['E_Email'] : null)}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Skype</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="in_skype" placeholder="Skype" value="{{old('in_skype',isset($employee) ? $employee['E_Skype'] : null)}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Phone</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="in_phone" placeholder="Phone Number" value="{{old('in_phone',isset($employee) ? $employee['E_Phone'] : null)}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="in_address" placeholder="Address" value="{{old('in_address',isset($employee) ? $employee['E_Address'] : null)}}">
                                        </div>
                                    </div>
                                    <div class="row submit pull-right">
                                        <input type="submit"  value="Submit" class="btn btn-primary"></input>
                                        <input type="Reset" value="Reset" class="btn btn-primary"></input>
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
@stop
@extends('layout.admin')
@section('title','Project Management')
@section('name','Project Management')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/project.css') }}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
                <div style="height:20px;margin-left:20px;margin-right:20px">
                    <h4 style="margin-left:15px;float:left"><i>In progress</i></h4>
                    <div class="project_select pull-right">
                        <form action="" method="POST" role="form">
                            <select class="list">
                                <option value="">In progress</option>
                                <option value="">Done</option>
                            </select>
                            <a href="" class="add"><img src="{{ asset('images/add-new-icon.png') }}" style="width:50px;height:50px;" alt=""></a>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row folder">
					<div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='http://google.com';">
                            <p><b>Business Information Management System</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>

                        </div>
                    </div>
                </div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".list").select2();
        });
    </script>
@stop
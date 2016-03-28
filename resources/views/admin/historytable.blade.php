@extends('layout.admin')
@section('title','History Table')
@section('name','History Table')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/historytable.css') }}"> 	
@stop
@section('content')
<!-- <ul class="timeline">
    <li>
        <div class="timeline-badge">
          <a><i class="fa fa-circle" id=""></i></a>
        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4><b>Business Information Management System</b></h4>
            </div>
            <div class="timeline-body">
                <p>Balance Team</p>
            </div>
            <div class="timeline-footer">
                <p class="text-right"><i>2-Feb-2016 <span>-</span> 2-Mar-2016</i></p>
            </div>
        </div>
    </li>
    
    <li class="timeline-inverted">
        <div class="timeline-badge">
            <a><i class="fa fa-circle invert" id=""></i></a>
        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4><b>Business Information Management System</b></h4>
            </div>
            <div class="timeline-body">
                <p>Balance Team</p>
            </div>
            <div class="timeline-footer">
                <p class="text-right"><i>2-Feb-2016 <span>-</span> 2-Mar-2016</i></p>
            </div>
        </div>
    </li>
    
    <li>
        <div class="timeline-badge">
            <a><i class="fa fa-circle" id=""></i></a>
        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4><b>Business Information Management System</b></h4>
            </div>
            <div class="timeline-body">
                <p>Balance Team</p>
            </div>
            <div class="timeline-footer">
                <p class="text-right"><i>2-Feb-2016 <span>-</span> 2-Mar-2016</i></p>
            </div>
        </div>
    </li>
    
    <li class="timeline-inverted">
        <div class="timeline-badge">
            <a><i class="fa fa-circle invert" id=""></i></a>
        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4><b>Business Information Management System</b></h4>
            </div>
            <div class="timeline-body">
                <p>Balance Team</p>
            </div>
            <div class="timeline-footer">
                <p class="text-right"><i>2-Feb-2016 <span>-</span> 2-Mar-2016</i></p>
            </div>
        </div>
    </li>
    
    <li>
        <div class="timeline-badge">
            <a><i class="fa fa-circle" id=""></i></a>
        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4><b>Business Information Management System</b></h4>
            </div>
            <div class="timeline-body">
                <p>Balance Team</p>
            </div>
            <div class="timeline-footer">
                <p class="text-right"><i>2-Feb-2016 <span>-</span> 2-Mar-2016</i></p>
            </div>
        </div>
    </li>
    
    <li  class="timeline-inverted">
        <div class="timeline-badge">
            <a><i class="fa fa-circle invert" id=""></i></a>
        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4><b>Business Information Management System</b></h4>
            </div>
            <div class="timeline-body">
                <p>Balance Team</p>
            </div>
            <div class="timeline-footer">
                <p class="text-right"><i>2-Feb-2016 <span>-</span> 2-Mar-2016</i></p>
            </div>
        </div>
    </li>
    <li class="clearfix no-float"></li>
</ul> -->
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date Modified</th>
                <th>Username</th>
                <th>Action</th>
                <th>Result</th>
                <th>Change</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>11:00 AM, 19-3-2016</td>
                <td>hampton</td>
                <td>Create new project</td>
                <td>Business Information Management System</td>
                <td>Business Information Management System</td>
            </tr>
            <tr>
                <td>4:00 PM, 19-3-2016</td>
                <td>Missy</td>
                <td>Leave feecback</td>
                <td>A feedback</td>
                <td>A feedback</td>
            </tr>
            <tr>
                <td>8:00 AM, 19-3-2016</td>
                <td>Asstro</td>
                <td>Create new project</td>
                <td>Business Information Management System</td>
                <td>Business Information Management System</td>
            </tr>
            <tr>
                <td>9:00 AM, 19-3-2016</td>
                <td>Talor</td>
                <td>Change Status</td>
                <td>Available</td>
                <td>Available</td>
            </tr>
        </tbody>
    </table>
@stop
@section('script')
	<script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
@stop

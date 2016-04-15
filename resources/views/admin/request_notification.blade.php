@extends('layout.admin')
@section('title','Notification Board')
@section('name','Notification Board')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">

	<style type="text/css">
		#table tbody tr td{
			line-height: 34px;
		}
	</style>
@stop
@section('content')
	
	<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Content</th>
                <th>Send date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($list_request as $listrequest)
            <tr>
                <td>{{ $listrequest->idClient != null ? 'Client':'Employee' }} 
                	{{ $listrequest->idClient != null ? $listrequest->idClient:$listrequest->idEmployee1 }} 
                	has sent request to see information of employee 
                	{{ $listrequest->idEmployee2 }}!
                </td>
                <td>{{ $listrequest->dateCreate }}</td>
                <td>
                    <div class="form-confirm pull-right">
                        <form method="POST" action="{{ url('/admin/request-notify') }}/{{ $listrequest->idRequest }}" > 
                        {!! csrf_field() !!}
                            <input type="submit" name="accept" class="btn btn-primary" style="margin-right: 10px;" value="Accept">
                                <!-- <span class="glyphicon glyphicon-ok"></span> -->
                            </input>
                            <input type="submit" name="reject" class="btn btn-default" value="Reject">
                                <!-- <span class="glyphicon glyphicon-remove"></span> -->
                            </input>
                        </form>
                    </div>
                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
@stop
@section('script')

<script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });
    </script>

@stop
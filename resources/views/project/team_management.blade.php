@extends('layout.master')
@section('title','Home page')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/team_management.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/datatables-1.10.11/css/dataTables.bootstrap.min.css') }}">
@stop
@section('content')
<div id="img-title">
    <p>{{App\Team::where('idPManager','=',App\Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee)->first()->TeamName.' Team'}}</p>
</div>
<div class="clearfix" style="height: 10px"></div>
<div class="row table-responsive">
    <div class="col-md-12">
    	<table class="table table-striped table-bordered">
        	<thead>
    		<tr>
    			<th>Avatar</th>
    			<th>Name</th>
    			<th>Date of birth</th>
    			<th>Skype</th>
    			<th>Phone</th>
    			<th>Role</th>
                <th>Status</th>
                <th>More</th>
    		</tr>
        	</thead>
        	<tbody>
                @foreach ($team as $e)
                <tr>
                    <td style="width:50px"><img class="img img-circle" src="{{ asset('images/personal_images').'/'.$e->E_Avatar }}"></td>
                    <td>{{$e->E_EngName}}</td>
                    <td>{{$e->E_DateofBirth}}</td>
                    <td>{{$e->E_Skype}}</td>
                    <td>{{$e->E_Phone}}</td>
                    <td>{{App\Role::find(App\User::find($e->idAccount)->idRole)->Role}}</td>
                    <td>{{App\E_Status::find($e->idStatus)->Status}}</td>
                    <td><a href="{{ url('team_management/employee') }}/{{ $e->idEmployee }}" class="glyphicon glyphicon-circle-arrow-right"></a></td>
                </tr>
                @endforeach
        	</tbody>
    	</table>
    </div>
</div>
@stop
@section('script')
<script src="{{ asset('third-library/select2-4.0.2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $('#searchbox').select2({
        placeholder: "Select type of search",
        minimumResultsForSearch: Infinity,
    });
</script>
<script src="{{ asset('third-library/datatables-1.10.11/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('third-library/datatables-1.10.11/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    jQuery(document).ready(function($) {
        $('.table').DataTable();
    });
</script>
@stop
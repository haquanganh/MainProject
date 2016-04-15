@extends('layout.master')
@section('title','Home page')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/team_management.css') }}">
@stop
@section('content')
<div id="img-title">
    <p>{{App\Team::where('idPManager','=',App\Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee)->first()->TeamName.' Team'}}</p>
</div>
<div class="row search">
    <div class="search-form">
        <form method="POST" action="{{ url('/employee-information') }}">
            {!! csrf_field() !!}
            <button class="btn btn-primary" type="submit" value="Search">
                <span class="glyphicon glyphicon-search"></span>
            </button>
            <input class="form-control" type="text"  name="search" placeholder="Enter Name, Skill or Cost/hour"></input>
            <select name="search-type" class="form-control select">
                <option value="Search by name">Search by name</option>
                <option value="Search by skill">Search by skill</option>
                <option value="Search by cost/hour">Search by cost/hour</option>
            </select>
            <div class="clear"></div>
        </form>
    </div>
</div>
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
                        </tr>
                        @endforeach
                	</tbody>

	</table>
        </div>
</div>
@stop
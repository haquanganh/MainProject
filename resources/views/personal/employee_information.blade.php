@extends('layout.master')
@section('title','Employee Information')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/employee_information.css') }}">
@stop

@section('content')
	<div id="img-title">
        <p>Employee Information</p>
    </div>
    <div class="search-form">
	    <form method="POST" action="{{ url('/search') }}">
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
	    @if (isset($message))
	        <div style="text-align: center; font-size: 20px; color: black;">
	            {{ $message }}
	        </div>
	    @endif
    @if (isset($Listskill))	
    		<div class="table-responsive" style="padding: 20px;">
           <table class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Skype</th>
                            <th>Phone</th>
                            <th>Role</th>

                        </tr>
                </thead>
                @foreach ($Listskill as $employee)
                    <?php
                        $id_Role = App\User::find($employee->idAccount)->idRole;
                        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
                    ?>
                <tbody>
                    <tr>
                            <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$employee->E_Avatar}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                            <td>{{$employee->E_Name}}</td>
                            <td>{{$employee->E_DateofBirth}}</td>
                            <td>{{$employee->E_Skype}}</td>
                            <td>0{{$employee->E_Phone}}</td>
                            <td>{{$name_Role}}</td>
                        </tr>
                </tbody>
                @endforeach
           </table>
           </div>
    @else 
    <div class="table-responsive" style="padding: 20px;">
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                        <tr class="info">
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Skype</th>
                            <th>Phone</th>
                            <th>Role</th>

                        </tr>
                </thead>
                @foreach ($list_employee as $employee)
                    <?php
                        $id_Role = App\User::find($employee->idAccount)->idRole;
                        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
                    ?>
                <tbody>
                    <tr>
                            <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$employee->E_Avatar}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                            <td>{{$employee->E_Name}}</td>
                            <td>{{$employee->E_DateofBirth}}</td>
                            <td>{{$employee->E_Skype}}</td>
                            <td>0{{$employee->E_Phone}}</td>
                            <td>{{$name_Role}}</td>
                        </tr>
                </tbody>
                @endforeach
           </table>
           </div>
		@endif
    
@stop
@section('script')
@stop
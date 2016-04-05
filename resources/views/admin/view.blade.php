@extends('layout.admin')
@section('title','Personal Information')
@section('name','Personal Information')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/personal_information.css') }}">
@stop
@section('content')
	<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Date of birth</th>
                            <th>Skype</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_employee as $employee)
                    <?php
                        $id_Role = App\User::find($employee->idAccount)->idRole;
                        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
                    ?>
                    @if ($id_Role != 1)
                        <tr>
                            <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$employee->E_Avatar}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                            <td>{{$employee->E_Name}}</td>
                            <td>{{$employee->E_Sex == 1 ? 'Male' : 'Female'}}</td>
                            <td>{{$employee->E_DateofBirth}}</td>
                            <td>{{$employee->E_Skype}}</td>
                            <td>0{{$employee->E_Phone}}</td>
                            <td>{{$name_Role}}</td>
                            <td><a href="{{ route('admin.personal-information.edit',$employee->idEmployee) }}" class="btn btn-primary">Edit</a></td>
                        </tr>
                    @endif
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
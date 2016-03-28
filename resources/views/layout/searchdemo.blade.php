@extends('layout.master')
@section('title','Search demo')
@section('name','search demo')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/personal_information.css') }}">
@stop
@section('content')
    <form method="POST" action="{{ url('/search') }}">
        {!! csrf_field() !!}
        <input type="text"  name="search" placeholder="Search"></input>
        <input type="submit" value="Search" onclick="myfunction()"></input>
    </form>
    @if (isset($message))
        <div>
            {{ $message }}
        </div>
    @endif
    @if (isset($Listskill))  
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
        
      
    @endif
@stop
@section('script')
<script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });
    </script>
    <script type="text/javascript">
        
    </script>
@stop
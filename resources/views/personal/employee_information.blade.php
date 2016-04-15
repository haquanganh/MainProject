@extends('layout.master')
@section('title','Employee Information')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/employee_information.css') }}">
@stop
@section('content')
    <div id="img-title">
        <p>Employee Information</p>
    </div>
        <!-- Search test -->
        <!-- <div class="search-form ui-widget">
            <form method="POST" action="{{ url('/employee-information') }}">
                {!! csrf_field() !!}
                <button class="btn btn-primary" type="submit" value="Search">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
                <input class="form-control" type="text"  id="search" name="search"></input>
                <?php
                    $id_Role = Auth::user()->idRole;
                ?>
                <select name="search-type" class="form-control select">
                    <option value="Search by name">Search by name</option>
                    <option value="Search by skill">Search by skill</option>
                    @if($id_Role == 4)
                        <option value="Search by cost/hour">Search by cost/hour</option>
                    @endif
         <!--        </select> 
                <div class="clear"></div>
            </form>
        </div> -->
    @if (isset($message))
        <div style="text-align: center; font-size: 20px; color: black;">
            {{ $message }}
        </div>
    @endif
    @if (isset($Listskill)) 
        <div class="table-responsive" style="padding: 20px;">
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Skype</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>View more</th>
                        </tr>
                </thead>
                <tbody>
                @foreach ($Listskill as $employee)
                    <?php
                        $id_Role = App\User::find($employee->idAccount)->idRole;
                        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
                    ?>
                    <tr>
                        <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$employee->E_Avatar}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                        <td>{{$employee->E_Name}}</td>
                        <td>{{$employee->E_DateofBirth}}</td>
                        <td>{{$employee->E_Skype}}</td>
                        <td>0{{$employee->E_Phone}}</td>
                        <td>{{$name_Role}}</td>
                        <td style="width: 100px; padding-left: 30px;">
                            <a class="btn btn-primary" data-toggle="modal" href='#modal-send-request{{ $employee->idEmployee }}' style="width: 40px;height: 30px; border-radius: 15px;"><span class="glyphicon glyphicon glyphicon-eye-open"></span></a>
                        </td>
                    </tr>
                     <!-- Send request -->
                    <div class="modal fade" id="modal-send-request{{ $employee->idEmployee }}">
                        <form method="POST" action="{{ url('/send-request') }}/{{ $employee->idEmployee }}">
                        {!! csrf_field() !!}
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">
                                            You are not allow to see this employee's private information.
                                            Please send request to Administrator to see this!
                                        </h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Send request</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>     
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>    
                @endforeach
                </tbody>
           </table>
        </div>
    @else 
        <div class="table-responsive" style="padding: 20px;">
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Skype</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>View more</th>
                        </tr>
                </thead>
                <tbody>
                 @foreach ($list_employee as $employee)
                    <?php
                        $id_Role = App\User::find($employee->idAccount)->idRole;
                        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
                    ?>
                    <tr>
                        <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$employee->E_Avatar}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                        <td>{{$employee->E_Name}}</td>
                        <td>{{$employee->E_DateofBirth}}</td>
                        <td>{{$employee->E_Skype}}</td>
                        <td>0{{$employee->E_Phone}}</td>
                        <td>{{$name_Role}}</td>
                        <td style="width: 100px; padding-left: 30px;">
                            <a class="btn btn-primary" data-toggle="modal" href='#modal-send-request{{ $employee->idEmployee }}' style="width: 40px;height: 30px; border-radius: 15px;"><span class="glyphicon glyphicon glyphicon-eye-open"></span></a>
                        </td>
                    </tr>
                    <!-- Send request -->
                    <div class="modal fade" id="modal-send-request{{ $employee->idEmployee }}">
                        <form method="POST" action="{{ url('/send-request') }}/{{ $employee->idEmployee }}">
                        {!! csrf_field() !!}
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">
                                            You are not allow to see this employee's private information.
                                            Please send request to Administrator to see this!
                                        </h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Send request</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>     
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>    
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <!-- Message after send request -->
    @if(Session::has('messages'))            
                    <a data-toggle="modal" id="messages-click" href='#messages'></a>
                    <div class="modal fade" id="messages">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                        {{Session::get('messages')}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
@stop
@section('script')
<script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function(){
            jQuery('#messages-click').click();
        });

        $(document).ready(function() {
            $('#table').DataTable();
            $('#table_filter label').hide();

            $('<div class="search-form ui-widget"><form method="POST" action="{{ url("/employee-information") }}">{!! csrf_field() !!}<button class="btn btn-primary" type="submit" value="Search"><span class="glyphicon glyphicon-search"></span></button><input class="form-control" type="text"  id="search" name="search"></input><?php $id_Role = Auth::user()->idRole;?><select name="search-type" class="form-control select"><option value="Search by name">Search by name</option><option value="Search by skill">Search by skill</option></select><div class="clear"></div></form></div>').appendTo('#table_filter');

            @if($id_Role == 4)
            $('<option value="Search by cost/hour">Search by cost/hour</option>').appendTo('#table_filter select');
            @endif
        });
    </script>
@stop
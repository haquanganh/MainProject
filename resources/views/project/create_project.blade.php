@extends('layout.master')
@section('title','Home page')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/create_project.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
            <div id="img-title">
                <p>Create New Project</p>
            </div>
            <form class="form-inline" role="form" method="POST" action="create-project">
                {{csrf_field()}}
                    <?php
                         $idAccount = Auth::user()->idAccount;
                         $idE = App\Employee::where('idAccount','=',$idAccount)->first()->idEmployee;
                         $idTeam = App\Team::where('idPManager','=',$idE)->first()->idTeam;
                         $listE = App\Team::find($idTeam)->Employee;
                         $listC = App\Clients::all();
                    ?>
                    <input type="hidden" value="{{$listE->count()}}" name="n_listE">
                <div class="info">
                    <div class="col-xs-3">
                        <label for=""><i>Project</i></label>
                        <input type="text" name="in_NameofProject" class="form-control" placeholder="Name Of Project">
                    </div>
                    <div class="col-xs-3">
                        <label for=""><i>Client</i></label>
                       <select class="list" name="sl_Client">
                        @foreach ($listC as $c)
                            <option value="{{$c->idClient}}">{{$c->ClientName}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <label for=""><i>Time</i></label>
                        <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" class="form-control" />
                    </div>
                    <div class="col-xs-3">
                        <label for=""><i>Leader</i></label>
                        <select class="list" name="sl_Leader">
                            @foreach ($listE as $key => $e)
                                <option value="{{$e->idEmployee}}">{{$e->E_EngName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row table-responsive">
                    <div class="col-xs-12">
                        <table class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <td>Avatar</td>
                                    <td>English name</td>
                                    <td>Full Name</td>
                                    <td>Skype</td>
                                    <td>Choose</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($listE as $key => $e )
                                <tr>
                                    <td><img src="{{ asset('images')}}/{{$e->E_Avatar}}" class="img img-circle" alt=""></td>
                                    <td>{{$e->E_EngName}}</td>
                                    <td>{{$e->E_Name}}</td>
                                    <td>{{$e->E_Skype}}</td>
                                    <td>
                                        <input type="checkbox" name="c[{{$key}}]" value="{{$e->idEmployee}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-bottom:5px;">
                    <div class="col-md-6">
                        <label for=""><i>Search</i></label>
                        <input type="text" class="form-control" placeholder="Search for employee">
                    </div>
                    <div class="col-md-6">
                        <div class="submit" style="float:right">
                            <input type="submit" class="btn btn-primary" value="Create">
                            <a href="#" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="clear40"></div>
            </form>
@stop
@section('script')
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker();
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".list").select2();
    });
    </script>
@stop
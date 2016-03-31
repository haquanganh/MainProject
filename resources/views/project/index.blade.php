@extends('layout.master')
@section('title','Home page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/project.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
<div class="clear20" style="height: 20px"></div>
<div id="content">
            <div id="img-title">
                <p>Project Management</p>
           </div>
            <div class="container">
                <div style="height:20px;margin-left:20px;margin-right:20px">
                    <h4 style="margin-left:15px;float:left"><i>In progress</i></h4>
                    <div class="project_select pull-right">
                        <form action="" method="POST" role="form">
                            <select class="list">
                                <option value="">In progress</option>
                                <option value="">Done</option>
                            </select>
                            <?php
                                    $idRole = Auth::user()->idRole;
                             ?>
                            @if ($idRole == 2)
                                <a href="/create-project" class="add"><img src="images/add-new-icon.png" style="width:50px;height:50px;" alt=""></a>
                            @endif
                        </form>
                    </div>
                </div>
                <hr>
                <?php
                        $employee = App\Employee::where('idAccount','=',Auth::user()->idAccount)->first();
                        $listP = $employee->Project;
                        $listP_PM = App\Project::where('idPManager','=',$employee->idEmployee)->get();
                        $listP_LD = App\Project::where('idTeamLeader','=',$employee->idEmployee)->get();
                ?>
                <div class="row folder">
                @foreach ($listP as $l)
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='{{ url('project_detail') }}/{{$l->idProject}}'">
                            <p><b>{{$l->P_Name}}</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>{{$l->P_DateCreate}} <span>-</span>{{$l->P_DateFinish}}</i></p>

                        </div>
                    </div>
                @endforeach
                @foreach ($listP_PM as $l)
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='{{ url('project_detail') }}/{{$l->idProject}}'">
                            <p><b>{{$l->P_Name}}</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>{{$l->P_DateCreate}} <span>-</span>{{$l->P_DateFinish}}</i></p>

                        </div>
                    </div>
                @endforeach
                @foreach ($listP_LD as $l)
                    <div class="col-md-3">
                        <div class="content-box-large" onclick="window.location='{{ url('project_detail') }}/{{$l->idProject}}'">
                            <p><b>{{$l->P_Name}}</b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i>{{$l->P_DateCreate}}<span>-</span> {{$l->P_DateFinish}}</i></p>
                        </div>
                    </div>
                @endforeach
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
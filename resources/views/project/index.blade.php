@extends('layout.master')
@section('title','Home page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/project.css') }}">
<link href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}" rel="stylesheet" />
@stop
@section('content')
<div class="clear20" style="height: 20px"></div>
<div id="img-title">
    <p>Project Management</p>
</div>
<div class="container">
    <div class="row" style="margin-bottom: 0px;margin-left:20px;margin-right:20px">
        <h4 style="margin-left:15px;float:left"><i>In progress</i></h4>
        <div class="project_select pull-right">
            <form action="" method="POST" role="form">
                <select class="list">
                    <option value="1">In progress</option>
                    <option value="2">Done</option>
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
        $idUser = 0;
        $projects_PM = 0;
        $projects_LD = 0;
        $project_TM = 0;
        if(Auth::user()->idRole != 4){
            $idUser = App\Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
            $projects_PM = App\Project::where('idPStatus','=',1)->where('idPManager','=',$idUser)->get();
            $projects_LD = App\Project::where('idPStatus','=',1)->where('idTeamLeader','=',$idUser)->get();
            $project_TM = App\Employee::find($idUser)->Project;
        }
        else{
            $idUser = App\Clients::where('idAccount','=',Auth::user()->idAccount)->first()->idClient;
            $project_client = App\Project::where('idClient','=',$idUser)->where('idPStatus','=',1)->get();
        }
    ?>
    @if (Session::has('flat'))
        <div class="alert alert-success" role="alert">{{Session('flat')}}</div>
    @endif
    <div class="row folder">
    @if (Auth::user()->idRole == 4)
        @foreach ($project_client as $l)
        <div class="col-md-3 projects">
            <div class="content-box-large" onclick="window.location='{{ url('project_detail') }}/{{$l->idProject}}'">
                <p class="name-project"><b>{{$l->P_Name}}</b></p>
                <p class="time-project"><i>{{$l->P_DateCreate}} <span>-</span>{{$l->P_DateFinish}}</i></p>

            </div>
        </div>
    @endforeach
    @else
    @foreach ($projects_PM as $l)
        <div class="col-md-3 projects">
            <div class="content-box-large" onclick="window.location='{{ url('project_detail') }}/{{$l->idProject}}'">
                <p class="name-project"><b>{{$l->P_Name}}</b></p>
                <p class="time-project"><i>{{$l->P_DateCreate}} <span>-</span>{{$l->P_DateFinish}}</i></p>

            </div>
        </div>
    @endforeach
    @foreach ($projects_LD as $l)
        <div class="col-md-3 projects">
            <div class="content-box-large" onclick="window.location='{{ url('project_detail') }}/{{$l->idProject}}'">
                <p><b>{{$l->P_Name}}</b></p>
                <br>
                <br>
                <p class="pull-right"><i>{{$l->P_DateCreate}} <span>-</span>{{$l->P_DateFinish}}</i></p>

            </div>
        </div>
    @endforeach
    @foreach ($project_TM as $l)
        <div class="col-md-3 projects">
            <div class="content-box-large" onclick="window.location='{{ url('project_detail') }}/{{$l->idProject}}'">
                <p><b>{{$l->P_Name}}</b></p>
                <br>
                <br>
                <p class="pull-right"><i>{{$l->P_DateCreate}}<span>-</span> {{$l->P_DateFinish}}</i></p>
            </div>
        </div>
    @endforeach
    @endif
    </div>
@stop
@section('script')
<script src="{{ asset('third-library/select2-4.0.2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".list").select2();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
               setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 2000);
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.list').change(function(){
                var idPStatus = $(this).val();
                var idAccount = {{Auth::user()->idAccount}};
                var list_n = $('.projects').length;
                $.ajax({
                    url: '{{ url('/get-listProject') }}',
                    type: 'GET',
                    cache: false,
                    data:{"idAccount" : idAccount,"idPStatus" :idPStatus},
                    success: function(data){
                        var result = $.parseJSON(data);
                        if(data != 'Empty'){
                            if(list_n > 0){
                                $('.projects').remove();
                            }
                            @if(Auth::user()->idRole != 4)
                               $.each( result[0], function( key, value ) {
                                    $('.folder').append('<div class="col-md-3 projects"><div class="content-box-large" onclick="window.location=\''+'{{ url('project_detail') }}/'+value.idProject+'\';"><p class="name-project"><b>'+value.P_Name+'</b></p><br><br><p class="time-project"><i>'+value.P_DateStart+'<span>-</span>'+value.P_DateFinish+'</i></p></div></div>');
                               });
                               $.each( result[1], function( key, value ) {
                                    $('.folder').append('<div class="col-md-3 projects"><div class="content-box-large" onclick="window.location=\''+'{{ url('project_detail') }}/'+value.idProject+'\';"><p class="name-project"><b>'+value.P_Name+'</b></p><br><br><p class="time-project"><i>'+value.P_DateStart+'<span>-</span>'+value.P_DateFinish+'</i></p></div></div>');
                               });
                               $.each( result[2], function( key, value ) {
                                    $('.folder').append('<div class="col-md-3 projects"><div class="content-box-large" onclick="window.location=\''+'{{ url('/project_detail') }}/'+value.idProject+'\';"><p class="name-project"><b>'+value.P_Name+'</b></p><br><br><p class="time-project"><i>'+value.P_DateStart+'<span>-</span>'+value.P_DateFinish+'</i></p></div></div>');
                               });
                               @else
                               $.each( result[0], function( key, value ) {
                                    $('.folder').append('<div class="col-md-3 projects"><div class="content-box-large" onclick="window.location=\''+'{{ url('project_detail') }}/'+value.idProject+'\';"><p class="name-project"><b>'+value.P_Name+'</b></p><br><br><p class="time-project"><i>'+value.P_DateStart+'<span>-</span>'+value.P_DateFinish+'</i></p></div></div>');
                               });
                           @endif
                        }
                    }
                });
            });
        });
    </script>
@stop
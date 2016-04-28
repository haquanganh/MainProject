@extends('layout.admin')
@section('title','Project Management')
@section('name','Project Management')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/project_detail.css') }}">
	<link href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}" rel="stylesheet" />
@stop
@section('content')
    <?php
        $client = App\Clients::find($project->idClient);
        $teamLeader = App\Employee::find($project->idTeamLeader);
        $PM = App\Employee::find($project->idPManager);
        /*Date of Project*/
        $ds = new DateTime($project->P_DateStart);
        $datestart = $ds->format('Y-F-d');
        $dn = new DateTime($project->P_DateFinish);
        $datefinish = $dn->format('Y-F-d');
        $team = $project->Employee;
    ?>

    <a id="edit-button" class="btn btn-primary" href="{{ url('admin/project/edit/') }}/{{$project->idProject}}"><span class="glyphicon glyphicon-pencil"></span></a>
    <div class="row" id="currentproject" style="clear: both;">
        <div class="col-md-12">
        <div id="project-name" class="row">
                <p class="lead text-center">{{ $project->P_Name }}</p>
                <p class="fancy text-center small"><span>{{ $datestart }} &nbsp;-&nbsp;{{ $datefinish }}</span></p>
                <p class="text-center" style="margin-top:20px;margin-bottom: -10px;color: #5F75B5"><i>This is the project about something that you have to know, but you maybe allowed to know.This is the project about something that you have to know, but you maybe allowed to know.This is the project about something that you have to know, but you maybe allowed to know.</i></p>
        </div>
            <hr>
            <div class="col-md-6">
                <div class="box-info">
                    <div class="main-info">
                        <img src="{{ asset('images/personal_images').'/'.$PM->E_Avatar }}">
                        <div class="info">
                            <h4 class="lead">{{ $client->ClientName }}</h4>
                            <h5 class="small"><i>Client</i></h5>
                            <br>
                            <p>Phone: {{ $client->C_Phone }}</p>
                            <p>Skype: {{ $client->C_Skype }}</p>
                        </div>
                    </div>
                    <div class="cost-info">
                        <p>Company: {{  $client->C_Company }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box-info">
                    <div class="main-info">
                        <img src="{{ asset('images/personal_images').'/'.$PM->E_Avatar }}">
                        <div class="info">
                            <h4 class="lead">{{ $PM->E_EngName }}</h4>
                            <h5 class="small"><i>Project Manager</i></h5>
                            <br>
                            <p>Phone: {{ $PM->E_Phone }}</p>
                            <p>Skype: {{ $PM->E_Skype }}</p>
                        </div>
                    </div>
                    <div class="cost-info">
                        <p>Cost/Hour: {{  '$'.$PM->E_Cost_Hour }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box-info">
                    <div class="main-info">
                        <img src="{{ asset('images/personal_images').'/'.$teamLeader->E_Avatar }}">
                        <div class="info">
                            <h4 class="lead">{{ $teamLeader->E_EngName }}</h4>
                            <h5 class="small"><i>Team Leader</i></h5>
                            <br>
                            <p>Phone: {{ $teamLeader->E_Phone }}</p>
                            <p>Skype: {{ $teamLeader->E_Skype }}</p>
                        </div>
                    </div>
                    <div class="cost-info">
                        <p>Cost/Hour: {{  '$'.$teamLeader->E_Cost_Hour }}</p>
                    </div>
                </div>
            </div>
            @foreach ($team as $e)
            <div class="col-md-6">
                <div class="box-info">
                    <div class="main-info">
                        <img src="{{ asset('images/personal_images').'/'.$e->E_Avatar }}">
                        <div class="info">
                            <h4 class="lead">{{ $e->E_EngName }}</h4>
                            <h5 class="small"><i>Member</i></h5>
                            <br>
                            <p>Phone: {{ $e->E_Phone }}</p>
                            <p>Skype: {{ $e->E_Skype }}</p>
                        </div>
                    </div>
                    <div class="cost-info">
                        <p>Cost/Hour: {{'$'.$e->E_Cost_Hour }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog" style="z-index:3001;">
        <div class="modal-dialog" style="max-width:1000px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Anh (Astro) Q.Ha
                    </h4>
                </div>
                <div class="modal-body" style="height: auto;max-height: 500px;overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-12">
                            <h4><i>Basic Information</i></h4>
                            <ul class="list-group basic-information">
                                <li class="list-group-item">ID Employee: EDNZ160001</li>
                                <li class="list-group-item">Name: Anh (Astro) Q. Ha</li>
                                <li class="list-group-item">Skype: eureka.m0198</li>
                                <li class="list-group-item">Phone: 0906478808</li>
                                <li class="list-group-item">Address: 46 Ho Tung Mau, Hoa Minh, Lien Chieu, Da Nang</li>
                            </ul>
                            <h4><i>Technical Information</i></h4>
                            <ul class="list-group tech-info">
                                <li class="list-group-item skill">
                                    <div class="detailed_skill">
                                        <div class="skill-name">Java</div>
                                    </div>
                                    <div class="detailed_skill">
                                        <div class="skill-name">NET</div>
                                    </div>
                                    <div class="detailed_skill">
                                        <div class="skill-name">C#</div>
                                    </div>
                                </li>
                                <li class="list-group-item role">Role: SW1</li>
                                <li class="list-group-item cost_hour">Cost Hour: $15</li>
                            </ul>
                        </div>
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-7"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-default pull-left">Give feedback for this person</a>
                    <button class="btn btn-default">Go the personal page</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:5px;clear:both;border-radius: 5px; border:1px solid #ccc">
        <div class="col-md-12">
        </div>
    </div>
@stop
@section('script')
@stop
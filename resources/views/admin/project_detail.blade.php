@extends('layout.admin')
@section('title','Project Management')
@section('name','Project Management')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/project_detail.css') }}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
<?php
                $client = App\Clients::find($project->idClient);
                $teamLeader = App\Employee::find($project->idTeamLeader);
                $PM = App\Employee::find($project->idPManager);
            ?>
            <div class="row">
                <div class="col-md-6 text-center" style="height:500px;marign:0px;background-color:#EDEDED;color:black;padding-top:20px;">
                    <div>
                        <h4><b>{{$client->ClientName}}</b></h4>
                        <h1><b>{{$project->P_Name}}</b></h1>
                        <h4><i>{{$project->P_DateStart}} <span>-</span>{{$project->P_DateFinish}}</i></h4>
                        <h4>{{$PM->E_EngName}}</h4>
                        <h3>{{$project->P_Note}}</h3>
                    </div>
                </div>
                <div class="col-md-6" style="height:500px;background-color:#FFFFFF; margin:0px;">
                    <div class="team" style="margin-top:15px">
                        <div class="row text-center">
                            <a href="#" data-toggle="modal" data-target="#myModal"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$teamLeader->E_Avatar}}" style="width:80px;height:80px" alt=""></a>
                            <p>{{$teamLeader->E_EngName}}</p>
                        </div>
                        <div class="row text-center">
                            @foreach ($project->Employee as $e)
                            @if(count($project->Employee) == 3 )
                                <div class="col-md-4">
                                    <img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt="">
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                                </div>
                            @elseif(count($project->Employee) ==2 )
                            <div class="col-md-6">
                                    <img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt="">
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @elseif(count($project->Employee) ==1)
                                <div class="col-md-12">
                                    <img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt="">
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @else
                            <div class="col-md-4">
                                    <img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt="">
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
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
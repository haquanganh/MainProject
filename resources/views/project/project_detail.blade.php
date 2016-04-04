@extends('layout.master')
@section('title','Home page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/project_detail.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
            <div id="img-title">
                <p>Project Information
                    <a href="{{ url('/project/edit/') }}/{{$project->idProject}}" class="pull-right" style="color:white;"><i class="glyphicon glyphicon-edit"></i></a>
                </p>
            </div>
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
                            <a class="link" data="{{$teamLeader->idEmployee}}" href="#" ><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$teamLeader->E_Avatar}}" style="width:80px;height:80px" alt=""></a>
                            <p>{{$teamLeader->E_EngName}}</p>
                        </div>
                        <div class="row text-center">
                            @foreach ($project->Employee as $e)
                            @if(count($project->Employee) == 3 )
                                <div class="col-md-4">
                                    <a class="link" data="{{$e->idEmployee}}" href="#"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt=""></a>
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                                </div>
                            @elseif(count($project->Employee) ==2 )
                            <div class="col-md-6">
                                    <a class="link" data="{{$e->idEmployee}}" href="#"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt=""></a>
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @elseif(count($project->Employee) ==1)
                                <div class="col-md-12">
                                    <a class="link" data="{{$e->idEmployee}}" href="#"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt=""></a>
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @else
                            <div class="col-md-4">
                                    <a class="link" data="{{$e->idEmployee}}" href="#"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt=""></a>
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                                <div class="col-md-12">
                                    <h4><i>Basic Information</i></h4>
                                    <ul class="list-group basic-information">
                                        <li class="list-group-item id">ID Employee: EDNZ160001</li>
                                        <li class="list-group-item name">Name: Anh (Astro) Q. Ha</li>
                                        <li class="list-group-item skype">Skype: eureka.m0198</li>
                                        <li class="list-group-item phone">Phone: 0906478808</li>
                                        <li class="list-group-item address">Address: 46 Ho Tung Mau, Hoa Minh, Lien Chieu, Da Nang</li>
                                    </ul>
                                    <h4><i>Technical Information</i></h4>
                                    <ul class="list-group tech-info">
                                        <li class="list-group-item skill">
                                            <div class="detailed_skill">
                                                <div class="skill-name">Java</div>
                                            </div>
                                            <div class="detailed_skill">
                                                <div class="skill-net">NET</div>
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
            <div class="row" style="margin-top:5px;clear:both;border-radius: 5px; border:1px solid #ccc">
                <div class="col-md-12">
                </div>
            </div>
            </form>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".list").select2();
    });
    $(document).ready(function() {
        $(".list_new").select2();
    });
    </script>
    <script type="text/javascript">
    // var idEmployee = $(this).attr("data");
    //                 <?php $e = App\Employee::find('selector')?>
    //                 $('.basic-information').find('.id').text(idEmployee);
    //                 $('.basic-information').find('.name').text(idEmployee);
    //                 $('.basic-information').find('.skype').text(idEmployee);
    //                 $('.basic-information').find('.phone').text(idEmployee);
    //                 $('.basic-information').find('.address').text(idEmployee);
    //                 $('.basic-information').find('.id').text(idEmployee);
    //                 $('.basic-information').find('.id').text(idEmployee);
    //                 $('.basic-information').find('.id').text(idEmployee);
        $(document).ready(function(){
            $('.link').click(function(){
                var idE = $(this).attr("data");
                $.ajax({
                    url: '{{ url('/get-employee') }}',
                    type: 'GET',
                    cache: false,
                    data:{"idE" : idE },
                    success: function(data){
                        var result = $.parseJSON(data);
                        console.log(result[1]);
                         $('.basic-information').find('.id').text(result[0].idEmployee);
                         $('.basic-information').find('.name').text(result[0].E_EngName);
                         $('.basic-information').find('.skype').text(result[0].E_Skype);
                         $('.basic-information').find('.phone').text(result[0].E_Phone);
                         $('.basic-information').find('.address').text(result[0].E_Address);
                    }
                });
            });
        });
    </script>
@stop
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
                <p class="text-center" style="margin-top:20px;margin-bottom: -10px;color: #5F75B5"><i>{{ $project->P_Description }}</i></p>
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
                    <div class="cost-info view-feedback">
                        <p>Company: {{  App\Client_Company::find($client->idClientCompany)->CC_Name }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- PM -->
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
                    <div class="cost-info view-feedback">
                        <p>Cost/Hour: {{  '$'.$PM->E_Cost_Hour }}
                        <a href="javascript:void(0)" link="#modal-pm" class="pull-right open-feedback">View Feedback</a>
                        </p>
                        <div id="modal-pm" class="overlay">
                            <a href="javascript:void(0)" class="close-feedback">&times;</a>
                            <div class="overlay-content">
                            <?php
                            $feedbacks = App\Feedback::where('idEmployee','=',$PM->idEmployee)->where('idProject','=',$project->idProject)->get();
                            ?>
                            @if ($feedbacks->count() != 0)
                                @foreach ($feedbacks as $f)
                                    <div class="feedback-list">
                                    <h3 class="feedback-title"><i class="fa fa-comment" aria-hidden="true"></i>{{ $f->F_Title }} <span class="feedback-date">{{ $f->F_DateCreate }}</span></h3>
                                    <p class="feedback-rate">
                                    @for ($e = 0; $e < $f->F_Rate ; $e++)
                                    <img src="{{ asset('images/icon-star.png') }}">
                                    @endfor
                                    </p>
                                    <p class="feedback-content">{{ $f->F_Content }}</p>
                                </div>
                                @endforeach
                            @else
                                <h4 class="text-center">You do not have any feedback</h4>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Leader -->
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
                        <p>Cost/Hour: {{  '$'.$teamLeader->E_Cost_Hour }}
                        <a href="javascript:void(0)" link="#modal-leader" class="pull-right open-feedback">View Feedback</a>
                        </p>
                        <div id="modal-leader" class="overlay">
                            <a href="javascript:void(0)" class="close-feedback">&times;</a>
                            <div class="overlay-content">
                            <?php
                            $feedbacks = App\Feedback::where('idEmployee','=',$teamLeader->idEmployee)->where('idProject','=',$project->idProject)->get();
                            ?>
                            @if ($feedbacks->count() != 0)
                                @foreach ($feedbacks as $f)
                                    <div class="feedback-list">
                                    <h3 class="feedback-title"><i class="fa fa-comment" aria-hidden="true"></i>{{ $f->F_Title }} <span class="feedback-date">{{ $f->F_DateCreate }}</span></h3>
                                    <p class="feedback-rate">
                                    @for ($e = 0; $e < $f->F_Rate ; $e++)
                                    <img src="{{ asset('images/icon-star.png') }}">
                                    @endfor
                                    </p>
                                    <p class="feedback-content">{{ $f->F_Content }}</p>
                                </div>
                                @endforeach
                            @else
                                <h4 class="text-center">You do not have any feedback</h4>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Member -->
            @foreach ($team as $key=>$t)
            <div class="col-md-6">
                <div class="box-info">
                    <div class="main-info">
                        <img src="{{ asset('images/personal_images').'/'.$t->E_Avatar }}">
                        <div class="info">
                            <h4 class="lead">{{ $t->E_EngName }}</h4>
                            <h5 class="small"><i>Member</i></h5>
                            <br>
                            <p>Phone: {{ $t->E_Phone }}</p>
                            <p>Skype: {{ $t->E_Skype }}</p>
                        </div>
                    </div>
                    <div class="cost-info">
                        <p>Cost/Hour: {{'$'.$t->E_Cost_Hour }}
                        <a href="javascript:void(0)" link="#modal-member{{ $key }}" class="pull-right open-feedback">View Feedback</a>
                        </p>
                        <div id="modal-member{{ $key }}" class="overlay">
                            <a href="javascript:void(0)" class="close-feedback">&times;</a>
                            <div class="overlay-content">
                            <?php
                            $feedbacks = App\Feedback::where('idEmployee','=',$t->idEmployee)->where('idProject','=',$project->idProject)->get();
                            ?>
                            @if ($feedbacks->count() != 0)
                                @foreach ($feedbacks as $f)
                                    <div class="feedback-list">
                                    <h3 class="feedback-title"><i class="fa fa-comment" aria-hidden="true"></i>{{ $f->F_Title }} <span class="feedback-date">{{ $f->F_DateCreate }}</span></h3>
                                    <p class="feedback-rate">
                                    @for ($h = 0; $h < $f->F_Rate ; $h++)
                                    <img src="{{ asset('images/icon-star.png') }}">
                                    @endfor
                                    </p>
                                    <p class="feedback-content">{{ $f->F_Content }}</p>
                                </div>
                                @endforeach
                            @else
                                <h4 class="text-center">You do not have any feedback</h4>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@stop
@section('script')
<script type="text/javascript">
    $('.open-feedback').click(function function_name(argument) {
        var id = $(this).attr('link');
        $(id).css('width','100%');
    })
    $('.close-feedback').click(function(){
        var id = $(this).parent().attr('id');
        $('#'+id).css('width','0%');
    });
</script>
@stop
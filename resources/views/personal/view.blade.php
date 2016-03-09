@extends('layout.master')
@section('title','Personal Page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/view_personal.css') }}">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

@stop
@section('content')
        <div style="height: 20px"></div>
        <!-- .feature 1 contains Feedback, History Record, Personal Information -->
        <div class="row feature1">
            <div class="col-md-5 feedback_historyrecord">
            </div>
            <div class="col-md-7 personal-info">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">Personal Information <a href="{{ route('personal-information.edit',$employee->idEmployee) }}" class="pull-right"><span class="glyphicon glyphicon-pencil "></span></a></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 img-status">
                                    <div class="img"><img src="{{ asset('images/personal_images/') }}/{{$employee->E_Avatar}}"></div>
                                    <div class="status">
                                        <span class="glyphicon glyphicon-plane"></span>
                                        <span>Outside</span>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-9 basic-info">
                                    <h4><i>Basic Information</i></h4>
                                    <ul class="list-group basic-information">
                                        <li class="list-group-item">ID Employee: {{$employee->idEmployee}}</li>
                                        <li class="list-group-item">Name: {{$employee->E_Name}}</li>
                                        <li class="list-group-item">Skype: {{$employee->E_Skype}}</li>
                                        <li class="list-group-item">Phone: {{$employee->E_Phone}}</li>
                                        <li class="list-group-item">Address: {{$employee->E_Address}}</li>
                                    </ul>
                                    <h4><i>Technical Information</i></h4>
                                    <ul class="list-group tech-info">
                                        <li class="list-group-item skill">
                                        @foreach ($employee->Skill()->get() as $skill)
                                        <div class="detailed_skill">
                                                <div class="skill-name">{{ $skill->Skill}}</div>
                                                <div class="skill-star">
                                                    <div class="feedback-star">
                                                        <span class="pull-right">
                                                            @for($i = 0 ; $i < $skill->pivot->S_Rate; $i++)
                                                                <img src="{{ asset('images/star-on.svg') }}">

                                                            @endfor
                                                            @if($skill->pivot->S_Rate < 5)
                                                                @for ($j = 0; $j < 5- $skill->pivot->S_Rate ; $j++)
                                                                    <img src="{{ asset('images/star-off.svg') }}">
                                                                @endfor
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </li>
                                        <li class="list-group-item role">Role: {{$role_name}}</li>
                                        <li class="list-group-item cost_hour">Cost Hour: ${{$employee->E_Cost_Hour}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .feature 2 contains project information, statistic  -->
        
@stop
@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@stop
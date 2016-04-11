@extends('layout.master')
@section('title','Personal Page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/view_personal.css') }}">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

@stop
@section('content')
        <div id="img-title">
            <p>Personal Information</p>
        </div>
        <!-- .feature 1 contains Feedback, History Record, Personal Information -->
        <div class="row feature1">
            <div class="col-md-5">
                    <div class="panel panel-info history_feedback">
                        <div class="panel-heading">Feedback</div>
                        <div class="panel-body">
                            <table class="feedbacktable table .table-bordered">
                                <tbody>
                                    <tr class="short_feedback">
                                        <td>
                                            <p>
                                                <a href="#collapseOne" data-toggle="collapse" class="glyphicon glyphicon-chevron-down" aria-expanded="true" aria-controls="collapseOne"></a>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="feedback-title">You are a good developers. I love your job and your attitudes</div>
                                        </td>
                                        <td style="width: 100px;line-height: 50px">
                                            <span>
                                                <img src="{{ asset('images/icon-star.png') }}">
                                                <img src="{{ asset('images/icon-star.png') }}">
                                                <img src="{{ asset('images/icon-star.png') }}">
                                                <img src="{{ asset('images/icon-star.png') }}">
                                                <img src="{{ asset('images/icon-star.png') }}">
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="detailed_feedback">
                                        <td colspan="3">
                                            <div id="collapseOne" class="collapse">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <p>Client</p>
                                                        <p class="client_name"><i>CEO of Australia Out Sourcing Company</i></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>Project</p>
                                                        <p class="client_name"><i>Business Information Management System</i></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>Team</p>
                                                        <p class="client_name"><i>Balance Team</i></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>Date</p>
                                                        <p class="client_name"><i>26/02/2016</i></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="short_feedback">
                                        <td>
                                            <p>
                                                <a href="#collapseOne1" data-toggle="collapse" class="glyphicon glyphicon-chevron-down" aria-expanded="true" aria-controls="collapseOne"></a>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="feedback-title">You are a good developers. I love your job and your attitudes</div>
                                        </td>
                                        <td style="width: 100px;line-height: 50px">
                                            <span>
                                                <img src="{{ asset('images/icon-star.png') }}">
                                                <img src="{{ asset('images/icon-star.png') }}">
                                                <img src="{{ asset('images/icon-star.png') }}">
                                                <img src="{{ asset('images/icon-star.png') }}">
                                                <img src="{{ asset('images/icon-star.png') }}">
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="detailed_feedback">
                                        <td colspan="3">
                                            <div id="collapseOne1" class="collapse">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <p>Client</p>
                                                        <p class="client_name"><i>CEO of Australia Out Sourcing Company</i></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>Project</p>
                                                        <p class="client_name"><i>Business Information Management System</i></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>Team</p>
                                                        <p class="client_name"><i>Balance Team</i></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>Date</p>
                                                        <p class="client_name"><i>26/02/2016</i></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7 personal-info">
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
                                        <li class="list-group-item">Sex: {{$employee->E_Sex == 1 ?'Male' : 'Female'}}</li>
                                        <li class="list-group-item">Skype: {{$employee->E_Skype}}</li>
                                        <li class="list-group-item">Phone: 0{{$employee->E_Phone}}</li>
                                        <li class="list-group-item">Address: {{$employee->E_Address}}</li>
                                    </ul>
                                    <h4><i>Technical Information</i></h4>
                                    <ul class="list-group tech-info">
                                        <li class="list-group-item skill">
                                            @foreach ($employee->Skill()->get() as $skill)
                                                <div class="detailed_skill">
                                                    <div class="skill-name">{{ $skill->Skill}}</div>
                                                    <div class="skill-star pull-right">
                                                    <span><i>{{$skill->pivot->S_Rate}} {{$skill->pivot->S_Rate == 1 ? 'year' : 'years'}}</i></span>
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
        <!-- .feature 2 contains project information, statistic  -->
        <div class="row feature2">
            <div class="col-md-12 statistic">
                <div class="panel panel-info">
                    <div class="panel-heading">Statistic</div>
                    <div class="panel-body text-center">
                        <div class="col-md-6">
                            <div class="box" style="border: 1px solid #ccc;border-radius:10px;background: #ecf0f5;">
                                <h1 class="lead">Feedback</h1>
                                <hr>
                                <canvas id="lineChart" height="300" style="height:300px"></canvas>
                            </div>
                            <!-- <canvas id="lineChart" height="300" style="height:300px"></canvas> -->
                        </div>
                        <div class="col-md-6">
                            <div class="box" style="border: 1px solid #ccc;border-radius:10px;background: #ecf0f5;">
                                <h1 class="lead">English</h1>
                                <hr>
                                <canvas id="singleLine2" height="300" style="height:300px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row feature3">
                <div class="col-md-12 history_record">
                    <div class="panel panel-info">
                        <div class="panel-heading">History Record</div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Start day</th>
                                        <th>End day</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="action">Astro is moved to Business Information Management System project</td>
                                        <td class="start_day">26/02/2016</td>
                                        <td class="end_day">26/02/2016</td>
                                    </tr>
                                    <tr>
                                        <td class="action">Astro is moved to Business Information Management System project</td>
                                        <td class="start_day">26/02/2016</td>
                                        <td class="end_day">26/02/2016</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.min.js"></script>
<script>
    var data = {
        labels: ["February", "April", "June", "August", "October", 'December'],
        datasets: [{
            label: "Good feedback",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [4, 3, 2.5, 5, 4.5, 5]
        }]
    };
    var options = {

        ///Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,

        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth: 1,

        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,

        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,

        //Boolean - Whether the line is curved between points
        bezierCurve: true,

        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.4,

        //Boolean - Whether to show a dot for each point
        pointDot: true,

        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,

        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,

        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,

        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,

        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,

        //Boolean - Whether to fill the dataset with a colour
        datasetFill: true,

        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

    };
    var ctx = $("#lineChart").get(0).getContext("2d");
    var myLineChart = new Chart(ctx).Line(data, options);

    var data2 = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
        datasets: [{
            label: "Good feedback",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55,65, 59, 80, 81, 56, 55,]
        }]
    };
    var ctx2 = $("#singleLine2").get(0).getContext("2d");
    var myLineChart = new Chart(ctx2).Line(data2, options);
    </script>
@stop
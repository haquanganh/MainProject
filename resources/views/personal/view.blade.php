@extends('layout.master')
@section('title','Personal Page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/view_personal.css') }}">

@stop
@section('content')
    <div id="img-title">
        <p>Personal Information</p>
    </div>
    <!-- .feature 1 contains Feedback, History Record, Personal Information -->
    <div class="row feature1">
        <div class="col-md-5">
            <?php
                $feedbacks = App\Feedback::where('idEmployee','=',$employee->idEmployee)->get();
            ?>
            <div class="panel panel-info history_feedback panel-group">
                <div class="panel-heading">Feedback</div>
                <div class="panel-body">
                @if ($feedbacks->count() != 0)
                    @foreach ($feedbacks as $key=>$f)  
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="row" style="padding: 0!important;margin: 0!important;">
                        <div class="col-md-1" style="padding: 0">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key+1 }}"><i class="glyphicon glyphicon-collapse-down" ></i></a>
                        </div>
                        <div class="col-md-8" style="margin: 0;padding: 0">
                            <p>{{ $f->F_Title }}</p>
                        </div>
                        <div class="col-md-3 text-center" style="padding: 0";>
                            <span>
                                @for($i = 0 ;$i < $f->F_Rate; $i++)
                                    <img src="{{ asset('images/icon-star.png') }}">
                                @endfor
                            </span>
                        </div>
                        </div>
                      </div>
                      <div id="collapse{{ $key+1 }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h5>{{ $f->F_Content }}</h5>
                            <hr>
                            <div>
                                <span><i><b>Client</i></b></span>
                                <p>{{ App\Clients::find($f->idClient)->ClientName }}</p>
                            </div>
                            <div>
                                <span><i><b>Date</i></b></span>
                                <?php
                                    $date = new DateTime($f->F_DateCreate);
                                ?>
                                <p>{{ $date->format('Y-F-d') }}</p>
                            </div>
                            <div>
                                <span><i><b>Project</i></b></span>
                                <p>{{ App\Project::find($f->idProject)->P_Name }}</p>
                            </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                @else
                <i>{{ App\Employee::where('idAccount','=',Auth::user()->idAccount)->first()->E_EngName }}</i> hasn't had any feedback from Clients
                @endif
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
                                    <span>{{App\E_Status::find($employee->idStatus)->Status}}</span>
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
                            <h2 class="null-feedback" style="display: none">No data found</h2>
                            <hr>
                            <canvas id="lineChart" height="300" style="height:300px"></canvas>
                        </div>
                        <!-- <canvas id="lineChart" height="300" style="height:300px"></canvas> -->
                    </div>
                    <div class="col-md-6">
                        <div class="box" style="border: 1px solid #ccc;border-radius:10px;background: #ecf0f5;">
                            <h1 class="lead">English</h1>
                            <h2 class="null-english" style="display: none">No data found</h2>
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
                            <?php
                            $e_r = App\Employee_Record::where('idEmployee','=',$employee->idEmployee)->orderBy('DateStart','=','DESC')->get();
                            ?>
                                @foreach ($e_r as $e)
                                <?php
                                $sd = new DateTime($e->DateStart);
                                $ed = new DateTime($e->DateEnd);
                                $startday = $sd->format('m-F-Y');
                                $endday = $sd->format('m-F-Y');
                                ?>
                                    <tr>
                                    <td class="action">{{ $e->Content }}</td>
                                    <td class="start_day">{{ $startday }}</td>
                                    <td class="end_day">{{ !empty($e->DateEnd) ? $endday : 'Now'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@stop
@section('script')
<script src="{{ asset('third-library/chart-js/Chart.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url:'{{ url('chart') }}',
            type:'GET',
            cache: false,
            data:{},
            success: function(data){
                    var result = $.parseJSON(data);
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
                    if(result[0] == null){
                        $('.null-english').css('display','inline');
                        $('#singleLine2').css('height',247);
                    }
                    else{
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
                                 data: [result[0].Month01, result[0].Month02, result[0].Month03, result[0].Month04, result[0].Month05, result[0].Month06,result[0].Month07, result[0].Month08, result[0].Month09, result[0].Month10, result[0].Month11, result[0].Month12,]
                             }]
                         };
                        var ctx2 = $("#singleLine2").get(0).getContext("2d");
                        var myLineChart = new Chart(ctx2).Line(data2, options);
                    }
                    /*Feedback Chart*/
                    var sum = 0;
                    $.each(result[1], function(index, val){
                        sum = sum + val;
                    });
                    if(sum == 0){
                        $('.null-feedback').css('display','inline');
                        $('#lineChart').css('height',247);
                    }
                    else{
                        var list = [];
                        $.each(result[1], function(index, val) {
                             if(val == 0){
                                list.push(0);
                             }
                             else{
                                list.push(val.Average);
                             }
                        });
                        var data = {
                        labels: ["February", "April", "June", "August", "October", 'December'],
                        datasets: [{
                            label: "Good feedback",
                            fillColor: "#96D9D9",
                            strokeColor: "#52AFD0",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#A0C1B8",
                            pointHighlightFill: "#A0C1B8",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [list[0], list[1], list[2], list[3], list[4], list[5]]
                        }]
                        };
                    
                        var ctx = $("#lineChart").get(0).getContext("2d");
                        var myLineChart = new Chart(ctx).Line(data, options);
                    }  
            }
        });
    });
</script>
<script>
    

    
    
    </script>
@stop
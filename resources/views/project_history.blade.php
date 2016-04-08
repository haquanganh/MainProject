@extends('layout.master')
@section('title','Home page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/project_history.css') }}">
@stop
@section('content')
<div id="img-title">
                <p>Project History</p>
            </div>
            <div class="container">
                <ul class="timeline">
                @foreach ($projects as $key=>$p)
                    @if ($key%2 ==0 )
                    <li>
                        <div class="timeline-badge {{$p->idPStatus == 1 ? 'info' :'danger'}}"></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{{$p->P_Name}}</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{$p->P_DateStart}} - {{$p->P_DateFinish}} </small></p>
                                <p class="text-muted"><small>{{App\Clients::find($p->idClient)->ClientName}}</small></p>
                            </div>
                            <div class="timeline-body">
                                <p>{{$p->P_Note}}</p>
                            </div>
                        </div>
                    </li>
                    @elseif($key%2 != 0)
                    <li class="timeline-inverted">
                        <div class="timeline-badge {{$p->idPStatus == 1 ? 'info' :'danger'}}"></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{{$p->P_Name}}</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{$p->P_DateStart}} - {{$p->P_DateFinish}}</small></p>
                                <p class="text-muted"><small>{{App\Clients::find($p->idClient)->ClientName}}</small></p>
                            </div>
                            <div class="timeline-body">
                                <p>{{$p->P_Note}}</p>
                            </div>
                        </div>
                    </li>
                    @endif
                @endforeach
                </ul>
@stop
@section('script')
@stop
@extends('layout.master')
@section('title','Company Page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/view_company.css') }}">
@stop
@section('content')
<div id="info" class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body text-center">
			<p style="margin: auto;" class="fancy"><span><img style="width:100px;height: 100px" src="{{ asset('images/personal_images').'/'.$company->CC_Logo }}" alt=""></span></p>
			<h1>{{ $company->CC_Name }}</h1>
			<h4>{{ $company->CC_Description }}</h4>
			<hr>
			<h5 class="fancy"><span id="contact">Contact Information</span></h5>
			<h5>Address : CC_Address</h5>
			<h5>Skype : CC_Skype</h5>
			</div>
		</div>
	</div>
	<div class="col-md-12">
    <?php
        $clients = App\Clients::where('idClientCompany','=',$company->idClientCompany)->get();
    ?>
        @foreach ($clients as $c)
            <div class="col-md-6">
            <div class="box-info">
                <div class="main-info">
                    <img src="{{ asset('images/personal_images').'/'.$c->C_Avatar }}">
                    <div class="info">
                        <h4 class="lead">{{ $c->ClientName }}</h4>
                        <p>Phone: {{ $c->C_Phone }}</p>
                        <p>Email: {{ $c->ClientName.'@gmail.com' }}</p>
                        <p>Skype: skype</p>
                    </div>
                </div>
                <div class="cost-info">
                <?php
                    $projects = App\Project::where('idClient','=',$c->idClient)->orderBy('P_DateStart','DESC')->get();
                ?>
                    <p>Newest Project:
                    @foreach ($projects as $p)
                        {{ $p->P_Name }}
                    @endforeach
                    </p>
                </div>
            </div>
        </div>
        @endforeach
	</div>
@stop
@section('script')
@stop
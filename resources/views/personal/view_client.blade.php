@extends('layout.master')
@section('title','Personal Page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/view_client.css') }}">
@stop
@section('content')
	<div id="img-title">
	            <p>Personal Information</p>
	</div>
	<div id="basic-information" class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					Personal Information
				</div>
				<div class="panel-body">
				<?php
					$client_company = App\Client_Company::find($client->idClientCompany);
				?>
					<h4>Company Information</h4>
					<ul class="list-group basic-information">
	                    <li class="list-group-item"><span><i>Company's Name:</i></span></span> &nbsp;{{$client_company->CC_Name}}</li>
	                    <li class="list-group-item"><span><i>Company's Description:</i></span> &nbsp;{{$client_company->CC_Description}}</li>
	                    <li class="list-group-item"><span><i>Comapny's Skype:</i></span> &nbsp;{{$client_company->CC_Skype}}</li>
	                    <li class="list-group-item"><span><i>Company's Phone:</i></span> &nbsp;0{{$client_company->CC_Phone}}</li>
	                    <li class="list-group-item"><span><i>Company's Address:</i></span> &nbsp;{{$client_company->CC_Address}}</li>
	                    <li class="list-group-item"><span><i>Company's Email:</i></span> &nbsp;{{$client_company->CC_Email}}</li>
	                </ul>
					<h4>Representative</h4>
					<ul class="list-group basic-information representative">
	                    <li class="list-group-item"><span><i>Name:</i></span>&nbsp;{{$client->ClientName}}</li>
	                    <li class="list-group-item"><span><i>Email:</i></span>&nbsp;{{$client->C_Email}}</li>
	                    <li class="list-group-item"><span><i>Skype:</i></span>&nbsp;{{$client->C_Skype}}</li>
	                    <li class="list-group-item"><span><i>Phone:</i></span>&nbsp;0{{$client->C_Phone}}</li>
	                    <li class="list-group-item"><span><i>Address:</i></span>&nbsp;{{$client->C_Address}}</li>
				</div>
			</div>
		</div>
	</div>
	<?php
		$project = App\Project::where('idClient','=',$client->idClient)->first();
		$ds = new DateTime($project->P_DateStart);
		$datestart = $ds->format('Y-F-d');
		$dn = new DateTime($project->P_DateFinish);
		$datefinish = $dn->format('Y-F-d');
		$team = $project->Employee;
		$leader = App\Employee::find($project->idTeamLeader);
		$PM = App\Employee::find($project->idPManager);
	?>
	<div id="currentproject" class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
				Newest Project Information
				</div>
				<div class="panel-body">
					<div id="project-name" class="row">
						<p class="lead text-center">Business Information Management System</p>
						<p class="fancy text-center small"><span>{{ $datestart }} &nbsp;-&nbsp;{{ $datefinish }}</span></p>
					</div>
					<hr>
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
								<img src="{{ asset('images/personal_images').'/'.$leader->E_Avatar }}">
								<div class="info">
									<h4 class="lead">{{ $leader->E_EngName }}</h4>
									<h5 class="small"><i>Team Leader</i></h5>
									<br>
									<p>Phone: {{ $leader->E_Phone }}</p>
									<p>Skype: {{ $leader->E_Skype }}</p>
								</div>
							</div>
							<div class="cost-info">
								<p>Cost/Hour: {{  '$'.$leader->E_Cost_Hour }}</p>
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
		</div>
	</div>
	<?php
		$feedback = App\Feedback::where('idClient','=',$client->idClient)->orderBy('F_DateCreate','DESC')->get();
	?>
	<div id="history_feedback" class="row ">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					History Feedback
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>Project</th>
							<th>Employee</th>
							<th>Feedback Title</th>
							<th>Rate</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($feedback as $f)
						<tr class="custom-tooltip" data-toggle="tooltip" data-placement="bottom" title="{{ $f->F_Content }}">
							<td>{{ $f->F_DateCreate }}</td>
							<td>{{ App\Project::find($f->idProject)->P_Name }}</td>
							<td>{{ App\Employee::find($f->idEmployee)->E_EngName }}</td>
							<td>{{ $f->F_Title }}</td>
							<td>
							<span class="star">
							@for($i=0; $i < $f->F_Rate; $i++)
								<img src="{{ asset('images/icon-star.png') }}">
							@endfor
							</span>
							</td>
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
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
@stop
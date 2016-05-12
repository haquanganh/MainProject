@extends('layout.admin')
@section('title','Company Page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/view_company.css') }}">
@stop
@section('content')
<div id="info" class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body text-center">
			<p style="margin: auto;" class="fancy"><span><img style="width: 300px;" src="{{ asset('images/enclave_logo.png') }}" alt=""></span></p>
			<h1>Leading Our Sourcing Company of USA</h1>
			<h4>This is about a company of producing system software for universites</h4>
			<hr>
			<h5 class="fancy"><span id="contact">Contact Information</span></h5>
			<h5>Address : 123 Virgin, Orange Country District, LA, United States of America</h5>
			<h5>Skype : Company Skype</h5>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="box-info">
				<div class="main-info">
					<img src="{{ asset('images/user.png') }}">
					<div class="info">
						<h4 class="lead">ABC</h4>
						<p>Phone: 0123456789</p>
						<p>Email: client1@enclave.vn</p>
						<p>Skype: skype</p>
					</div>
				</div>
				<div class="cost-info">
					<p>Current Project: Project 1</p>
				</div>
			</div>
		</div>
		
	</div>
@stop
@section('script')
@stop
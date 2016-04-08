@extends('layout.master')
@section('title','Home page')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/team_management.css') }}">
@stop
@section('content')
<div id="img-title">
    <p>Dallas Team</p>
</div>
<div class="row">
    <div class="search-form">
        <form method="POST" action="{{ url('/employee-information') }}">
            {!! csrf_field() !!}
            <button class="btn btn-primary" type="submit" value="Search">
                <span class="glyphicon glyphicon-search"></span>
            </button>
            <input class="form-control" type="text"  name="search" placeholder="Enter Name, Skill or Cost/hour"></input>
            <select name="search-type" class="form-control select">
                <option value="Search by name">Search by name</option>
                <option value="Search by skill">Search by skill</option>
                <option value="Search by cost/hour">Search by cost/hour</option>
            </select>
            <div class="clear"></div>
        </form>
    </div>
</div>
<div class="row table-responsive">
    	<div class="col-md-12">
    		<table class="table table-striped table-bordered">
    			<thead>
    				<tr>
	    				<th>Avatar</th>
	    				<th>Name</th>
	    				<th>Date of birth</th>
	    				<th>Skype</th>
	    				<th>Phone</th>
	    				<th>Role</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
                        <td style="width:50px"><img class="img img-circle" src="{{ asset('images/user.png') }}"></td>
                        <td>Astro</td>
                        <td>02/03/1994</td>
                        <td>eureka.m0198</td>
                        <td>0906478808</td>
                        <td>Manager</td>
                    </tr>
                    <tr>
                        <td style="width:50px"><img class="img img-circle" src="{{ asset('images/user.png') }}"></td>
                        <td>Astro</td>
                        <td>02/03/1994</td>
                        <td>eureka.m0198</td>
                        <td>0906478808</td>
                        <td>Manager</td>
                    </tr>
                    <tr>
                        <td style="width:50px"><img class="img img-circle" src="{{ asset('images/user.png') }}"></td>
                        <td>Astro</td>
                        <td>02/03/1994</td>
                        <td>eureka.m0198</td>
                        <td>0906478808</td>
                        <td>Manager</td>
                    </tr>
                    <tr>
                        <td style="width:50px"><img class="img img-circle" src="{{ asset('images/user.png') }}"></td>
                        <td>Astro</td>
                        <td>02/03/1994</td>
                        <td>eureka.m0198</td>
                        <td>0906478808</td>
                        <td>Manager</td>
                    </tr>
                    <tr>
                        <td style="width:50px"><img class="img img-circle" src="{{ asset('images/user.png') }}"></td>
                        <td>Astro</td>
                        <td>02/03/1994</td>
                        <td>eureka.m0198</td>
                        <td>0906478808</td>
                        <td>Manager</td>
                    </tr>
                    <tr>
                        <td style="width:50px"><img class="img img-circle" src="{{ asset('images/user.png') }}"></td>
                        <td>Astro</td>
                        <td>02/03/1994</td>
                        <td>eureka.m0198</td>
                        <td>0906478808</td>
                        <td>Manager</td>
                    </tr>
    			</tbody>

    		</table>
        </div>
</div>
@stop
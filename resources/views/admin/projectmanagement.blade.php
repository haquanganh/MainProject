@extends('layout.admin')
@section('title','Project Management')
@section('name','Project Management')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/projectmanagement.css') }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#search-click').click(function(){
				$('#search').toggle(750);
			});
		});
	</script>
@stop
@section('content')
<div class="project-management">
	<div class="project-search">
		<input type="text" id="search" class="form-control" placeholder="Enter project name" style="display: none;"></input>
		<button type="button" id="search-click" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
	<div class="plus">		
		<a href="#Createproject"><img src="{{ url('images/add-icon.png') }}"></a>
	</div>
	</div>
	<div class="clear"></div>
	<div class="project-grid">
		 <ul>
		    <li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li>
		    <li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li><li><a href="#">
		    		<p><b>Business Information Management System</b></p>
		    		<br>
                    <p><i>2-Feb-2016 <span>-</span>2-Mar-2016</i></p>   
		    	</a>
		    </li>
		</ul>
	</div>	
</div>
@stop
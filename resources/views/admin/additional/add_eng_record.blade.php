@extends('layout.admin')
@section('title','Additional English Record')
@section('name','Additional English Record')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/add_eng_record.css') }}">

@stop
@section('content')
	<div class="eng-record-wrapper">
		<div class="eng-record-head">
			<label>Select employee: </label>
			<select class="form-control list-employee" name="employee">
				<option></option>
				@foreach ($list_E as $element)
					<option value="{{ $element->idEmployee }}">{{ $element->E_EngName }}</option>
				@endforeach
			</select>
		</div>
		<table class="table table-bordered english-record">
			<thead>
				<tr>
					<th>January</th>
					<th>February</th>
					<th>March</th>
					<th>April</th>
					<th>May</th>
					<th>June</th>
					<th>July</th>
					<th>August</th>
					<th>September</th>
					<th>October</th>
					<th>November</th>
					<th>December</th>
					<th>Year</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="13" style="text-align: center;">Data not found</td>
				</tr>
			</tbody>
		</table>
		<div class="update">
			<label>Update english's record:</label>
		</div>
		<div class="add-eng-record">
			<label>Month:</label>
			<select class="form-control month">
				<option value="Month01">January</option>
				<option value="Month02">February</option>
				<option value="Month03">March</option>
				<option value="Month04">April</option>
				<option value="Month05">May</option>
				<option value="Month06">June</option>
				<option value="Month07">July</option>
				<option value="Month08">August</option>
				<option value="Month09">September</option>
				<option value="Month10">October</option>
				<option value="Month11">November</option>
				<option value="Month12">December</option>
			</select>
			<div class="div-input">
				<label style="margin-left: 10px;">Year:</label>
				<input type="hidden" value="2016"></input>
				<input class="form-control year" type="number" value="2016" min="2000" max=""	onkeypress="validate_spec0(event)"></input>
			</div>
			<div class="div-input">
				<label style="margin-left: 10px;">Score:</label>
				<input class="form-control score" type="number" min="0" max="200" onkeypress="validate_spec0(event)"></input>
			</div>
			<button class="btn btn-default save-record" style="margin-top: -3px;">Save</button>
		</div>
	</div>
@stop
@section('script')
<script src="{{ asset('third-library/select2-4.0.2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
        $(".list-employee").select2({
        	placeholder: "Select a State",
  			allowClear: true
        });
        $(".month").select2({
        	placeholder: "Select a State",
  			allowClear: true
        });
    });
    $('.list-employee').change(function() {
    	var val = $(".list-employee option:selected").val();
    	var dataString = { 
	              employee : val,
	              _token : '{{ csrf_token() }}'
	        };
	   	$.ajax({
	   		type : "POST",
    		url: "{{ URL::to('admin/get-english-record') }}" ,
    		data : dataString,
    		dataType: "json",
            cache : false,
            success: function(data){
            	$('.english-record tbody tr').remove();	
            	console.log(data);
            	if(data == 'fail')
            	{
            		$('.english-record tbody').append('<tr><td colspan="13" style="text-align: center;">Data not found</td></tr>');	
            	}else
            	{
            		for(var i = 0; i < data.length; i++)
            		{
            			$('.english-record tbody').append('<tr><td>'+ data[i].Month01 +'</td><td>'+ data[i].Month02 +'</td><td>'+ data[i].Month03 +'</td><td>'+ data[i].Month04 +'</td><td>'+ data[i].Month05 +'</td><td>'+ data[i].Month06 +'</td><td>'+ data[i].Month07 +'</td><td>'+ data[i].Month08 +'</td><td>'+ data[i].Month09 +'</td><td>'+ data[i].Month10 +'</td><td>'+ data[i].Month11 +'</td><td>'+ data[i].Month12 +'</td><td><b>'+ data[i].Year +'</b></td></tr>');
            		}
            	}
            }

	   	});
	});
    $(document).on('click', '.save-record', function(){
    	var val = $(".list-employee option:selected").val();
    	var month = $(".month option:selected").val();
    	var year = $('.year').val();
    	var score = $('.score').val();
    	var currentTime = new Date();
    	console.log(currentTime.getYear() + 1900);
    	if(val == "")
    	{
    		alert('Please select a employee!');
    	} else if(month == null)
    	{
    		alert('Please select the month!');
    	}else if(year < 2000 || year > (currentTime.getYear() + 1900))
    	{
    		alert('The year must be more than 2000 and less than current time!')
    	}else if(score < 0 || score > 200 || score == "")
    	{
    		alert('The score must be between 0 and 200!')
    	}
    	else {
	    	var dataString = {
	    		employee : val,
	    		month : month,
	    		year : year,
	    		score: score,
		        _token : '{{ csrf_token() }}'
	    	};
	    	$.ajax({
		   		type : "POST",
	    		url: "{{ URL::to('admin/add-english-record') }}" ,
	    		data : dataString,
	    		dataType: "json",
	            cache : false,
	            success: function(data){
	            	if(data == 'fail')
	            	{
	            		alert('Something went wrong, please try again!');
	            	} else
	            	{
	            		alert('Successful!');
	            		$('.english-record tbody tr').remove();
	            		for(var i = 0; i < data.length; i++)
	            		{
	            			$('.english-record tbody').append('<tr><td>'+ data[i].Month01 +'</td><td>'+ data[i].Month02 +'</td><td>'+ data[i].Month03 +'</td><td>'+ data[i].Month04 +'</td><td>'+ data[i].Month05 +'</td><td>'+ data[i].Month06 +'</td><td>'+ data[i].Month07 +'</td><td>'+ data[i].Month08 +'</td><td>'+ data[i].Month09 +'</td><td>'+ data[i].Month10 +'</td><td>'+ data[i].Month11 +'</td><td>'+ data[i].Month12 +'</td><td><b>'+ data[i].Year +'</b></td></tr>');
	            		}
	            	}	
	            }
	        });
	    }
    });
	function validate_spec0(evt){
	    var theEvent = evt || window.event;
	    var key = theEvent.keyCode || theEvent.which;
	    key = String.fromCharCode( key );
	    var regex = /[0-9]/;
	    if( !regex.test(key) ) {
	        theEvent.returnValue = false;
	        if(theEvent.preventDefault) theEvent.preventDefault();
	    }
	}
</script>
@stop

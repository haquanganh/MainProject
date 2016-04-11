@extends('layout.admin')
@section('title','Stastics')
@section('name','Stastics')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/stastics.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
	<div class="row">
	<!-- Type of stastics -->
		<div class="pull-left choose">
			<select class="list list1">
				<option></option>
				<option value="1">Feedback</option>
				<option value="2">English</option>
			</select>
		</div>
		<a href="#" class="btn btn-primary pull-right">Get</a>
		<div class="clearfix"></div>
	</div>
	<div class="row">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>Avatar</th>
					<th>Name</th>
					<th>Skype</th>
					<th>Role</th>
					<th>Points</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td><img src="{{ asset('images/user.png') }}"></td>
					<td>Astro</td>
					<td>eureka.m0198</td>
					<td>Project Manager</td>
					<td>200</td>
				</tr>
				<tr>
					<td>2</td>
					<td><img src="{{ asset('images/user.png') }}"></td>
					<td>Astro</td>
					<td>eureka.m0198</td>
					<td>Project Manager</td>
					<td>200</td>
				</tr>
				<tr>
					<td>3</td>
					<td><img src="{{ asset('images/user.png') }}"></td>
					<td>Astro</td>
					<td>eureka.m0198</td>
					<td>Project Manager</td>
					<td>200</td>
				</tr>
				<tr>
					<td>4</td>
					<td><img src="{{ asset('images/user.png') }}"></td>
					<td>Astro</td>
					<td>eureka.m0198</td>
					<td>Project Manager</td>
					<td>200</td>
				</tr>
			</tbody>
		</table>
	</div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".list1").select2({
        	placeholder: "Select type of stastics",
        });
        $(".list2").select2({
        	placeholder: "Select top",
        });
        $(".list4").select2({
        	placeholder: "Select time",
        });
        
    });
</script>
<script>
	$(document).ready(function() {
		$('.list1').change(function(){
			var val = $(this).val();
			if(val == 1){
				if($('.choose').has('.list_points').length){
					$('.list_points').select2('destroy');
					$('.list_points').prop('disabled',true);
					$('.list_points').remove();

					$('.list_top').select2('destroy');
					$('.list_top').prop('disabled',true);
					$('.list_top').remove();

					$('.list_date').select2('destroy');
					$('.list_date').prop('disabled',true);
					$('.list_date').remove();

				}
				$('.choose').append('<select class="list list_stars"><option></option><option value="1">1 Star</option><option value="2">2 Stars</option><option value="3">3 Stars</option><option value="4">4 Stars</option><option value="5">5 Stars</option></select>');

				$(".list_stars").select2({
        			placeholder: "Select rate of stars",
        		});
        		$(document).ready(function() {
        			
					$('.list_stars').change(function(){
						if($('.choose').has('.list_top').length){
							$('.list_top').select2('destroy');
							$('.list_top').prop('disabled',true);
							$('.list_top').remove();

						}
						$('.choose').append('<select class="list list_top"><option></option><option value="5">5</option><option value="10">10</option><option value="20">20</option></select>');
							$(".list_top").select2({
			        			placeholder: "Select top",
			        		});
			        		$(document).ready(function(){
			        			$('.list_top').change(function(){
			        				if($('.choose').has('.list_date').length){
										$('.list_date').select2('destroy');
										$('.list_date').prop('disabled',true);
										$('.list_date').remove();

									}
			        				$('.choose').append('<select class="list list_date"><option></option><option value="5">5</option><option value="10">10</option><option value="20">20</option></select>');
			        					$(".list_date").select2({
						        			placeholder: "Select time",
						        		});
			        			});
			        		});
					});
				});
			}
			else{
				if($('.choose').has('.list_stars').length){
					$('.list_stars').select2('destroy');
					$('.list_stars').prop('disabled',true);
					$('.list_stars').remove();

					$('.list_top').select2('destroy');
					$('.list_top').prop('disabled',true);
					$('.list_top').remove();

					$('.list_date').select2('destroy');
					$('.list_date').prop('disabled',true);
					$('.list_date').remove();
				}
				$('.choose').append('<select class="list list_points"><option></option><option value="1">< 100 points</option><option value="2">100 - 120 points</option><option value="3">120 - 140 points</option><option value="4">140 - 160 points</option><option value="5">160 - 180 points</option><option value="5">> 180 points</option></select>');

				$(".list_points").select2({
        			placeholder: "Select range of points",
        		});
				$(document).ready(function() {
					$('.list_points').change(function(){
						if($('.choose').has('.list_top').length){
							$('.list_top').select2('destroy');
							$('.list_top').prop('disabled',true);
							$('.list_top').remove();
						}
						$('.choose').append('<select class="list list_top"><option></option><option value="5">5</option><option value="10">10</option><option value="20">20</option></select>');
							$(".list_top").select2({
			        			placeholder: "Select top",
			        		});
			        		$(document).ready(function(){
			        			$('.list_top').change(function(){
			        				if($('.choose').has('.list_date').length){
										$('.list_date').select2('destroy');
										$('.list_date').prop('disabled',true);
										$('.list_date').remove();

									}
			        				$('.choose').append('<select class="list list_date"><option></option><option value="5">5</option><option value="10">10</option><option value="20">20</option></select>');
			        					$(".list_date").select2({
						        			placeholder: "Select time",
						        		});
			        			});
			        		});
					});
				});
			}
		});
	});
</script>
<script>
</script>
@stop
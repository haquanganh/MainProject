@extends('layout.admin')
@section('title','Stastics')
@section('name','Stastics')
@section('css')
    

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/stastics.css') }}">
@stop
@section('content')
	<div class="top row">
	<!-- Type of stastics -->
		<div class="pull-left choose">
			<select class="list list1">
				<option></option>
				<option value="1">Feedback</option>
				<option value="2">English</option>
			</select>
		</div>
		<a id="Get" href="#" class="btn btn-primary pull-right">Get</a>
		<div class="clearfix"></div>
	</div>
	<div class="row data">
	</div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.js"></script>
<script>
		$(document).ready(function(){
			
	});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".list1").select2({
        	placeholder: "Select type of stastics",
        	minimumResultsForSearch: Infinity,
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

					$('#myDatepicker').remove();

				}
				$('.choose').append('<select class="list list_stars"><option></option><option value="1-2">1 Star - 2 Stars</option><option value="2-3">2 Stars -3 Stars</option><option value="3-4">3 Stars - 4 Stars</option><option value="4-5">4 Stars - 5 Stars</option></select>');

				$(".list_stars").select2({
        			placeholder: "Select rate of stars",
        			minimumResultsForSearch: Infinity,
        		});
        		$(document).ready(function() {
        			
					$('.list_stars').change(function(){
						if($('.choose').has('.list_top').length){
							$('.list_top').select2('destroy');
							$('.list_top').prop('disabled',true);
							$('.list_top').remove();
							$('#myDatepicker').remove();

						}
						$('.choose').append('<select class="list list_top"><option></option><option value="5">5</option><option value="10">10</option><option value="20">20</option></select>');
							$(".list_top").select2({
			        			placeholder: "Select top",
			        			minimumResultsForSearch: Infinity,
			        		});
			        		$(document).ready(function(){
			        			$('.list_top').change(function(){
			        				if($('.choose').has('#myDatepicker').length){
										$('#myDatepicker').remove();

									}
			        				$('.choose').append('<div class="input-group date" id="myDatepicker" data-provide="datepicker" data-date-format="mm-yyyy"><input id="time" type="text" class="form-control" name="date"><div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div></div>');
			        				$('#myDatepicker').datepicker({
									    format: "mm/yyyy",
									    startView: "year", 
									    minViewMode: "months"
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
				$('.choose').append('<select class="list list_points"><option></option><option value="0-100"><=100 points</option><option value="100-120">100 - 120 points</option><option value="120-140">120 - 140 points</option><option value="140-160">140 - 160 points</option><option value="160-180">160 - 180 points</option><option value="180-200">>= 180 points</option></select>');

				$(".list_points").select2({
        			placeholder: "Select range of points",
        			minimumResultsForSearch: Infinity,
        		});
				$(document).ready(function() {
					$('.list_points').change(function(){
						if($('.choose').has('.list_top').length){
							$('.list_top').select2('destroy');
							$('.list_top').prop('disabled',true);
							$('.list_top').remove();
							$('#myDatepicker').remove();
						}
						$('.choose').append('<select class="list list_top"><option></option><option value="5">5</option><option value="10">10</option><option value="20">20</option></select>');
							$(".list_top").select2({
			        			placeholder: "Select top",
			        			minimumResultsForSearch: Infinity,
			        		});
			        		$(document).ready(function(){
			        			$('.list_top').change(function(){
			        				if($('.choose').has('#myDatepicker').length){
										$('#myDatepicker').remove();

									}
			        				$('.choose').append('<div class="input-group date" id="myDatepicker" data-provide="datepicker" data-date-format="mm-yyyy"><input id="time" type="text" class="form-control" name="date"><div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div></div>');
			        				$('#myDatepicker').datepicker({
									    format: "mm/yyyy",
									    startView: "year", 
									    minViewMode: "months"
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
	$(document).ready(function(){

		$('#Get').click(function(){
			var check = $('.choose').children().length;
			if(check !=7 || $('#time').val() == ''){
				$('.alert-danger').remove();
				$('.choose').before('<div class="alert alert-danger">Please choose the full fill required.</div>');
			}
			else{
				var type = $('.list1').val();
				var time = $('#time').val();
				var top = $('.list_top').val();
				var detailed = 0;
				if(type == 1){
					detailed = $('.list_stars').val();
				}
				else{
					detailed = $('.list_points').val();
				}
				$.ajax({
					url:'{{ url('admin/get-top') }}',
					type:'GET',
					cache: false,
					data:{"type" : type , "time" : time, "top" : top, "detailed" : detailed},
					success: function(data){
						$('table').remove();
						$('table .text-center').remove();
						$('#warning').remove();
						if(data != 'Empty'){
							var result = $.parseJSON(data);
							$('.data').append('<table class="table table-striped"><thead><tr><th>No.</th><th>Avatar</th><th>Name</th><th>Skype</th><th>Points</th></tr></thead><tbody>');
							$.each(result[0],function(index, val){
								$('.table').append('<tr><td>'+(index+1)+'</td><td><img src="{{ asset('images/personal_images').'/' }}'+val.E_Avatar+'"></td><td>'+val.E_EngName+'</td><td>'+val.E_Skype+'</td><td>'+val.Point+'</td></tr>');
							});
							$('.data').append('</tbody></table>');
						}
						else{
							$('.data').append('<table class="text-center"><tbody><tr id="warning"><td colspan="5">Do not found data</td></tr></tbody</table>');
						}
					}
				});
			}
		setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 3000);
		});
	});
</script>
@stop
@extends('layout.admin')
@section('title','Additional Skill')
@section('name','Additional Skill')
@section('css')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/add_skill.css') }}">
@stop
@section('content')
	<div class="add-skill">
		<div class="add-button">
			<button class="btn btn-default" id="add-skill"><span class="fa fa-plus"></span> Add skill</button>
		</div>
		<div class="div-head">
			<label class="name">Skill name</label>
			<label class="describe">Describe</label>
		</div>
		<div class="form-add">
			<!-- <form class="form-add-skill" method="POST" action="">
			{!! csrf_field() !!}
					<input class="form-control skill-name" name="skill_name" required data-errormessage-value-missing="" data-errormessage-type-mismatch=""></input>
					<input class="form-control skill-desc" name="describe" required=""></input>
					<div class="form-button">
						<button class="btn btn-default" type="submit">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
						<button class="btn btn-default remove-skill" type="button">
							<span class="glyphicon glyphicon-remove"></span>
						</button>
					</div>
			</form> -->
		</div>
	</div>
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
	                <th width="15px">ID</th>
	                <th>Skill name</th>
	                <th>Describe</th>
	                <th>Edit</th>
	            </tr>
			</thead>
			<tbody>
				@foreach ($skill as $element)
					<tr>
						<td>{{ $element->idSkill }}</td>
						<td>{{ $element->Skill }}</td>
						<td>{{ $element->S_Note }}</td>
						<td>
							<a class="btn btn-default edit-skill" data-toggle="modal"><span class="glyphicon glyphicon-pencil"></span></a>
							<div class="modal fade modal-edit-skill">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Edit develop skill</h4>
										</div>
										<div class="modal-body">
											<label>Skill name:</label>
											<input class="form-control" name="edit-skill-name" style="width: 100%;" value="{{ $element->Skill }}"></input>
											<label>Describe:</label>
											<input class="form-control" name="edit-skill-describe" style="width: 100%;" value="{{ $element->S_Note }}"></input>
											<input type="hidden" name="idSkill" value="{{ $element->idSkill }}"></input>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary btn-edit-skill">Save</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
@stop
@section('script')

<script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-validate/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-validate/additional-methods.js') }}"></script>
    <script type="text/javascript">
    jQuery(function(){
        jQuery('#messages-click').click();
    });

    $(document).ready(function() {
        $('#table').DataTable();
        // $('#table').DataTable({
        //      "order": [[ 1, "desc" ]]
        // });
    });
    $(document).ready(function(){
    	$('.div-head').hide();
    	$('#add-skill').click(function(){
    		$('.div-head').show();
    		$('<form class="form-add-skill" method="POST" action="">' + 
    			'{!! csrf_field() !!}' +
					'<input class="form-control skill-name" name="skill_name" required></input>' +
					'<input class="form-control skill-desc" name="describe" required></input>' +
					'<div class="form-button">' +
						'<button class="btn btn-default add-skill-button" type="button">' +
							'<span class="glyphicon glyphicon-plus"></span>' +
						'</button>' +
						'<button class="btn btn-default remove-skill" type="button">' +
							'<span class="glyphicon glyphicon-remove"></span>' +
						'</button>' +
					'</div>' +
			'</form>').appendTo('.form-add');
    	});
    });

    $(document).on('click', '.remove-skill', function(){
    	$(this).parent().parent().remove();
    });
    $(document).on('click', '.add-skill-button', function(){
    	var x = $('.skill-name').val();
    	var y = $('.skill-desc').val();
    	if(x == null || x == "" || y == null || y == "")
    	{
    		alert('Please fill out all input field!');
    	} else
    	{
	    	var _skillname =  $(this).parent().parent().find("input[name='skill_name']").val();
	    	var _describe =  $(this).parent().parent().find("input[name='describe']").val();

	    	var dataString = { 
	              skill_name : _skillname,
	              describe : _describe,
	              _token : '{{ csrf_token() }}'
	        };
	    	$.ajax({
	    		type : "POST",
	    		url: "{{ URL::to('admin/add-skill') }}" ,
	    		data : dataString,
	    		dataType: "json",
	            cache : false,
	            success: function(data){
	            	if (data!= 'fail'){
	            		window.location.href = window.location;
	            		$('#table tbody').append('<tr><td>'+ data +'</td><td>'+ _skillname +'</td><td>'+ _describe +'</td><td><a class="btn btn-default edit-skill" data-toggle="modal"><span class="glyphicon glyphicon-pencil"></span></a><div class="modal fade modal-edit-skill"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">Edit develop skill</h4></div><div class="modal-body"><label>Skill name:</label><input class="form-control" name="edit-skill-name" style="width: 100%;" value="'+ _skillname +'"></input><label>Describe:</label><input class="form-control" name="edit-skill-describe" style="width: 100%;" value="'+ _describe +'"></input><input type="hidden" name="idSkill" value="'+ data +'"></input></div><div class="modal-footer"><button type="button" class="btn btn-primary btn-edit-skill">Save</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></div></div></div></div></td></tr>');
	            	} else{
	            		alert('Failed, please try again!');
	            	}
	            },
	            error: function(){
	            	alert('Failed, please try again!');
	            }
	    	});
	    	$(this).parent().parent().remove();
    	}
    });
    var trEdit = null;
    $(document).on('click', '.edit-skill', function(){
    	$(this).parent().find('.modal-edit-skill').modal();
    	trEdit = $(this).parent().parent();
    });
    $(document).on('click', '.btn-edit-skill', function(){
    	var idSkill = $(this).parent().parent().find("input[name='idSkill']").val();
    	var skill_name = $(this).parent().parent().find("input[name='edit-skill-name']").val();
    	var skill_des = $(this).parent().parent().find("input[name='edit-skill-describe']").val();
    	if(skill_name == "" || skill_des == "")
    	{
    		alert('Please fill out all inputs field!');
    		return false;
    	} else 
    	{
	    	var dataString = {
	    		idSkill: idSkill,
	    		skill_name : skill_name,
	    		skill_des : skill_des,
	    		_token : '{{ csrf_token() }}'
	    	};
	    	$.ajax({
	    		type : "POST",
	    		url: "{{ URL::to('admin/edit-skill') }}" ,
	    		data: dataString,
	    		dataType: "json",
	            cache : false,
	            success: function(data){
	            	if (data!= 'fail'){
	            		$(trEdit).empty().append('<td>'+ data.idSkill +'</td><td>'+ skill_name +'</td><td>'+ skill_des +'</td><td><a class="btn btn-default edit-skill" data-toggle="modal"><span class="glyphicon glyphicon-pencil"></span></a><div class="modal fade modal-edit-skill"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">Edit develop skill</h4></div><div class="modal-body"><label>Skill name:</label><input class="form-control" name="edit-skill-name" style="width: 100%;" value="'+ skill_name +'"></input><label>Describe:</label><input class="form-control" name="edit-skill-describe" style="width: 100%;" value="'+ skill_des +'"></input><input type="hidden" name="idSkill" value="'+ data.idSkill +'"></input></div><div class="modal-footer"><button type="button" class="btn btn-primary btn-edit-skill">Save</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></div></div></div></div></td>');
	            	} else{
	            		alert('Failed, please try again!');
	            	}
	            },
	            error: function(){
	            	alert('Failed, please try again!');
	            }
		    });     		
    	}
    	$('.modal').modal('hide');
    	$('.modal-backdrop').fadeOut();
    });
    </script>
@stop

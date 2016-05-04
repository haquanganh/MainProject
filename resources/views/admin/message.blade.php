@extends('layout.admin')
@section('title','Message')
@section('css')

@stop
@section('content')
<div id="messageContainer">
	<table class="table table-striped">
		<thead>
			<tr>
				<th style="width: 30px">#</th>
				<th>Sender</th>
				<th>Message</th>
				<th style="width: 160px">Date</th>
				<th style="width: 100px"></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$key = 0;
			?>
			@foreach($list_message as $idmessage)
				@if($idmessage->M_Status == 1)
				<tr>
					<td class="delete-style">{{ $key+1 }}</td>
					<td class="delete-style">{{ $idmessage->sender }}</td>
					<td class="delete-style">{{ $idmessage->content }}</td>
					<td class="delete-style">{{ $idmessage->dateSend }}</td>
					<td>
						<a href="#" class="btn btn-default ok-btn"><span class="glyphicon glyphicon-ok"></span></a>
						<a data-toggle="modal" href="#delete-id{{ $idmessage->idMessage }}" class="btn btn-default" id="remove-btn"><span class="glyphicon glyphicon-remove"></span></a>
						<input type="hidden" class="idMsg" value="{{ $idmessage->idMessage }}" placeholder="">
					</td>
				</tr>
				@else
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $idmessage->sender }}</td>
					<td>{{ $idmessage->content }}</td>
					<td>{{ $idmessage->dateSend }}</td>
					<td>
						<a href="#" class="btn btn-default ok-btn"><span class="glyphicon glyphicon-ok"></span></a>
						<a data-toggle="modal" href="#delete-id{{ $idmessage->idMessage }}" class="btn btn-default" id="remove-btn"><span class="glyphicon glyphicon-remove"></span></a>
						<input type="hidden" class="idMsg" value="{{ $idmessage->idMessage }}" placeholder="">
					</td>
				</tr>
				@endif
				<?php
					$key = $key+1;
				?>

				<!-- Delete note -->
	            <div class="modal fade" id="delete-id{{ $idmessage->idMessage }}">
	                <div class="modal-dialog">
	                    <div class="modal-content">
	                        <form action="{{ url('/delete-msg') }}" method="POST" accept-charset="utf-8">
	                            {{csrf_field()}}
	                            <div class="modal-body">
	                                <h4 class="modal-title">You really want to delete it, don't you? Are you sure?</h4>
	                                <input type="hidden" name="idmsg" value="{{ $idmessage->idMessage }}">
	                            </div>
	                            <div class="modal-footer">
	                                <div class="submit" style="float:right">
	                                    <input type="submit" class="btn btn-primary" value="Yes">
	                                    <a data-dismiss="modal" class="btn btn-default">No, thanks</a>
	                                </div>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
			@endforeach
		</tbody>
	</table>
</div>
<div class="modal fade" id="submit-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form action="{{ url('/send-message') }}" method="POST" accept-charset="utf-8" id="form-contact">
                {{csrf_field()}}
                    <textarea name="message" rows="8" cols="55" placeholder="Enter your message"></textarea>
                    <div class="change-pass-button modal-footer">
                        <input type="submit" name="button" id="save-button" class="btn btn-primary" value="Send"></input>
                    </div>
                </form>
			</div>

		</div>
	</div>
</div>
@stop
@section('script')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('#ct_msg').attr('readonly', true);
		    $('#ct_msg').addClass('input-disabled');
		});

		$(document).on('click', '.ok-btn', function(){
			var idMessage = $(this).parent().find('.idMsg').val();
			var dataString = {
				idMessage : idMessage,
				_token : '{{ csrf_token() }}'
			};
			$.ajax({
				type: 'POST',
				url: '/read-msg',
				data: dataString,
				dataType: 'json',
				cache: false,
				context: this,
				success: function(data){
					if(data == 'ok')
					{
						$(this).parent().parent().find("td").addClass("delete-style");
					} else {
						alert('doc roi');
					}
				}
			});
		});
	</script>
@stop
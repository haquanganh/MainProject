@extends('layout.admin')
@section('title','Message')
@section('css')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
@stop

<style type="text/css">
#messageContainer {
	margin-left: 25px;
    width:830px;
    height: 500px;
}
.scrollable{
 	float: left;
   	overflow-y: auto;
  	overflow-x: hidden;
   	width: 200px; /* adjust this width depending to amount of text to display */
   	height: 500px; /* adjust height depending on number of options to display */
   	border: 1px silver solid;
 }
.scrollable select{
   	border: none;
 }
.scrollable
{
   	height:500px;
   	background-color:white;
}
.scrollable::-webkit-scrollbar 
{
   	width: 8px;
}
.scrollable::-webkit-scrollbar-track 
{
   	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
   	border-radius:8px;
}
.scrollable::-webkit-scrollbar-thumb
{
   	background-color: #7f8c8d;
   	border-radius:8px;
}
.content {
	float: right;
	width: 630px;
	height: 500px;
	border: 1px silver solid;
}
.title-msg{
	height: inherit; 
	width: inherit; 
	list-style-type: none; 
	padding: 0;
}
.title-msg li{
	height: 40px;
	border-bottom: 1px solid #bdc3c7;
}
.title-msg li a:hover{
	background-color: #cfcfcf;
	text-decoration: none;
}
.title-msg li a{
	display: block;
	width: 100%;
	height: 100%;
	line-height: 40px; 
	padding-left: 10px;
}
</style>

@section('content')
<div id="messageContainer">
	<div class="scrollable">
		<ul class="title-msg">
		@foreach( $list_message as $idmessage )
		    <li>
		    	<a data-toggle="tab" href="#{{ $idmessage->idMessage }}">{{ $idmessage->sender }}</a>
		    </li>
		@endforeach
		</ul>		
	</div>

	<div class="content">
		<div class="tab-content">
			@foreach( $list_message as $idmessage )	
				<div id="{{ $idmessage->idMessage }}"  class="tab-pane fade">
					<textarea name="ct_msg" disabled="true" style="background-color:#FFF; width: 100%; height: 92.5%;">
						{{ $idmessage -> content}}
					</textarea>
				</div>
			@endforeach
		</div>
		<div class="footer"> 	
	        <div class="submit" style="float:right">
	            <input data-toggle="modal" href="#submit-id" type="submit" class="btn btn-primary" value="Submit">
	            <a href="/admin/message" class="btn btn-default">Reject</a>
	        </div>
    	</div>
	</div>
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
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script>
		$(document).ready(function() {

		    $('#ct_msg').attr('readonly', true);
		    $('#ct_msg').addClass('input-disabled');

		});
	</script>
@stop
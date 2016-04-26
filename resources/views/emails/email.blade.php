<?php 
	$idRole = Auth::user()->idRole;
?>
@if($idRole == 4)
Client {{ $hoten }} has sent a request to see a employee's information, click on this link:
<br>
	http://localhost:8000/admin/request-notify
@else
Employee {{ $hoten }} has sent a request to see a employee's information, click on this link:
<br>
	http://localhost:8000/admin/request-notify
@endif
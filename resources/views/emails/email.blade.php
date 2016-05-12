<?php 
	$idRole = Auth::user()->idRole;
?>
@if($idRole == 4)
Client {{ $hoten }} has sent a request to see a {{ $eName }}'s information, click on this link:
<br>
	<a href="{{ $link = url('/admin/request-notify') }}"> {{ $link }} </a>
@else
Employee {{ $hoten }} has sent a request to see a {{ $eName }}'s information, click on this link:
<br>
	<a href="{{ $link = url('/admin/request-notify') }}"> {{ $link }} </a>
@endif
@extends('layout.admin')
@section('title','History')
@section('name','History System')
@section('css')
@stop
@section('content')
<table class="table table-striped">
	<thead>
		<tr>
			<th>No.</th>
			<th>User</th>
			<th>Activity</th>
			<th>Time</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$histories = App\History::orderBy('H_DateCreate','DESC')->get();
	?>
	@if($histories->count() !=0)
		@foreach ($histories as $key=>$h)
		<tr>
		<?php
			$split = explode('.',$h->H_Content);
		?>
			<td>{{$key + 1}}</td>
			<td>{{App\User::find($h->idAccount)->email}}</td>
			<td>{{$split[0]}} <a href="{{ url('admin/project_detail') }}/{{$split[1]}}">{{App\Project::find($split[1])->P_Name}}</a></td>
			<td>{{$h->H_DateCreate}}</td>
		</tr>
	@endforeach
	@else
		<tr><td colspan="4">No data found</td></tr>
	@endif
	</tbody>
</table>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $('.system_history').addClass('active');
    });
</script>
@stop
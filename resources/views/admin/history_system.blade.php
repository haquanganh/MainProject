@extends('layout.admin')
@section('title','History')
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
						$histories = App\History::orderBy('H_DateCreate','DESC')->where('idType','=',1)->get();
						$count = -1;
					?>
					@foreach ($histories as $key=>$h)
					<?php
							$check = preg_match('/edit/',$h->H_Content) ? 'Yes' : 'No';
							$id_user = App\Project::find($h->idProject)->idPManager;
							$name_user =App\Employee::find($id_user)->E_EngName;
							$newest_project = App\Project::find(App\Project::find($h->idProject)->P_OldVersion);
							$date = App\Project::find($h->idProject)->P_DateCreate;

					?>
						<tr>
							<td>{{$key + 1}}</td>
							<td>{{$h->idAdmin == '' ? $name_user : (Auth::user()->idAccount == $h->idAdmin ? 'me' : 'Admin '.App\User::find($h->idAdmin)->email)}}</td>
							<?php
							?>
							<td>{{$h->H_Content}} <a href="{{ url('admin/project_detail') }}/{{!empty($newest_project) ? $newest_project->idProject :$h->idProject}}">{{!empty($newest_project) ? $newest_project->idProject : $h->idProject}}</a></td>
							<td>{{$date}}</td>
							@if ($check == 'Yes')
							<?php
								$count = $count + 1;
							?>
								<td><a href="{{ url('admin/project_old') }}/{{$count}}/{{$newest_project->idProject}}">Revision</a></td>
							@else
								<td></td>
							@endif
						</tr>
					@endforeach
					</tbody>
</table>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $('.historysystem').addClass('actived');
    });
</script>
@stop
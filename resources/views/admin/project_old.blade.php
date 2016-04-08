@extends('layout.admin')
@section('title','Project Management')
@section('name','Project Management')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/project_detail.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Date Edit</th>
                <th>User</th>
                <th>Field</th>
                <th>Changes</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $newest_project = App\Project::find($id);
            $newest_edit = App\Project::where('P_OldVersion','=',$id)->orderBy('P_DateCreate','DESC')->first();
        ?>
        @foreach ($project_olds as $key=>$p)
            <tr>
            <?php
                $idAdmin = App\History::where('idProject','=',$p->idProject)->first()->idAdmin;
            ?>
                <td>{{$p->P_DateCreate}}</td>
                <td>{{!empty($idAdmin) ? 'Admin '.App\User::find($idAdmin)->email: App\Employee::find($p->idPManager)->E_EngName}}</td>
                @if ($p->idProject == $newest_edit->idProject)
                <td>
                    @if ($p->P_Name != $newest_project->P_Name)
                            Project Name
                        @endif
                        @if ($p->idPManager != $newest_project->idPManager)
                            Manager<br>
                        @endif
                        @if ($p->idTeamLeader != $newest_project->idTeamLeader)
                            Team Leader<br>
                        @endif
                        @if ($p->idClient != $newest_project->idClient)
                            Client Name<br>
                        @endif
                        @if ($p->P_DateStart != $newest_project->P_DateStart)
                            DateStart<br>
                        @endif
                        @if ($p->P_DateFinish != $newest_project->P_DateFinish)
                            DateFinish<br>
                        @endif
                        @if ($p->idPStatus != $newest_project->idPStatus)
                            Project Status
                        @endif
                </td>
                <td>
                        @if ($p->P_Name != $newest_project->P_Name)
                            {{$p->P_Name}} => {{$newest_project->P_Name}}<br>
                        @endif
                        @if ($p->idPManager != $newest_project->idPManager)
                            {{App\Employee::find($p->idPManager)->E_EngName }} => {{App\Employee::find($newest_project->idPManager)->E_EngName}}<br>
                        @endif
                        @if ($p->idTeamLeader != $newest_project->idTeamLeader)
                            {{App\Employee::find($p->idTeamLeader)->E_EngName}} => {{App\Employee::find($newest_project->idTeamLeader)->E_EngName}}<br>
                        @endif
                        @if ($p->idClient != $newest_project->idClient)
                            {{App\Clients::find($p->idClient)->ClientName}} => {{App\Clients::find($newest_project->idClient)->ClientName}}<br>
                        @endif
                        @if ($p->P_DateStart != $newest_project->P_DateStart)
                            {{$p->P_DateStart}} => {{$newest_project->P_DateStart}}<br>
                        @endif
                        @if ($p->P_DateFinish != $newest_project->P_DateFinish)
                            {{$p->P_DateFinish}} => {{$newest_project->P_DateFinish}}<br>
                        @endif
                        @if ($p->idPStatus != $newest_project->idPStatus)
                            {{App\ProjectStatus::find($p->idPStatus)->P_Status}} => {{App\ProjectStatus::find($newest_project->idPStatus)->P_Status}}
                        @endif
                </td>
                @elseif($key == 0)
                <?php
                        $all = App\Project::where('P_OldVersion','=',$id)->orderBy('P_DateCreate','DESC')->get();
                        $newer_project = array();
                        for($i = 0 ; $i< count($all); $i++){
                            if($all[$i]->idProject == $p->idProject){
                                $newer_project =  $all[$i-1];
                            }
                        }
                ?>
                <td>
                    @if ($p->P_Name != $newer_project->P_Name)
                            Project Name<br>
                        @endif
                        @if ($p->idPManager != $newer_project->idPManager)
                            Manager<br>
                        @endif
                        @if ($p->idTeamLeader != $newer_project->idTeamLeader)
                            Team Leader<br>
                        @endif
                        @if ($p->idClient != $newer_project->idClient)
                            Client Name<br>
                        @endif
                        @if ($p->P_DateStart != $newer_project->P_DateStart)
                            Date Start<br>
                        @endif
                        @if ($p->P_DateFinish != $newer_project->P_DateFinish)
                            Date Finish<br>
                        @endif
                        @if ($p->idPStatus != $newer_project->idPStatus)
                            Project Status
                        @endif
                </td>
                <td>
                        @if ($p->P_Name != $newer_project->P_Name)
                            {{$p->P_Name}} => {{$newer_project->P_Name}}<br>
                        @endif
                        @if ($p->idPManager != $newer_project->idPManager)
                            {{App\Employee::find($p->idPManager)->E_EngName}} => {{App\Employee::find($newer_project->idPManager)->E_EngName}}<br>
                        @endif
                        @if ($p->idTeamLeader != $newer_project->idTeamLeader)
                            {{App\Employee::find($p->idTeamLeader)->E_EngName}} => {{App\Employee::find($newer_project->idTeamLeader)->E_EngName}}<br>
                        @endif
                        @if ($p->idClient != $newer_project->idClient)
                            {{App\Clients::find($p->idClient)->ClientName}} => {{App\Clients::find($newer_project->idClient)->ClientName}}<br>
                        @endif
                        @if ($p->P_DateStart != $newer_project->P_DateStart)
                            {{$p->P_DateStart}} => {{$newer_project->P_DateStart}}<br>
                        @endif
                        @if ($p->P_DateFinish != $newer_project->P_DateFinish)
                            {{$p->P_DateFinish}} => {{$newer_project->P_DateFinish}}<br>
                        @endif
                        @if ($p->idPStatus != $newer_project->idPStatus)
                            {{App\ProjectStatus::find($p->idPStatus)->P_Status}} => {{App\ProjectStatus::find($newer_project->idPStatus)->P_Status}}
                        @endif
                    </td>
                @elseif($p->P_Mark !=1)
                <td>
                        @if ($p->P_Name != $project_olds[$key-1]->P_Name)
                            Project Name<br>
                        @endif
                        @if ($p->idPManager != $project_olds[$key-1]->idPManager)
                            Manager<br>
                        @endif
                        @if ($p->idTeamLeader != $project_olds[$key-1]->idTeamLeader)
                            Team Leader<br>
                        @endif
                        @if ($p->idClient != $project_olds[$key-1]->idClient)
                            Client Name<br>
                        @endif
                        @if ($p->P_DateStart != $project_olds[$key-1]->P_DateStart)
                            Date Start<br>
                        @endif
                        @if ($p->P_DateFinish != $project_olds[$key-1]->P_DateFinish)
                            Date Finish<br>
                        @endif
                        @if ($p->idPStatus != $project_olds[$key-1]->idPStatus)
                            Project Status
                        @endif
                </td>
                <td>
                        @if ($p->P_Name != $project_olds[$key-1]->P_Name)
                            {{$p->P_Name}} => {{$project_olds[$key-1]->P_Name}}<br>
                        @endif
                        @if ($p->idPManager != $project_olds[$key-1]->idPManager)
                            {{App\Employee::find($p->idPManager)->E_EngName}} => {{App\Employee::find($project_olds[$key-1]->idPManager)->E_EngName}}<br>
                        @endif
                        @if ($p->idTeamLeader != $project_olds[$key-1]->idTeamLeader)
                            {{App\Employee::find($p->idTeamLeader)->E_EngName}} => {{App\Employee::find($project_olds[$key-1]->idTeamLeader)->E_EngName}}<br>
                        @endif
                        @if ($p->idClient != $project_olds[$key-1]->idClient)
                            {{App\Clients::find($p->idClient)->ClientName}} => {{App\Clients::find($project_olds[$key-1]->idClient)->ClientName}}<br>
                        @endif
                        @if ($p->P_DateStart != $project_olds[$key-1]->P_DateStart)
                            {{$p->P_DateStart}} => {{$project_olds[$key-1]->P_DateStart}}<br>
                        @endif
                        @if ($p->P_DateFinish != $project_olds[$key-1]->P_DateFinish)
                            {{$p->P_DateFinish}} => {{$project_olds[$key-1]->P_DateFinish}}<br>
                        @endif
                        @if ($p->idPStatus != $project_olds[$key-1]->idPStatus)
                            {{App\ProjectStatus::find($p->idPStatus)->P_Status}} => {{App\ProjectStatus::find($project_olds[$key-1]->idPStatus)->P_Status}}
                        @endif
                    </td>
                @elseif($p->P_Mark ==1)
                    <td></td>
                    <td>Created new project</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('script')
@stop
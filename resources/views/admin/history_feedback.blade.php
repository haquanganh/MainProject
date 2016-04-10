@extends('layout.admin')
@section('title','')
@section('css')
@stop
@section('content')
<?php
?>
<table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Client</th>
                            <th>Activity</th>
                            <th>Employee</th>
                            <th>Project</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $histories = App\Feedback_History::orderBy('H_DateCreate','DESC')->get();
                        $count = -1;
                    ?>
                    @foreach ($histories as $key=>$h)
                    <?php
                            $check = preg_match('/edit/',$h->H_Content) ? 'Yes' : 'No';
                            /*name client*/
                            $name_client =App\Clients::find($h->H_idClient)->ClientName;
                            /*name employee*/
                            $name_employee = App\Employee::find($h->H_idEmployee)->E_EngName;
                            $name_project = App\Project::find($h->H_idProject);
                    ?>
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$name_client}}</td>
                            <td>{{$h->H_Content}}</td>
                            <td>{{$name_employee}}</td>
                            <td><a href="{{ url('admin/project_detail') }}/{{$name_project->idProject}}">{{$name_project->P_Name}}</a></td>
                            <td>{{$h->H_DateCreate}}</td>
                            @if ($check == 'Yes')
                            <?php
                                $count = $count + 1;
                            ?>
                                <td><a href="{{ url('admin/feedback_old') }}/{{$count}}/{{$h->idFeedback}}">Revision</a></td>
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
        $('.historyfeedback').addClass('actived');
    });
</script>
@stop
@extends('layout.admin')
@section('title','Feedback History')
@section('name','Feedback History')
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
            <th>Revision</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $histories = App\Feedback_History::orderBy('H_DateCreate','DESC')->get();
        $count = 0;
    ?>
    @if ($histories->count() != 0)
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
            <td>{{$h->H_Content.' '.$h->idFeedback}}</td>
            <td>{{$name_employee}}</td>
            <td><a href="{{ url('admin/project_detail') }}/{{$name_project->idProject}}">{{$name_project->P_Name}}</a></td>
            <td>{{$h->H_DateCreate}}</td>
            @if ($check == 'Yes')
            <?php
                $count = $count + 1;
                $feedbacks = App\Feedback_History::where('idFeedback','=',$h->idFeedback)->orderBy('H_DateCreate','DESC')->get();
                foreach ($feedbacks as $key => $f) {
                    if($f == $h){
                        $count = $key;
                    }
                }
            ?>
                <td><a href="{{ url('admin/feedback_old') }}/{{$count}}/{{$h->idFeedback}}">Revision</a></td>
            @else
                <td></td>
            @endif
        </tr>
    @endforeach
    @else
        <tr><td colspan="7">No data found</td></tr>
    @endif
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
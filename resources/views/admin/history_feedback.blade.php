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
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $histories = App\History::orderBy('H_DateCreate','DESC')->where('idType','=',2)->get();
                        $count = -1;
                    ?>
                    @foreach ($histories as $key=>$h)
                    <?php
                            $check = preg_match('/edit/',$h->H_Content) ? 'Yes' : 'No';
                            $id_client = App\Feedback::find($h->idFeedback)->idClient;
                            $name_client =App\Clients::find($id_client)->ClientName;
                            $id_employee = App\Feedback::find($h->idFeedback)->idEmployee;
                            $name_employee = App\Employee::find($id_employee)->E_EngName;
                            $newest_feedback = App\Feedback::find(App\Feedback::find($h->idFeedback)->F_OldVersion);
                            $date = App\Project::find($h->idFeedback)->P_DateCreate;
                    ?>
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$name_client}}</td>
                            <td>{{$h->H_Content}} <a href="{{ url('admin/feedback_detail') }}/{{!empty($newest_feedback) ? $newest_feedback->idProject :$h->idFeedback}}">{{!empty($newest_feedback) ? $newest_feedback->idFeedback : $h->idFeedback}}</a> for</td>
                            <td>{{$name_employee}}</td>
                            <td>{{$h->H_DateCreate}}</td>
                            @if ($check == 'Yes')
                            <?php
                                $count = $count + 1;
                            ?>
                                <td><a href="{{ url('admin/feedback_old') }}/{{$count}}/{{$newest_feedback->idFeedback}}">Revision</a></td>
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
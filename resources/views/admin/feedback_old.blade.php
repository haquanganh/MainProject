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
            $newest_feedback = App\Feedback::find($id);
            $newest_edit = App\Feedback::where('F_OldVersion','=',$id)->orderBy('F_DateCreate','DESC')->first();
        ?>
        @foreach ($Feedback_olds as $key=>$f)
            <tr>
            <?php
                $idAdmin = App\History::where('idFeedback','=',$f->idFeedback)->first()->idAdmin;
            ?>
                <td>{{$f->F_DateCreate}}</td>
                <td>{{!empty($idAdmin) ? 'Admin '.App\User::find($idAdmin)->email: App\Clients::find($f->idClient)->ClientName}}</td>
                @if ($f->idFeedback == $newest_edit->idFeedback)
                <td>
                        @if ($f->F_Content != $newest_feedback->F_Content)
                            Feedback Title<br>
                        @endif
                        @if ($f->F_Rate != $newest_feedback->F_Rate)
                            Feedback Rate
                        @endif
                        @if ($f->F_DateCreate != $newest_feedback->F_DateCreate)
                            DateStart<br>
                        @endif
                </td>
                <td>
                        @if ($f->F_Content != $newest_feedback->F_Content)
                            {{$f->F_Content}} => {{$newest_feedback->F_Content}}<br>
                        @endif
                        @if ($f->F_Rate != $newest_feedback->F_Rate)
                            {{$f->F_Rate}} => {{$newest_feedback->F_Rate}}<br>
                        @endif
                </td>
                @elseif($key == 0)
                <?php
                        $all = App\Feedback::where('F_OldVersion','=',$id)->orderBy('F_DateCreate','DESC')->get();
                        $newer_Feedback = array();
                        for($i = 0 ; $i< count($all); $i++){
                            if($all[$i]->idFeedback == $f->idFeedback){
                                $newer_Feedback =  $all[$i-1];
                            }
                        }
                ?>
                <td>
                        @if ($f->F_Content != $newer_Feedback->F_Content)
                            Feedback Title<br>
                        @endif
                        @if ($f->F_Rate != $newest_feedback->F_Rate)
                            Feedback Rate
                        @endif
                </td>
                <td>
                        @if ($f->F_Content != $newer_Feedback->F_Content)
                            {{$f->F_Content}} => {{$newer_Feedback->F_Content}}<br>
                        @endif
                        @if ($f->F_Rate != $newest_feedback->F_Rate)
                            {{$f->F_Rate}} => {{$newer_Feedback->F_Rate}}<br>
                        @endif
                    </td>
                @elseif($f->F_Mark !=1)
                <td>
                        @if ($f->F_Content != $Feedback_olds[$key-1]->F_Content)
                            Feedback Title<br>
                        @endif
                        @if ($f->F_Rate != $Feedback_olds[$key-1]->F_Rate)
                            Feedback Rate
                        @endif
                </td>
                <td>
                        @if ($f->F_Content != $Feedback_olds[$key-1]->F_Content)
                            {{$f->F_Content}} => {{$Feedback_olds[$key-1]->F_Content}}<br>
                        @endif
                        @if ($f->F_Rate != $Feedback_olds[$key-1]->F_Rate)
                            {{$f->F_Rate}} => {{$Feedback_olds[$key-1]->F_Rate}}<br>
                        @endif
                    </td>
                @elseif($f->F_Mark ==1)
                    <td></td>
                    <td>Created new feedback</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('script')
@stop
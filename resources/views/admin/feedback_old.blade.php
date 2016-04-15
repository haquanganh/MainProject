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
                <th>Edit Date</th>
                <th>Fields</th>
                <th>Changes</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($histories as $key=>$h)
        <tr>
            <td>{{$h->H_DateCreate}}
            @if($h != $histories[count($histories)-1])
            <td>
                @if ($h->H_newTitle != $histories[$key+1]->H_newTitle)
                Feedback Title<br>
                @endif
                @if ($h->H_newContent != $histories[$key+1]->H_newContent)
                Feedback Content<br>
                @endif
                @if ($h->H_newRate != $histories[$key+1]->H_newRate)
                Feedback Rate<br>
                @endif
            </td>
            @else
            <td>Create Project</td>
            @endif

            @if($h != $histories[count($histories)-1])
            <td>
                @if ($h->H_newTitle != $histories[$key+1]->H_newTitle)
                {{$histories[$key+1]->H_newTitle}}&nbsp;<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;{{$h->H_newTitle  }}<br>
                @endif
                @if ($h->H_newContent != $histories[$key+1]->H_newContent)
                {{$histories[$key+1]->H_newContent}}&nbsp;<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;{{$h->H_newContent  }}<br>
                @endif
                @if ($h->H_newRate != $histories[$key+1]->H_newRate)
                {{$histories[$key+1]->H_newRate}}   &nbsp;<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;{{$h->H_newRate  }}<br>
                @endif
            </td>
            @else
            <td>Create Project</td>
            @endif
        </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('script')
@stop
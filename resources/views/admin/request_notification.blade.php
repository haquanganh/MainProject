@extends('layout.admin')
@section('title','Notification Board')
@section('name','Notification Board')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">

    <style type="text/css">
        #table{
            font-size: 13.5px;
        }
        #table tbody tr td{
            line-height: 34px;
        }
        .form-confirm{
            width: 90px;
            margin: auto;
        }
        .form-confirm button{
            width: 40px;
            height: 34px;
        }
        .no-sort::after { display: none!important; }
        .no-sort { pointer-events: none!important; cursor: default!important; }
    </style>
@stop
@section('content')
    
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Content</th>
                <th width="100px">Send time</th>
                <th width="100px">Response time</th>
                <th >Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($list_requestC_E as $listrequest)
            <tr>
                <td>Client {{ App\Clients::find($listrequest->idClient)->ClientName }}
                    has sent request to see information of employee 
                    {{ App\Employee::find($listrequest->idEmployee2)->E_EngName }}
                </td>
                <td>{{ $listrequest->dateCreate }}</td>
                <td>{{ $listrequest->responseTime }}</td>
                <td>
                    @if ($listrequest->status == 1)
                        <div style="text-align: center;"><label>Accepted</label></div>
                    @elseif ($listrequest->status == 2)
                        <div style="text-align: center;"><label>Rejected</label></div> 
                    @else 
                        <div class="form-confirm">
                            <form method="POST" action="{{ url('/admin/request-notify-C_E') }}/{{ $listrequest->idRequest }}" >
                            {!! csrf_field() !!}
                                <button type="button" class="btn btn-default accept">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </button>
                                    <div class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 class="modal-title">Are you sure?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" name="yes-accept" class="btn btn-primary yes-accept" value="Yes"></input>
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="No"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <button type="button" class="btn btn-default reject">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                                    <div class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 class="modal-title">Are you sure?</h3>
                                                </div>
                                                <!-- <div class="modal-body">
                                                    <label>Reason:</label>
                                                    <textarea class="form-control" name="reason" style="display: block; width: 100%;"></textarea>
                                                </div> -->
                                                <div class="modal-footer">
                                                    <input type="submit" name="yes-reject" class="btn btn-primary yes-reject" value="Yes"></input>
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="No"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    @endif   
                </td>
            </tr>
        @endforeach
        @foreach ($list_requestE_E as $listrequest)
            <tr>
                <td>Employee {{ App\Employee::find($listrequest->idEmployee1)->E_EngName }}
                    has sent request to see information of employee 
                    {{ App\Employee::find($listrequest->idEmployee2)->E_EngName }}
                </td>
                <td>{{ $listrequest->dateCreate }}</td>
                <td>{{ $listrequest->responseTime }}</td>
                <td>
                    @if ($listrequest->status == 1)
                        <div style="text-align: center;"><label>Accepted</label></div>
                    @elseif ($listrequest->status == 2)
                        <div style="text-align: center;"><label>Rejected</label></div> 
                    @else 
                        <div class="form-confirm">
                            <form method="POST" action="{{ url('/admin/request-notify-E_E') }}/{{ $listrequest->idRequestE_E }}" >
                            {!! csrf_field() !!}
                                <button type="button" class="btn btn-default accept">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </button>
                                    <div class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 class="modal-title">Are you sure?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" name="yes-accept" class="btn btn-primary yes-accept" value="Yes"></input>
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="No"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <button type="button" class="btn btn-default reject">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                                    <div class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 class="modal-title">Are you sure?</h3>
                                                </div>
                                                <!-- <div class="modal-body">
                                                    <label>Reason:</label>
                                                    <textarea class="form-control" name="reason" style="display: block; width: 100%;"></textarea>
                                                </div> -->
                                                <div class="modal-footer">
                                                    <input type="submit" name="yes-reject" class="btn btn-primary yes-reject" value="Yes"></input>
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="No"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    @endif   
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
     <!-- Message after response request -->
    @if(Session::has('messages'))            
        <a data-toggle="modal" id="messages-click" href='#messages'></a>
        <div class="modal fade" id="messages">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                            {{Session::get('messages')}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop
@section('script')

<script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
    jQuery(function(){
        jQuery('#messages-click').click();
    });

    $(document).ready(function() {
        $('#table').DataTable({
             "order": [[ 1, "desc" ]]
        });
    });

    $(document).on('click', '.accept', function(){
        $(this).next('div').modal();
    });

    $(document).on('click', '.reject', function(){
        $(this).next('div').modal();
    });
    </script>
@stop
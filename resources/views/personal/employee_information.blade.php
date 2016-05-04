@extends('layout.master')
@section('title','Employee Information')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/employee_information.css') }}">
@stop
@section('content')
    <div id="img-title">
        <p>Employee Information</p>
    </div>
        <!-- Search test -->
        <!-- <div class="search-form ui-widget">
            <form method="POST" action="{{ url('/employee-information') }}">
                {!! csrf_field() !!}
                <button class="btn btn-primary" type="submit" value="Search">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
                <input class="form-control" type="text"  id="search" name="search" value=""></input>
                <?php
                    $id_Role = Auth::user()->idRole;
                ?>
                <select name="search-type" class="form-control select">
                    <option value="Search by name">Search by name</option>
                    <option value="Search by skill">Search by skill</option>
                    @if($id_Role == 4)
                        <option value="Search by cost/hour">Search by cost/hour</option>
                    @endif
                </select>
                <div class="clear"></div>
            </form>
        </div> -->
    @if (isset($message))
        <div style="text-align: center; font-size: 20px; color: black; margin-top: 20px;">
            {{ $message }}
        </div>
    @endif

    <div class="table-responsive" style="padding: 20px;">
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Date of birth</th>
                    <th>Skype</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>View more</th>
                    <th>View feedbacks</th>
                </tr>
            </thead>
            @if (isset($list_search))
                <tbody>
                @for ($i = 0; $i < sizeof($list_search); $i++)
                        <tr>
                            <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{ $list_search[$i]['avatar']}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                            <td>{{ $list_search[$i]['name']}}</td>
                            <td>{{ $list_search[$i]['dob']}}</td>
                            <td>{{ $list_search[$i]['skype']}}</td>
                            <td>{{ $list_search[$i]['phone']}}</td>
                            <td>{{ $list_search[$i]['role']}}</td>
                            <td style="width: 100px; text-align: center;">
                                @if($list_search[$i]['status'] == 1)
                                    <a class="btn btn-default" href="{{ url('/send-request') }}/{{ $list_search[$i]['idEmployee'] }}" style="width: 40px;height: 30px;"><span class="glyphicon glyphicon glyphicon-eye-open"></span></a>
                                @elseif($list_search[$i]['status'] == 2)
                                    Rejected
                                @elseif($list_search[$i]['status'] == 0)
                                    Pending
                                @elseif($list_search[$i]['status'] == 3)
                                    <a data-toggle="modal" href='#modal-send-request{{ $list_search[$i]['idEmployee'] }}' style="width: 40px;height: 30px;">Send request</a>
                                    <!-- Send request -->
                                    <div class="modal fade" id="modal-send-request{{ $list_search[$i]['idEmployee'] }}">
                                        <form method="POST" action="{{ url('/access-request') }}/{{ $list_search[$i]['idEmployee'] }}">
                                        {!! csrf_field() !!}
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">
                                                            Send request to Administrator to see this employee's information.
                                                        </h4>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: -465px;">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </td>
                            <td><a href="javascript:void(0)" class="open-feedback" link="#modal-member{{ $i }}">View feedbacks</a></td>
                            <!-- Feedback -->
                            <div id="modal-member{{ $i }}" class="overlay">
                                <a href="javascript:void(0)" class="close-feedback">&times;</a>
                                <div class="overlay-content">
                                <?php
                                $feedbacks = App\Feedback::where('idEmployee','=', $list_search[$i]['idEmployee'])->get();
                                ?>
                                @if ($feedbacks->count() != 0)
                                    @foreach ($feedbacks as $f)
                                        <div class="feedback-list">
                                        <h3 class="feedback-title"><i class="fa fa-comment" aria-hidden="true"></i>{{ $f->F_Title }} <span class="feedback-date">{{ $f->F_DateCreate }}</span></h3>
                                        <p class="feedback-rate">
                                        @for ($h = 0; $h < $f->F_Rate ; $h++)
                                        <img src="{{ asset('images/icon-star.png') }}">
                                        @endfor
                                        </p>
                                        <p class="feedback-content">{{ $f->F_Content }}</p>
                                    </div>
                                    @endforeach
                                @else
                                    <h4 class="text-center">You do not have any feedback</h4>
                                @endif
                                </div>
                            </div>
                            <!-- End feedback -->
                        </tr>
                    @endfor
                </tbody>

             @else

                <tbody>
                    @for ($i = 0; $i < sizeof($kq); $i++)
                        <tr>
                            <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{ $kq[$i]['avatar']}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                            <td>{{ $kq[$i]['name']}}</td>
                            <td>{{ $kq[$i]['dob']}}</td>
                            <td>{{ $kq[$i]['skype']}}</td>
                            <td>{{ $kq[$i]['phone']}}</td>
                            <td>{{ $kq[$i]['role']}}</td>
                            <td style="width: 100px; text-align: center;">
                                @if($kq[$i]['status'] == 1)
                                    <a class="btn btn-default" href="{{ url('/access-request') }}/{{ $kq[$i]['idEmployee'] }}" style="width: 40px;height: 30px;"><span class="glyphicon glyphicon glyphicon-eye-open"></span></a>
                                @elseif($kq[$i]['status'] == 2)
                                    Rejected
                                @elseif($kq[$i]['status'] == 0)
                                    Pending
                                @elseif($kq[$i]['status'] == 3)
                                    <a data-toggle="modal" href='#modal-send-request{{ $kq[$i]['idEmployee'] }}' style="width: 40px;height: 30px;">Send request</a>
                                    <!-- Send request -->
                                    <div class="modal fade" id="modal-send-request{{ $kq[$i]['idEmployee'] }}">
                                        <form method="POST" action="{{ url('/send-request') }}/{{ $kq[$i]['idEmployee'] }}">
                                        {!! csrf_field() !!}
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">
                                                            Send request to Administrator to see this employee's information.
                                                        </h4>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: -465px;">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </td>
                            <td><a href="javascript:void(0)" class="open-feedback" link="#modal-member{{ $i }}">View feedbacks</a></td>
                            <!-- Feedback -->
                            <div id="modal-member{{ $i }}" class="overlay">
                                <a href="javascript:void(0)" class="close-feedback">&times;</a>
                                <div class="overlay-content">
                                <?php
                                $feedbacks = App\Feedback::where('idEmployee','=', $kq[$i]['idEmployee'])->get();
                                ?>
                                @if ($feedbacks->count() != 0)
                                    @foreach ($feedbacks as $f)
                                        <div class="feedback-list">
                                        <h3 class="feedback-title"><i class="fa fa-comment" aria-hidden="true"></i>{{ $f->F_Title }} <span class="feedback-date">{{ $f->F_DateCreate }}</span></h3>
                                        <p class="feedback-rate">
                                        @for ($h = 0; $h < $f->F_Rate ; $h++)
                                        <img src="{{ asset('images/icon-star.png') }}">
                                        @endfor
                                        </p>
                                        <p class="feedback-content">{{ $f->F_Content }}</p>
                                    </div>
                                    @endforeach
                                @else
                                    <h4 class="text-center">You do not have any feedback</h4>
                                @endif
                                </div>
                            </div>
                            <!-- End feedback -->
                        </tr>
                    @endfor
                </tbody>
            @endif
        </table>
    </div>
    <!-- Message after send request -->
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
        $('#table').DataTable();
        $('#table_filter label').hide();

        $('<div class="search-form ui-widget"><form method="POST" action="{{ url("/employee-information") }}">{!! csrf_field() !!}<button class="btn btn-primary" type="submit" value="Search"><span class="glyphicon glyphicon-search"></span></button><input class="form-control" type="text"  id="search" name="search" value="@if(isset($searches)){{ $searches }}@endif"></input><?php $id_Role = Auth::user()->idRole;?><select name="search-type" class="form-control select">@if (isset($search_type))<option id="search_type"value="{{ $search_type }}">{{ $search_type }}</option>@endif<option value="Search by name">Search by name</option><option value="Search by skill">Search by skill</option></select><div class="clear"></div></form></div>').appendTo('#table_filter');

        $('#table_filter select').hover(function() {
            $('#search_type').hide();
        });
        @if($id_Role == 4)
        $('<option value="Search by cost/hour">Search by cost/hour</option>').appendTo('#table_filter select');
        @endif
    });
</script>
<script type="text/javascript">
    $('.open-feedback').click(function function_name(argument) {
        var id = $(this).attr('link');
        $(id).css('width','100%');
    })
    $('.close-feedback').click(function(){
        var id = $(this).parent().attr('id');
        $('#'+id).css('width','0%');
    });
</script>
@stop
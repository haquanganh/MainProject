@extends('layout.admin')
@section('title','Edit Project')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/edit_project.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}" rel="stylesheet" />
@stop
@section('content')
            <div class="clear40" style="height: 20px;"></div>
            <form class="form-inline" role="form" method="POST" action="{{ url('/admin/project/edit') }}/{{$project->idProject}}">
            {{csrf_field()}}
                <div class="info row text-center" style="margin-bottom: 10px">
                    <div class="col-md-3 form-group {{ $errors->has('in_PName') ? ' has-error' : '' }} validate"  {!! $errors->has('in_PName') ? ' data-toggle="tooltip" data-placement="bottom" title="'.$errors->first('in_PName').'"' : '' !!}>
                        <label for="" style="width:100%"><i>Project</i></label>
                        <input type="text" name="in_PName" class="form-control" placeholder="Name Of Project" value="{{$project->P_Name}}" >
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="" style="width:100%"><i>Client</i></label>
                        <?php
                            $clients = App\Clients::all();
                        ?>
                        <select class="list" name="sl_Client">
                        @foreach ($clients as $c)
                            <option value="{{$c->idClient}}" {{$c->idClient == $project->idClient ? 'selected' : ''}}>{{$c->ClientName}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group validate{{ $errors->has('wrong_day') || $errors->has('wrong_start_day') ? ' has-error' : '' }}" {!! $errors->has('wrong_start_day') ? ' data-toggle="tooltip" data-placement="bottom" title="'.$errors->first('wrong_start_day').'"' : ($errors->has('wrong_day') ? ' data-toggle="tooltip" data-placement="bottom" title="'.$errors->first('wrong_day').'"' :'')  !!} >
                        <label for="" style="width:100%"><i>Time</i></label>
                        <?php
                            $sd = new DateTime($project->P_DateStart);
                            $ed = new DateTime($project->P_DateFinish);
                            $startday = $sd->format('m/d/Y');
                            $endday = $ed->format('m/d/Y');
                        ?>
                        <input type="text" name="daterange"  class="form-control " value="{{$startday}} - {{$endday}}" >
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="" style="width:100%"><i>Project Status</i></label>
                        <select class="list" name="sl_PStatus">
                            <option value="1" {{$project->idPStatus == '1' ? 'selected' : ''}}>In progress</option>
                            <option value="2" {{$project->idPStatus == '2' ? 'selected' : ''}}>Done</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group validate {{ $errors->has('in_descrip') ? ' has-error' : '' }}" {!! $errors->has('in_descrip') ? ' data-toggle="tooltip" data-placement="bottom" title="'.$errors->first('in_descrip').'"' : '' !!}>
                        <textarea name="in_descrip" placeholder="What is project about?" class="form-control"; style="resize: none;width: 100%;margin-top: 10px;height: 60px;">{{ $project->P_Description }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-bordered table-responsive results text-center">
                            <thead >
                                <tr>
                                    <td>Avatar</td>
                                    <td>English name</td>
                                    <td>Full Name</td>
                                    <td>Email</td>
                                    <td>Choose</td>
                                    <td>Leader</td>
                                </tr>
                            </thead>
                            <tbody>
                            @if($errors->has('wrong_leader'))
                                <span style="color: red" class="pull-right">{{$errors->first('wrong_leader')}}</span>
                            @endif
                            <?php
                                $idPManager = $project->idPManager;
                                $team_employees =App\Team::where('idPmanager','=',$idPManager)->first()->Employee;

                            ?>
                            @foreach ($team_employees as $key=>$e)
                            <?php
                                $check = App\ProjectEmployee::where('idProject','=',$project->idProject)->where('idEmployee','=',$e->idEmployee)->get();
                            ?>
                            @if (count($check) == 1 || $e->idEmployee == $project->idTeamLeader)
                             <!-- On working and in the project or TeamLeader -->
                                <tr class="TopRow">
                                    <td><img src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" class="img img-circle" alt=""></td>
                                    <td>{{$e->E_EngName}}</td>
                                    <td>{{$e->E_Name}}</td>
                                    <td>{{$e->E_Skype}}</td>
                                    <td>
                                        <input class="checkbox" type="checkbox" name="cb[{{$key}}]"  checked data="{{$e->idEmployee}}">
                                    </td>
                                    <td>
                                        <input class="r_leader" type="radio" name="r_leader" value="{{$e->idEmployee}}" {{$e->idEmployee == $project->idTeamLeader ? 'checked' : ''}}>
                                    </td>
                                </tr>
                            @elseif($e->idStatus == 2)
                                <tr>
                                    <td><img src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" class="img img-circle" alt=""></td>
                                    <td>{{$e->E_EngName}}</td>
                                    <td>{{$e->E_Name}}</td>
                                    <td>{{$e->E_Skype}}</td>
                                    <td>
                                        <input class="checkbox" type="checkbox" name="cb[{{$key}}]" data="{{$e->idEmployee}}">
                                    </td>
                                    <td>
                                        <input class="r_leader" type="radio" name="r_leader" value="{{$e->idEmployee}}" disabled>
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                            <tr class="warning no-result">
                              <td colspan="6"><i class="fa fa-warning"></i> No result</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-bottom:5px;">
                    <div class="col-md-6">
                        <label for=""><i>Search</i></label>
                        <input type="text" class="form-control search" placeholder="Search for employee">
                    </div>
                    <div class="col-md-6">
                        <div class="submit" style="float:right">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <a href="#" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
@stop
@section('script')
<script src="{{ asset('third-library/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('third-library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker();
    });
    </script>
    <script src="{{ asset('third-library/select2-4.0.2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".list").select2();
    });
    </script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
    <script>
        $(document).ready(function() {
            $(".search").keyup(function() {
                var searchTerm = $(".search").val();
                var listItem = $('.results tbody').children('tr');
                var searchSplit = searchTerm.replace(/ /g, "'):containsi('");
                $.extend($.expr[':'], {
                    'containsi': function(elem, i, match, array) {
                        return (elem.textContent || elem.innerText || '').toLowerCase()
                            .indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });
                $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(
                    function(e) {
                        $(this).attr('visible', 'false');
                    });
                $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
                    $(this).attr('visible', 'true');
                });
                var jobCount = $('.results tbody tr[visible="true"]').length;
                $('.counter').text(jobCount + ' item');
                if (jobCount == '0') {
                    $('.no-result').show();
                } else {
                    $('.no-result').hide();
                }
            });
        });
    </script>
    <script>
        $(".checkbox").click(function() {
            var row = $(this).parents("tr:first");
            $id = $(this).attr('data');
            if ($(this).is(':checked', true)) {
                var firstRow = row.parent().find("tr:first").not(row);
                row.insertBefore(firstRow).addClass("TopRow");
                $(this).parent().parent().find('.r_leader').attr('disabled',false);
                $(this).val($id +',yes');
            } else if (row.hasClass('TopRow')) {
                var nonTopRows = row.siblings().not('.TopRow');
                var found = false;
                nonTopRows.each(function() {
                    if (row.data('pos') < $(this).data('pos') && !found) {
                        found = true;
                        row.insertBefore($(this));
                    }
                });
                if (!found) row.appendTo(row.parent());
                row.removeClass("TopRow");
                $(this).parent().parent().find('.r_leader').attr('disabled',true);
                $old_value = $(this).val();
                $(this).val($id +',no');
            }
        });
    </script>
    <script>
        $('document').ready(function() {
            $('.checkbox:checked').each(function() {
                $id = $(this).attr('data');
                var row = $(this).parents("tr:first");
                if ($(this).is(':checked', true)) {
                    var firstRow = row.parent().find("tr:first").not(row);
                    row.insertBefore(firstRow);
                    $(this).val($id +',yes');
                } else if (row.hasClass('TopRow')) {
                    var nonTopRows = row.siblings().not('.TopRow');
                    var found = false;
                    nonTopRows.each(function() {
                        if (row.data('pos') < $(this).data('pos') && !found) {
                            found = true;
                            row.insertBefore($(this));
                        }
                    });
                    if (!found) row.appendTo(row.parent());
                    row.removeClass("TopRow");

                }
            });
        });
    </script>
@stop
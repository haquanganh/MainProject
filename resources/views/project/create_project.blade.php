@extends('layout.master')
@section('title','Home page')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/create_project.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
            <div id="img-title">
                <p>Create New Project</p>
            </div>
            <form class="form-inline" role="form" method="POST" action="create-project">
                {{csrf_field()}}
                    <?php
                         $idAccount = Auth::user()->idAccount;
                         $idE = App\Employee::where('idAccount','=',$idAccount)->first()->idEmployee;
                         $idTeam = App\Team::where('idPManager','=',$idE)->first()->idTeam;
                         $listE = App\Team::find($idTeam)->Employee;
                         $listC = App\Clients::all();
                    ?>
                    <input type="hidden" value="{{$listE->count()}}" name="n_listE">
                <div class="info row">
                    <div class="col-xs-3 form-group  {{ $errors->has('in_NameofProject') ? ' has-error' : '' }} validate"  {!! $errors->has('in_NameofProject') ? ' data-toggle="tooltip" data-placement="top" title="'.$errors->first('in_NameofProject').'"' : '' !!} >
                        <label for=""><i>Project</i></label>
                        <input type="text" name="in_NameofProject" class="form-control" placeholder="Name Of Project">
                    </div>
                    <div class="col-xs-3 form-group">
                        <label for=""><i>Client</i></label>
                       <select class="list" name="sl_Client">
                        @foreach ($listC as $c)
                            <option value="{{$c->idClient}}">{{$c->ClientName}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-xs-3 form-group  {{ $errors->has('wrong_day') || $errors->has('wrong_start_day') ? ' has-error' : '' }} validate"  {!! $errors->has('wrong_start_day') ? ' data-toggle="tooltip" data-placement="top" title="'.$errors->first('wrong_start_day').'"' : ($errors->has('wrong_day') ? ' data-toggle="tooltip" data-placement="top" title="'.$errors->first('wrong_day').'"' :'')  !!} >
                        <label for=""><i>Time</i></label>
                        <input type="text" name="daterange" class="form-control" />
                    </div>
                    <div class="col-xs-3 form-group">
                        <label for=""><i>Leader</i></label>
                        <select class="list" name="sl_Leader">
                            @foreach ($listE as $key => $e)
                                <option value="{{$e->idEmployee}}">{{$e->E_EngName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row table-responsive">
                    <div class="col-xs-12">
                        <table class="table table-striped table-bordered table-responsive results">
                            <thead>
                                <tr>
                                    <td>Avatar</td>
                                    <td>English name</td>
                                    <td>Full Name</td>
                                    <td>Skype</td>
                                    <td>Choose</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($listE as $key => $e )
                                <tr>
                                    <td><img src="{{ asset('images')}}/{{$e->E_Avatar}}" class="img img-circle" alt=""></td>
                                    <td>{{$e->E_EngName}}</td>
                                    <td>{{$e->E_Name}}</td>
                                    <td>{{$e->E_Skype}}</td>
                                    <td>
                                        <input type="checkbox" name="c[{{$key}}]" value="{{$e->idEmployee}}">
                                    </td>
                                </tr>
                            @endforeach
                                <tr class="warning no-result">
                                  <td colspan="5"><i class="fa fa-warning"></i> No result</td>
                                </tr>
                            </tbody>
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
                            <input type="submit" class="btn btn-primary" value="Create">
                            <a href="#" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="clear40"></div>
            </form>
@stop
@section('script')
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker();
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
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
@stop
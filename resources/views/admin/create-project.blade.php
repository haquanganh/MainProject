@extends('layout.admin')
@section('title','Create Project')
@section('name','Create Project')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/create_project.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}" rel="stylesheet" />
@stop
@section('content')
    <form class="form-inline" id="form" role="form" method="POST" action="{{url('admin/create-project')}}">
        {{csrf_field()}}
            <?php
                 $listC = App\Clients::all();
                 $listPM = App\User::where('idRole','=',2)->get();
            ?>
            <input type="hidden" name="n_listE">
        <div class="info row">
            <div class="col-md-3 form-group text-center {{ $errors->has('in_NameofProject') ? ' has-error' : '' }} validate"  {!! $errors->has('in_NameofProject') ? ' data-toggle="tooltip" data-placement="bottom" title="'.$errors->first('in_NameofProject').'"' : '' !!} >
                <label for=""><i>Project</i></label>
                <input type="text" name="in_NameofProject" class="form-control" placeholder="Name Of Project">
            </div>
            <div class="col-md-3 form-group text-center {{ $errors->has('wrong_day') || $errors->has('wrong_start_day') ? ' has-error' : '' }} validate"  {!! $errors->has('wrong_start_day') ? ' data-toggle="tooltip" data-placement="bottom" title="'.$errors->first('wrong_start_day').'"' : ($errors->has('wrong_day') ? ' data-toggle="tooltip" data-placement="bottom" title="'.$errors->first('wrong_day').'"' :'')  !!} >
                <label for=""><i>Time</i></label>
                <input type="text" name="daterange" class="form-control" />
            </div>
            <div class="col-md-3 form-group text-center">
                <label for=""><i>Client</i></label>
               <select class="list" name="sl_Client">
                @foreach ($listC as $c)
                    <option value="{{$c->idClient}}">{{$c->ClientName}}</option>
                @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group text-center">
                <label for=""><i>Manager</i></label>
                <select class="list list-PM" name="sl_PM">
                    <option></option>
                    @foreach ($listPM as $key => $p)
                        <?php $PM = App\Employee::where('idAccount','=',$p->idAccount)->first()?>
                        <option value="{{$PM->idEmployee}}">{{$PM->E_EngName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group validate {{ $errors->has('in_descrip') ? ' has-error' : '' }}" {!! $errors->has('in_descrip') ? ' data-toggle="tooltip" data-placement="bottom" title="'.$errors->first('in_descrip').'"' : '' !!}>
                <textarea name="in_descrip" placeholder="What is project about?" class="form-control"; style="resize: none;width: 100%;margin-top: 10px;height: 60px;"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table id="myTable" class="tablesorter table table-striped table-bordered table-responsive results">
                    <thead>
                        <tr>
                            <td>Avatar</td>
                            <td>English name</td>
                            <td>Full Name</td>
                            <td>Skype</td>
                            <td>Choose</td>
                            <td>Leader</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($errors->has('wrong_leader'))
                                <span style="color: red" class="pull-right">{{$errors->first('wrong_leader')}}</span>
                            @endif
                        <tr class="warning no-result">
                          <td colspan="6"><i class="fa fa-warning"></i> No result</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6">
                <label for="" class="label-search"><i>Search</i></label>
                <input type="text" class="form-control search" placeholder="Search for employee">
            </div>
            <div class="col-md-6">
                <div class="submit" style="float:right">
                    <input type="submit" class="btn btn-primary" value="Create">
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
    $(document).ready(function() {
        $(".list-PM").select2({
            placeholder: 'Select Project Manager'
        });
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
    <script src="{{ asset('third-library/jquery-tablesorter/jquery.tablesorter.min.js') }}"></script>
    <script>
        $(document).ready(function(){
                $("#myTable").tablesorter();
        });
    </script>
    <script>
        function chekbox_ontop() {
            $(".checkbox").click(function() {
                var row = $(this).parents("tr:first");
                if ($(this).is(':checked', true)) {
                    var firstRow = row.parent().find("tr:first").not(row);
                    row.insertBefore(firstRow).addClass("TopRow");
                    $(this).parent().parent().find('.r_leader').attr('disabled',false);
                } else if (row.hasClass('TopRow')) {
                    var nonTopRows = row.siblings().not('.TopRow');
                    console.log(nonTopRows);
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
                }
            });
        }
    </script>
    <script>
        $('document').ready(function(){
            var _token = $( "input[name*='_token']" ).val();
            var tbody = $('#myTable').children('tbody');
            $('.list-PM').change(function(){
                var num_row =tbody.find('tr').length;
                var id_PM = $(this).val();
                $.ajax({
                    url: '{{ url('/admin/get-listPM') }}',
                    type: 'GET',
                    cache: false,
                    data:{"_token" : _token,"id_PM" : id_PM },
                    success: function(data){
                        console.log(data);
                        if(data != 'Empty'){
                            if(num_row >1){
                                $('.row_data').remove();
                            }
                           $.each( data, function( key, value ) {
                                if(value.idStatus == 2){
                                    tbody.append('<tr class="row_data"><td><img src="'+'{{ asset('images/personal_images') }}'+'/'+value.E_Avatar+'" class="img img-circle" alt=""></td><td>'+value.E_EngName+'</td><td>'+value.E_Name+'</td><td>'+value.E_Skype+'</td><td><input type="checkbox" class="checkbox" name="c['+key+']" value="'+value.idEmployee+'" ></td><td><input class="r_leader" type="radio" name="r_leader" value="'+value.idEmployee+'" disabled></td></tr>');
                                }
                            });
                        }
                            chekbox_ontop();
                            $("input[name*='n_listE']").val(data.length);
                    }
                });
            });
        });
    </script>
@stop
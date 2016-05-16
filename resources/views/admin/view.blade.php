@extends('layout.admin')
@section('title','Personal Information')
@section('name','Personal Information')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/personal_information.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/datatables-1.10.11/css/dataTables.bootstrap.min.css') }}">
    <style type="text/css">
        .no-sort::after { display: none!important; }
        .no-sort { pointer-events: none!important; cursor: default!important; }
    </style>
@stop
@section('content')
@if (Session::has('flat'))
    <div class="alert alert-success" role="alert">{{Session('flat')}}</div>
@endif
<div class="row" id="choose">
        <!-- <input id="search-box" type="text" class="form-control pull-right" style="width: 150px;margin-bottom: 10px" placeholder="Search for employee"> -->
</div>
<div class="row table-responsive">
    <div class="col-md-12" id="table-data">
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    @if(isset($list_employee))
                    <th class="no-sort">Avatar</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Date of birth</th>
                    <th>Skype</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Team</th>
                    <th>Action</th>
                    <th>Detail</th>
                    @elseif(isset($list_client))
                    <th class="no-sort">Avatar</th>
                    <th>Name</th>
                    <th>Skype</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Action</th>
                    <th>Detail</th>
                    @else
                    <th class="no-sort">Logo</th>
                    <th>Company Name</th>
                    <th>Company Address</th>
                    <th>Company Skype</th>
                    <th>Company Phone</th>
                    <th>Representative</th>
                    <th>Company Description</th>
                    <th>Action</th>
                    <th>Detail</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @if(isset($list_employee))
            @foreach ($list_employee as $employee)
            <?php
                $id_Role = App\User::find($employee->idAccount)->idRole;
                $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
            ?>
            @if ($id_Role != 1)
                <tr>
                    <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$employee->E_Avatar}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                    <td>{{$employee->E_Name}}</td>
                    <td>{{$employee->E_Sex == 1 ? 'Male' : 'Female'}}</td>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $employee->E_DateofBirth)->format('d-F-Y') }}</td>
                    <td>{{$employee->E_Skype}}</td>
                    <td>0{{$employee->E_Phone}}</td>
                    <td>{{$name_Role}}</td>
                    <td>{{ $employee->Team->count() != 0 ? $employee->Team->first()->TeamName : 'Available'}}</td>
                    <td><a href="{{ route('admin.personal-information.edit',$employee->idEmployee) }}" class="glyphicon glyphicon-pencil"></a></td>
                    <td><a href="{{ route('admin.personal-information.show',$employee->idEmployee) }}"><i class="fa fa-info" aria-hidden="true"></i></a></td>
                </tr>
            @endif
            @endforeach
            @elseif(isset($list_client))
            @foreach ($list_client as $l)
                <tr>
                    <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$l->C_Avatar}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                    <td>{{$l->ClientName}}</td>
                    <td>{{$l->C_Skype}}</td>
                    <td>0{{$l->C_Phone}}</td>
                    <td>{{ App\Client_Company::find($l->idClientCompany)->CC_Name }}</td>
                    <td><a href="{{ url('admin/personal-information/client/edit').'/'.$l->idClient }}" class="glyphicon glyphicon-pencil"></a></td>
                    <td><a href="{{ url('admin/personal-information/client').'/'.$l->idClient }}"><i class="fa fa-info" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
            @else
            @foreach ($list_clientcompany as $l)
                <tr>
                    <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$l->CC_Logo}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                    <td>{{ $l->CC_Address }}</td>
                    <td>{{ $l->CC_Name }}</td>
                    <td>{{ $l->CC_Skype }}</td>
                    <td>{{ $l->CC_Phone }}</td>
                    <td>
                        <?php $list_representative = App\Clients::where('idClientCompany','=',$l->idClientCompany)->get();?>
                        @foreach ($list_representative as $lr)
                            {{ $lr->ClientName }},
                        @endforeach
                    </td>
                    <td>{{ $l->CC_Description }}</td>
                    <td><a href="{{ url('admin/personal-information/clientcompany/edit').'/'.$l->idClientCompany }}" class="glyphicon glyphicon-pencil"></a></td>
                    <td><a href="{{ url('admin/personal-information/client_company').'/'.$l->idClientCompany }}/"><i class="fa fa-info" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
    <a id="add" href="{{ url('admin/register') }}"><img src="{{ asset('images/add-admin.png') }}" ></a>
@stop
@section('script')
<script src="{{ asset('third-library/datatables-1.10.11/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('third-library/datatables-1.10.11/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('third-library/select2-4.0.2/dist/js/select2.min.js') }}"></script>
<script>
    jQuery(document).ready(function($) {
        @if (isset($list_employee))
            $('#table').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [ 3, 5, 8, 9 ] }
            ]
            });
        @elseif(isset($list_client))
            $('#table').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [ 3, 5, 6 ] }
            ]
            });
        @else
            $('#table').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [ 4, 5 ] }
            ]
            });
        @endif

        /*Custom Table*/
        $('.dataTables_length').parent().html('Type of list: <form action="{{ url('admin/personal-information') }}" method="POST" style="display:inline"> {{ csrf_field() }} <select id="type-list" name="typelist" class="pull-left" onchange="this.form.submit()"><option></option><option value="1" {{ isset($list_employee) ? 'selected' : '' }}>Employees</option><option value="2" {{ isset($list_client) ? 'selected' : '' }}>Clients</option><option value="3" {{ isset($list_clientcompany) ? 'selected' : '' }}>Client Company</option></select></form>');
        $('.dataTables_info').parent().hide();
        $('.dataTables_info').parent().next().attr('class','col-md-12');
        $('select#type-list').select2({
            placeholder: 'Choose type of list',
            minimumResultsForSearch: Infinity
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#type-list').change(function(event) {
        });
    });
</script>
<!--
<script type="text/javascript">
    var page = 1;
    var val = '';
    $(document).on('click','.pagination a',function(e){
        var url = '';
            page = $(this).attr('href').split('page=')[1];
        if($(this).parent().parent().hasClass('pagination1') == false){
            url = '{{ url('personal-information') }}';
            getPosts(page);
        }
        else{
            url = '{{ url('pagination/employees/search/results') }}';
            getPosts1(page);
        }
        e.preventDefault();
        var first = $(this).parent().parent().find('li').first();
        var last = $(this).parent().parent().find('li').last();
        if(page != 1 && $(this).parent().parent().find('li').last().html() != $(this).parent().html() && $(this).parent().parent().find('li').first().html() != $(this).parent().html()){
            $(this).parent().parent().find('li').first().removeClass('disabled');

            $(this).parent().parent().find('li').first().html('<a rel="prev" href="'+url+'?page='+(parseInt(page) - 1)+'">«</a>');
            $(this).parent().parent().find('li').first().next().removeClass('active');
            $(this).parent().parent().find('li').first().next().html('<a href="'+url+'/?page=1">1</a>');
            $(this).parent().parent().find('li.active').removeClass('active');
            $(this).parent().addClass('active');
            $(this).parent().parent().find('li').last().html('<a rel="next" href="'+url+'?page='+(parseInt(page) + 1)+'">»</a>');
            $(this).parent().parent().find('li').last().attr('class','');
            if($(this).parent().next().html() == $(this).parent().parent().find('li').last().html()){
                $(this).parent().parent().find('li').last().attr('class','disabled');
                $(this).parent().parent().find('li').last().html('<span>»</span>');
            }
        }
        else if(page ==1 && $(this).parent().html() != first.html()){
                $(this).parent().parent().find('li').first();
                $(this).parent().parent().find('li.active').removeClass('active');
                $(this).parent().addClass('active');
                $(this).parent().parent().find('li').first().html('<span>«</span>');
                $(this).parent().parent().find('li').first().attr('class','disabled');
                $(this).parent().parent().find('li').last().html('<a rel="next" href="'+url+'?page='+(parseInt(page) + 1)+'">»</a>');
        }
        else{
            $(this).parent().parent().find('li').first().next().html('<a href="'+url+'/?page=1">1</a>');
            var active = $(this).parent().parent().find('.active').next().html();
            if($(this).parent().parent().find('li').last().html() == $(this).parent().html()){
                first.attr('class', '');
                first.html('<a href="'+url+'?page='+parseInt(page - 1)+'" rel="prev">«</a>');
                $old = $(this).parent().parent().find('li.active');
                $(this).parent().parent().find('li.active').next().addClass('active');
                $(this).parent().html('<a rel="next" href="'+url+'?page='+(parseInt(page) + 1)+'">»</a>');
                $old.attr('class','');
                if(last.prev().html() == active){
                    last.attr('class', 'disabled');
                    last.html('<span>»</span>');
                }
            }
            /*Handle prev*/
            else if($(this).parent().parent().find('li').first().html() == $(this).parent().html()){
                var active = $(this).parent().parent().find('.active').prev().html();
                last.attr('class', '');
                last.html('<a href="'+url+'?page='+(parseInt(page)+1)+'" rel="prev">»</a>');
                $old = $(this).parent().parent().find('li.active');
                $(this).parent().parent().find('li.active').prev().addClass('active');
                $(this).parent().html('<a rel="next" href="'+url+'?page='+(parseInt(page) - 1)+'">«</a>');
                $old.attr('class','');
                if(first.next().html() == active){
                    first.attr('class', 'disabled');
                    first.html('<span>«</span>');
                }
            }
        }

    });
    function getPosts(page){
        $.ajax({
            url:'pagination/employees?page='+ page
        }).done(function(data){
            $('table').html(data);

        });
    }
    function getPosts1(page){
        $.ajax({
            url:'pagination/employees/search/results?page='+ page,
            'type' : 'GET',
            cache: false,
            data: {"val" : val},
            success: function(data){
                $('table').html(data);
            }

        });
    }
</script>

<script type="text/javascript">
        $('#search-box').keyup(function(){
            console.log(page);
            val = $(this).val();
            if(val == '') val = ' ';
            $.ajax({
                url: '{{ url('admin/pagination/search') }}',
                type: 'GET',
                cache: false,
                data:{"val" : val },
                success: function(data){
                    var count = 0;
                    if(data != 'Empty'){
                        var result = $.parseJSON(data);
                        $('tbody > tr').remove();
                        console.log(result[0]);
                        $.each(result[0].data, function(index, val) {
                            if(index <= 9){
                             $('tbody').append('<tr><td style="width: 20px;" class="img"><img class="img-circle" style="width: 50px;height: 50px;  margin-left:4.5px;" src="{{ asset('images/personal_images') }}/'+val.E_Avatar+'"></td><td>'+val.E_Name+'</td><td>'+'Male'+'</td><td>'+val.E_DateofBirth+'</td><td>'+val.E_Skype+'</td><td>'+val.E_Phone+'</td><td>Manager</td><td>'+val.TeamName+'</td><td class="text-center"><a class="glyphicon glyphicon-pencil" href="{{ url('admin.personal-information') }}/'+val.idEmployee+'/edit"></a></td><td class="text-center"><a href="{{ url('admin/personal-information') }}/'+val.idEmployee+'"><i class="fa fa-info" aria-hidden="true"></i></a></td></tr>');
                            }
                        });
                        var total_item = (result[0].total);
                        var page1 = 0;
                        $('.pagination').not('.pagination1').hide();
                        $('.pagination1').remove();
                        if(total_item%10 != 0){
                            page1 = total_item/10 +1;
                        }
                        else{
                            page1 = total_item/10;
                        }
                        $('#pages').append('<ul class="pagination pagination1" style="display:inline block"></ul>');
                        if(total_item > 10){
                            $('.pagination1').append('<li class="disabled"><span>«</span></li>');
                        }
                        for(var i = 1 ; i <= page1 ; i++){
                            if(i!=1){
                                $('.pagination1').append('<li><a href="{{ url('pagination/results') }}?page='+i+'">'+i+'</a></li>');
                            }

                            else{
                                $('.pagination1').append('<li class="active"><span>1</span></li>');
                            }

                        }
                        if(total_item > 10){
                        $('.pagination1').append('<li><a rel="next" href="{{ url('pagination/employees/search/results?page=2') }}">»</a></li>');
                        }
                    }
                    else if(val == ' '){
                        console.log(page);
                        $('.pagination').not('.pagination1').show();
                        $('.pagination1').remove();
                        getPosts(page);
                    }
                    else{
                        $('.pagination').not('.pagination1').hide();
                        $('tbody > tr').remove();
                        $('tbody').append('<tr><td colspan="8">Data not found</td></tr>');
                    }
                }
            });
        });
</script>
 -->
 <script type="text/javascript">
    $(document).ready(function () {
           setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 2000);
    });
</script>
 <script>
     jQuery(document).ready(function($) {
         $('.account').addClass('active');
     });
 </script>
@stop
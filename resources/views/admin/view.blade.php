@extends('layout.admin')
@section('title','Personal Information')
@section('name','Personal Information')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/personal_information.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/datatables-1.10.11/css/dataTables.bootstrap.min.css') }}">
@stop
@section('content')
<div class="row" id="choose">
        
        <!-- <input id="search-box" type="text" class="form-control pull-right" style="width: 150px;margin-bottom: 10px" placeholder="Search for employee"> -->
</div>
<div class="row table-responsive">
    <div class="col-md-12" id="table-data">
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Date of birth</th>
                    <th>Skype</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Team</th>
                    <th>Action</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
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
                    <td>{{$employee->E_DateofBirth}}</td>
                    <td>{{$employee->E_Skype}}</td>
                    <td>0{{$employee->E_Phone}}</td>
                    <td>{{$name_Role}}</td>
                    <td>{{ $employee->Team->count() != 0 ? $employee->Team->first()->TeamName : 'Available'}}</td>
                    <td class="text-center"><a href="{{ route('admin.personal-information.edit',$employee->idEmployee) }}" class="glyphicon glyphicon-pencil"></a></td>
                    <td class="text-center"><a href="{{ route('admin.personal-information.show',$employee->idEmployee) }}"><i class="fa fa-info" aria-hidden="true"></i></a></td>
                </tr>
            @endif
            @endforeach
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
        $('#table').DataTable();
        $('.dataTables_length').parent().html('<select id="type-list" class="pull-left"><option></option><option value="1">Employees</option><option value="2">Clients</option></select>');
        $('select#type-list').select2({
            placeholder: 'Choose type of list',
            minimumResultsForSearch: Infinity
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
 <script>
     jQuery(document).ready(function($) {
         $('.account').addClass('active');
     });
 </script>
@stop
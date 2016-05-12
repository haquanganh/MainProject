@extends('layout.admin')
@section('title','Project Management')
@section('name','Project Management')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/project.css') }}">
	<link href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}" rel="stylesheet" />
@stop
@section('content')
@if (Session::has('flat'))
    <div class="alert alert-success" role="alert">{{Session('flat')}}</div>
@endif
<div class="row options">
    <h4><i>In progress</i></h4>
    <div class="project_select pull-right">
        <form action="" method="POST" role="form">
            <select class="list">
                <option></option>
                <option value="0">All</option>
                <option value="1" selected="">In progress</option>
                <option value="2">Done</option>
            </select>
            <a href="{{ url('admin/create-project') }}" class="add"><img src="{{ asset('images/add-new-icon.png') }}" alt=""></a>
        </form>
    </div>
</div>
<hr>
<?php  $Projects = App\Project::all();?>
<div class="row folder">
@if($Projects->count() !=0)
    @foreach ($Projects as $p)
    @if ($p->idPStatus == 1)
    <div class="col-md-3 projects">
        <div class="content-box-large" onclick="window.location='{{ url('/admin/project_detail') }}/{{$p->idProject}}'">
            <p class="name-project"><b>{{$p->P_Name}}</b></p>
            <p class="time-project"><i>{{ Carbon\Carbon::createFromFormat('Y-m-d', $p->P_DateStart)->format('d-F-Y')}}<span> - </span>{{Carbon\Carbon::createFromFormat('Y-m-d', $p->P_DateFinish)->format('d-F-Y')}}</i></p>
        </div>
    </div>
    @endif
    @endforeach
@else
    <h4 class="lead nodata-found" style="margin-left:30px">You have not had any project</h4>
@endif
</div>
@stop
@section('script')
<script src="{{ asset('third-library/select2-4.0.2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".list").select2({
            placeholder: 'Select Project Status',
            minimumResultsForSearch: Infinity
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
           setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 2000);
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.list').change(function(){
            $('.nodata-found').remove();
            var idPStatus = $(this).val();
            if(idPStatus == 1){
                $('.row > h4').text('In progress');
            }
            else if(idPStatus !=0){
                $('.row > h4').text('Done');
            }
            else{
                $('.row > h4').text('All project');
            }
            var list_n = $('.projects').length;
            $.ajax({
                url: '{{ url('/admin/get-listProject') }}',
                type: 'GET',
                cache: false,
                data:{"idPStatus" : idPStatus},
                success: function(data){
                    if(data != 'Empty'){
                        if(list_n > 0){
                            $('.projects').remove();
                        }
                       $.each( data, function( key, value ) {
                            $('.folder').append('<div class="col-md-3 projects"><div class="content-box-large" onclick="window.location=\''+'{{ url('admin/project_detail') }}/'+value.idProject+'\';"><p class="name-project"><b>'+value.P_Name+'</b></p><br><br><p class="time-project"><i>'+value.P_DateStart+'<span>-</span>'+value.P_DateFinish+'</i></p></div></div>');
                       });

                    }
                    if($('.folder > .projects ').length == 0){
                        $('.folder').html('<h4 class="lead nodata-found" style="margin-left:30px">You have not had any project</h4>');
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.project').addClass('active');
    });
</script>
@stop
@extends('layout.admin')
@section('title','Project Management')
@section('name','Project Management')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/project.css') }}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
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
                                <option value="1">In progress</option>
                                <option value="2">Done</option>
                            </select>
                            <a href="" class="add"><img src="{{ asset('images/add-new-icon.png') }}" alt=""></a>
                        </form>
                    </div>
                </div>
                <hr>
                <?php  $Projects = App\Project::all();?>
                <div class="row folder">
                @foreach ($Projects as $p)
                @if ($p->idPStatus == 1)
                <div class="col-md-3 projects">
                        <div class="content-box-large" onclick="window.location='{{ url('/admin/project_detail') }}/{{$p->idProject}}'" style="">
                            <p class="name-project"><b>{{$p->P_Name}}</b></p>
                            <p class="time-project"><i>{{$p->P_DateStart}}<span>-</span>{{$p->P_DateFinish}}</i></p>

                        </div>
                </div>
                @endif
                @endforeach
                </div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".list").select2();
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
                var idPStatus = $(this).val();
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
                    }
                });
            });
        });
    </script>
@stop
@extends('layout.master')
@section('title','Home page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/project_detail.css') }}">
<link href="{{ asset('third-library/select2-4.0.2/dist/css/select2.min.css') }}" rel="stylesheet" />
@stop
@section('content')
            <div id="img-title">
                <p>Project Information
                    @if (Auth::user()->idRole == 2)
                         <a href="{{ url('/project/edit/') }}/{{$project->idProject}}" class="pull-right" style="color:white;"><i class="glyphicon glyphicon-edit"></i></a>
                    @endif
                </p>
            </div>
            <?php
                $client = App\Clients::find($project->idClient);
                $teamLeader = App\Employee::find($project->idTeamLeader);
                $PM = App\Employee::find($project->idPManager);
            ?>
            <div class="row">
                <div class="col-md-6 text-center" style="height:500px;marign:0px;background-color:#EDEDED;color:black;padding-top:20px;">
                    <div>
                        <h4><b>{{$client->ClientName}}</b></h4>
                        <h1><b>{{$project->P_Name}}</b></h1>
                        <h4><i>{{$project->P_DateStart}} <span>-</span>{{$project->P_DateFinish}}</i></h4>
                        <h4>{{$PM->E_EngName}}</h4>
                        <h3>{{$project->P_Note}}</h3>
                    </div>
                </div>
                <div class="col-md-6" style="height:500px;background-color:#FFFFFF; margin:0px;">
                    <div class="team" style="margin-top:15px">
                        <div class="row text-center">
                            <a class="link" data="{{$teamLeader->idEmployee}}" href="#" ><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$teamLeader->E_Avatar}}" style="width:80px;height:80px" alt=""></a>
                            <p>{{$teamLeader->E_EngName}}</p>
                        </div>
                        <div class="row text-center">
                            @foreach ($project->Employee as $e)
                            @if(count($project->Employee) == 3 )
                                <div class="col-md-4">
                                    <a class="link" data="{{$e->idEmployee}}" href="#"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt=""></a>
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                                </div>
                            @elseif(count($project->Employee) ==2 )
                            <div class="col-md-6">
                                    <a class="link" data="{{$e->idEmployee}}" href="#"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt=""></a>
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @elseif(count($project->Employee) ==1)
                                <div class="col-md-12">
                                    <a class="link" data="{{$e->idEmployee}}" href="#"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt=""></a>
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @else
                            <div class="col-md-4">
                                    <a class="link" data="{{$e->idEmployee}}" href="#"><img class="img img-circle" src="{{ asset('images/personal_images') }}/{{$e->E_Avatar}}" style="width:50px;height:50px" alt=""></a>
                                    <p style="word-wrap: break-word;">{{$e->E_EngName}}</p>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
                        <!-- Show user infor -->
                        <div id="user-infor">
                            <div class="row" >
                                <div class="col-md-12">
                                    <h4><i>Basic Information</i></h4>
                                    <ul class="list-group basic-information">
                                        <li class="list-group-item id">ID Employee: EDNZ160001</li>
                                        <li class="list-group-item name">Name: Anh (Astro) Q. Ha</li>
                                        <li class="list-group-item skype">Skype: eureka.m0198</li>
                                        <li class="list-group-item phone">Phone: 0906478808</li>
                                        <li class="list-group-item address">Address: 46 Ho Tung Mau, Hoa Minh, Lien Chieu, Da Nang</li>
                                    </ul>
                                    <h4><i>Technical Information</i></h4>
                                    <ul class="list-group tech-info">
                                        <li class="list-group-item skill">
                                            <div class="detailed_skill">
                                                <div class="skill-name">Java</div>
                                            </div>
                                            <div class="detailed_skill">
                                                <div class="skill-net">NET</div>
                                            </div>
                                            <div class="detailed_skill">
                                                <div class="skill-name">C#</div>
                                            </div>
                                        </li>
                                        <li class="list-group-item role">Role: SW1</li>
                                        <li class="list-group-item cost_hour">Cost Hour: $15</li>
                                    </ul>
                                        <h4><i>Feedback</i></h4>
                                        <ul class="list-group feedback">
                                           <!-- Feedback list -->
                                        </ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <?php
                                        $idRole = Auth::user()->idRole;
                                    ?>
                            @if ($idRole == 4)
                                <a class="btn btn-default pull-left" data-toggle="modal" href='#feedback-form'>Give feedback for this person</a>
                            @endif     
                                <button class="btn btn-default" id="hide">Hide</button>
                            </div>
                        </div>

    <!-- Feedback form-->
    <form id="form-feedback" method="POST" action="{{ url('/client-feedback') }}">
    {!! csrf_field() !!}
       <div class="modal fade" id="feedback-form" >
           <div class="modal-dialog" style="width: 800px;">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">Feedback</h4>
                   </div>
                   <div class="modal-body row" >
                        <div class="col-md-5">
                           <p>Title</p>
                            <input type="text" id="feedback_title" name="feedback_title" class="form-control"></input>
                            <input type="hidden" name="idEmployee" class="idEmployee"></input>
                            <input type="hidden" name="idProject" value="{{$project->idProject}}"></input>
                           </br>
                           <p style="float: left;">Rating level:</p>
                           <fieldset class="rating pull-right" style="float: left; margin-top: -6px; margin-left: 15px;">
                                <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                <!-- <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label> -->
                                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <!-- <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label> -->
                                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <!-- <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label> -->
                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <!-- <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label> -->
                                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                <!-- <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label> -->
                            </fieldset>
                        </div>
                        <div class="col-md-7">
                           <p>Content</p>
                           <textarea class="form-control" id="feedback_content" name="feedback_content" style="height: 200px;"></textarea>
                        </div>
                    </div>
                    
                   <div class="modal-footer" style="clear: both; ">
                        <input type="submit" class="btn btn-primary" value="Send feedback">
                        </input>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                   </div>
               </div>
           </div>
       </div>
    </form>
            
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
<script src="{{ asset('third-library/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('third-library/select2-4.0.2/dist/js/select2.min.js') }}"></script>
    <!-- Validate -->
    <script type="text/javascript" src="{{ asset('js/jquery-validate/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-validate/additional-methods.js') }}"></script>
    
    <script type="text/javascript">
        $('#form-feedback').validate({
            rules:{
                feedback_title:{
                    required:true,
                    maxlength:60
                },
                feedback_content:{
                    required:true,
                    maxlength:1000
                }
            },
            messages:{
                feedback_title:{
                    required:"Please enter the Feedback title!",
                    maxlength:"Max length title is equal or less than 60 characters!"
                },
                feedback_content:{
                    required:"Please enter your feedback!",
                    maxlength:"Max length title is equal or less than 1000 characters!"
                }
            }
        });
    </script>
    <script type="text/javascript">
        jQuery(function(){
               jQuery('#messages-click').click();
            });

        $(document).ready(function(){
        $("#user-infor").hide();
        $('#hide').click(function(){
            $("#user-infor").slideUp(300);
            $("html, body").animate({scrollTop : 0}, 1000);
        });
        $(".link").click(function(){
            $("#user-infor").slideDown(300);
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        });
    });

    $('#feedback-form').on('show.bs.modal', function (e) {
     $('body').addClass('test');
    });
    </script>
    <!-- //////////// -->
    <script type="text/javascript">
    $(document).ready(function() {
        $(".list").select2();
    });
    $(document).ready(function() {
        $(".list_new").select2();
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.link').click(function(){
                var num = $('.title-feedback').length;
                var num2 = $('.content-feedback').length;
                var num3 = $('.edit-form').length;
                var idE = $(this).attr("data");
                $.ajax({
                    url: '{{ url('/get-employee') }}',
                    type: 'GET',
                    cache: false,
                    data:{"idE" : idE },
                    success: function(data){
                        var result = $.parseJSON(data);
                        $('.basic-information').find('.id').text(result[0].idEmployee);
                        $('#form-feedback').find('.idEmployee').val(result[0].idEmployee);
                        $('.basic-information').find('.name').text(result[0].E_EngName);
                        $('.basic-information').find('.skype').text(result[0].E_Skype);
                        $('.basic-information').find('.phone').text(result[0].E_Phone);
                        $('.basic-information').find('.address').text(result[0].E_Address);
                        if (num > 0) 
                        {                        
                            $('.title-feedback').remove();
                            
                        }
                        if(num2 > 0)
                        {
                            $('.content-feedback').remove();
                        }
                        if(num3 > 0)
                        {
                            $('.edit-form').remove();
                        }
                        $.each(result[2], function(index, val) {
                            $('.feedback').append('<li class="list-group-item title-feedback"><span class="title-fb">'+ val.F_Title +'</span><span class="control-star'+ val.idFeedback +' star"></span></li><li class="list-group-item content-feedback"><span class="content-fb">'+ val.F_Content +'</span></li><div class="modal fade del-feedback-form"><div class="modal-dialog"><div class="modal-content"><form method="POST" action="{{ url('/client-delete-feedback') }}">{!! csrf_field() !!}<div class="modal-body" id="del-feedback-body"><h3>Are you sure?</h3><input type="hidden" id="getIdfeedbacktodel" name="getIdfeedbacktodel" value="'+ val.idFeedback+'"></input></div><div class="modal-footer"><input type="submit" class="btn btn-primary" value="Yes"></input><button type="button" class="btn btn-default" data-dismiss="modal">No</button></div></form></div></div></div><div class="modal fade edit-feedback-form"><form class="form-edit-feedback'+ val.idFeedback +'"method="POST" action="{{ url('/client-edit-feedback') }}">{!! csrf_field() !!}<div class="modal-dialog" style="width: 800px;"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">Edit Feedback</h4></div><div class="modal-body row" ><div class="col-md-5"><p>Title</p><input type="text" id="edit_feedback_title" name="edit_feedback_title" class="form-control" value="'+ val.F_Title +'"></input></br><p>Rating level:</p><select class="form-control" name="rating"><option selected style="display:none;">'+ val.F_Rate +'</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div><div class="col-md-7"><p>Content</p><textarea class="form-control" id="edit_feedback_content" name="edit_feedback_content" style="height: 200px;">'+ val.F_Content +'</textarea><input type="hidden" name="idEmployee" class="idEmployee" value='+ val.idEmployee +'></input><textarea name="edit-text-backup" style="display:none;">'+ val.F_Content +'</textarea><input type="hidden" name="F_Title" value="'+ val.F_Title +'"></input><input type="hidden" name="F_Rate" value="'+ val.F_Rate +'"></input><input type="hidden" name="getIdfeedback" value="'+ val.idFeedback+'"></input></div></div><div class="modal-footer" style="clear: both; "><input type="submit" class="btn btn-primary" value="Save"></input><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></div></div></div></form></div>');
                            
                            for(var i = 0; i < val.F_Rate; i++) 
                            {
                                $('<img src="{{ asset('/images/icon-star.png') }}"></img>').appendTo('.control-star'+ val.idFeedback +'');
                            }
                            $('.form-edit-feedback'+ val.idFeedback +'').validate({
                                rules:{
                                    edit_feedback_title:{
                                        required:true,
                                        maxlength:60
                                    },
                                    edit_feedback_content:{
                                        required:true,
                                        maxlength:1000
                                    }
                                },
                                messages:{
                                    edit_feedback_title:{
                                        required:"Please enter the Feedback title!",
                                        maxlength:"Max length title is equal or less than 60 characters!"
                                    },
                                    edit_feedback_content:{
                                        required:"Please enter your feedback!",
                                        maxlength:"Max length title is equal or less than 1000 characters!"
                                    }
                                }
                            });
                        });

                        <?php
                            $idRole = Auth::user()->idRole;
                        ?>
                        @if ($idRole == 4)
                        $('<a data-toggle="modal" class="pull-right btn-delete"><span class="glyphicon glyphicon-remove"></span></a><a class="pull-right show-edit"><span class="glyphicon glyphicon-pencil"></span></a>').insertAfter('.title-feedback .title-fb');
                        @endif
                    }
                });
            });
        });
        //Edit feedback form.
        $(document).on('click', '.show-edit', function(){
            // $(this).parent().next("li").hide();
            // $(this).parent().next("li").next("li").show();
            $(this).parent().next("li").next('.del-feedback-form').next('.edit-feedback-form').modal();
        });

        // $(document).on('click', '.hide-edit', function(){
        //     $(this).parent().parent().parent().hide();
        //     $(this).parent().parent().parent().prev("li").show();
        // });
        //Delete feedback
        $(document).on('click', '.btn-delete', function(){
            $(this).parent().next("li").next('.del-feedback-form').modal();
        });
    </script>
    
@stop
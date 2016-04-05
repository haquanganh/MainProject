@extends('layout.master')
@section('title','Home page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/project_detail.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
            <div id="img-title">
                <p>Project Information
                    <a href="{{ url('/project/edit/') }}/{{$project->idProject}}" class="pull-right" style="color:white;"><i class="glyphicon glyphicon-edit"></i></a>
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
                                    <?php
                                        $idRole = Auth::user()->idRole;
                                    ?>
                                    @if ($idRole == 4)
                                        <h4><i>Feedback</i></h4>
                                        <ul class="list-group feedback">
                                            <!-- <li class="list-group-item title-feedback">
                                                <span>hjhj</span>
                                                <a class="pull-right show-edit">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </a>
                                            </li>
                                            <li class="list-group-item edit-form">
                                                <form class="edit-feedback" method="POST" action="{{ url('/') }}">
                                                {!! csrf_field() !!}
                                                    <textarea class="form-control edit-text">sasdasd</textarea>
                                                    <div class="pull-right">
                                                        <input type="submit" class="btn btn-primary" value="Save"></input>
                                                        <input type="button" class="btn btn-default hide-edit" value="Cancel"></input>
                                                    </div>
                                                    <div class="clear"></div>
                                                </form>
                                            </li> -->
                                        </ul>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-7"></div>
                            </div>
                            <div class="modal-footer">
                            @if ($idRole == 4)
                                <a class="btn btn-default pull-left" data-toggle="modal" href='#feedback-form'>Give feedback for this person</a>
                            @endif     
                                <button class="btn btn-default" id="hide">Hide</button>
                            </div>
                        </div>

                        <!-- Delete feedback form -->
                        <div class="modal fade" id="del-feedback-form">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ url('/client-delete-feedback') }}">
                                    {!! csrf_field() !!}
                                    <div class="modal-body" id="del-feedback-body">
                                        <h3>Are you sure?</h3>
                                        <input type="hidden" id="getIdfeedbacktodel" name="getIdfeedbacktodel"></input>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <input type="submit" class="btn btn-primary" value="Yes"></input>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
    <form id="form-feedback" method="POST" action="{{ url('/client-feedback') }}">
    {!! csrf_field() !!}
          <!-- Feedback -->
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
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <input type="submit" class="btn btn-primary" value="Send feedback">
                       </input>
                   </div>
               </div>
           </div>
       </div>
    </form>
        <!-- Anoucement message! -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
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
                    minlength:3
                }
            },
            messages:{
                feedback_title:{
                    required:"Please enter the Feedback title!",
                    maxlength:"Max length title is equal or less than 60 characters!"
                },
                feedback_content:{
                    required:"Please enter your feedback!",
                    minlength:"Min length title is equal or more than 3 characters!"
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
            $("#user-infor").slideUp(500);
            $("html, body").animate({scrollTop : 0}, 1000);
        });
        $(".link").click(function(){
            $("#user-infor").slideDown(500);
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
                        $.each(result[2], function(index, val) {
                            if(val.F_Mark == 1)
                            {
                            $('.feedback').append('<li class="list-group-item title-feedback"><span class="title-fb">'+ val.F_Title +'</span></li><li class="list-group-item edit-form"><form class="edit-feedback" method="POST" action="{{ url('/client-edit-feedback') }}">{!! csrf_field() !!}<textarea class="form-control" name="edit-text">'+ val.F_Content +'</textarea><input type="hidden" id="getIdfeedback" name="getIdfeedback" value='+ val.idFeedback+'></input><div class="pull-right"><input type="submit" class="btn btn-primary" value="Save"></input><input type="button" class="btn btn-default hide-edit" value="Cancel"></input></div><div class="clear"></div></form></li>');
                                $('#del-feedback-body').find('#getIdfeedbacktodel').val(val.idFeedback);
                            }
                        });

                        $('<a data-toggle="modal" href="#del-feedback-form" class="pull-right "><span class="glyphicon glyphicon-remove"></span></a><a class="pull-right show-edit"><span class="glyphicon glyphicon-pencil"></span></a>').insertAfter('.title-feedback .title-fb');
                       
                    }
                });
            });
        });
        //Edit feedback form.
        $(document).on('click', '.show-edit', function(){
           $(this).parent().next("li").show(500);
        });

        $(document).on('click', '.hide-edit', function(){
            $(this).parent().parent().parent().hide(500);
        });

    </script>
    
@stop
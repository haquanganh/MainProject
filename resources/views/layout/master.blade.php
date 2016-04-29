<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('third-library/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('third-library/font-awesome-4.6.1/css/font-awesome.min.css') }}">
	    <!-- <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine"> -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/masterpage.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/change_pass.css') }}">
        @yield('css')
	</head>
	<body>
    <div class="container-fluid">
		<div id="header">
            <div class="container">
                <div id="tophead">
                    <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/enclave_logo.png') }}"></a>
                    @if (Auth::user()->idRole != 1)
                    <div class="dropdown" style="z-index:2001">
                        @if (Auth::user()->idRole == 4)
                            <?php
                                $idAccount = Auth::user()->idAccount;
                                $idClient = App\Clients::select()
                                                ->where('idAccount', '=', $idAccount)->first()
                                                ->idClient;
                                $list_notify = App\Request_info::select()
                                                ->where('idClient', '=', $idClient)
                                                ->where('status', '!=', '0')
                                                ->orderBy('responseTime', 'desc')
                                                ->get();
                                $count = count($list_notify);
                            ?>
                            <a href="dropdownMenu1" class="dropdown-toggle" type="button">
                                <img id="notification" src="{{ asset('images/notification.png') }}" alt="">
                                <span class="badge" style="float: right;">{{ $count }}</span>   
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="top:60px; right: -45px; width: 350px; min-height: 50px; max-height: 270px; overflow-y: auto;">
                                <li style="text-align: center;"><h4>Notificaion board</h4></li>
                                <li role="separator" class="divider"></li>
                                @foreach ($list_notify as $element)
                                    <?php 
                                        $Ename = App\Employee::where('idEmployee', '=', $element->idEmployee2)->first()->E_Name;
                                    ?>  
                                    @if ($element->status == 1)
                                        <li><a href="{{ url('/employee-information') }}" style="white-space: normal;">Your request to see <b>{{ $Ename }}</b>'s information has been accepted.</a></li>
                                        <li role="separator" class="divider"></li>
                                    @else
                                        <li><a href="{{ url('/employee-information') }}" style="white-space: normal;">Your request to see <b>{{ $Ename }}</b>'s information has been rejected.</a></li>
                                        <li role="separator" class="divider"></li>
                                    @endif
                                @endforeach
                            </ul>   

                        @else
                            <?php
                                $idAccount = Auth::user()->idAccount;
                                $idEmployee = App\Employee::select()
                                                ->where('idAccount', '=', $idAccount)->first()
                                                ->idEmployee;
                                $list_notify = App\RequestE_E::select()
                                                ->where('idEmployee1', '=', $idEmployee)
                                                ->where('status', '!=', '0')
                                                ->orderBy('responseTime', 'desc')
                                                ->get();
                                $count = count($list_notify);
                            ?>
                            <a href="#" class="dropdown-toggle" type="button">
                                <img id="notification" src="{{ asset('images/notification.png') }}" alt="">
                                <span class="badge" style="float: right;">{{ $count }}</span>   
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="top:60px;right: -45px; width: 350px; min-height: 50px; max-height: 270px; overflow-y: auto; ">
                                <li style="text-align: center;"><h4>Notificaion board</h4></li>
                                <li role="separator" class="divider"></li>
                                @foreach ($list_notify as $element)
                                    <?php 
                                        $Ename = App\Employee::where('idEmployee', '=', $element->idEmployee2)->first()->E_Name;
                                    ?>  
                                    @if ($element->status == 1)
                                        <li><a href="{{ url('/employee-information') }}" style="white-space: normal;">Your request to see <b>{{ $Ename }}</b>'s information has been accepted.</a></li>
                                        <li role="separator" class="divider"></li>
                                    @else
                                        <li><a href="{{ url('/employee-information') }}" style="white-space: normal;">Your request to see <b>{{ $Ename }}</b>'s information has been rejected.</a></li>
                                        <li role="separator" class="divider"></li>
                                    @endif
                                @endforeach
                            </ul> 

                        @endif 

                    </div>
                    @endif
                    <div class="dropdown" style="z-index:2001">
                        <a class="dropdown-toggle" href="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img id="user" src="{{ asset('images/user.png') }}" alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="top:60px;left:-50px">
                            @if (Auth::user()->idRole != 1)
                                <li><a href="/personal-information">{{ Auth::user()->idRole == 4 ? (App\Clients::where('idAccount','=',Auth::user()->idAccount)->first()->ClientName) :( Auth::user()->idRole == 6 ? App\Client_Company::where('idAccount','=',Auth::user()->idAccount)->first()->CC_Name : App\Employee::where('idAccount','=',(Auth::user()->idAccount))->first()->E_EngName) }}</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a data-toggle="modal" href='#change-password'>Change password</a></li>
                                <li role="separator" class="divider"></li>
                            @endif
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <nav role="navigation" class="navbar navbar-default" style="clear:both">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button" style="margin-top:0px;">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse" id="content-menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/employee-information') }}">Employee Information</a></li>
                            @if (Auth::user()->idRole != 1)
                            <li class="dropdown ">
                                <a href="#" data-toggle="dropdown" class=" dropdown-toggle">Project Management   <span class="caret"></span></a>
                                <ul class="dropdown-menu" id="project-dropdown">
                                    <li style="width:100%"><a href="{{ url('project') }}">Project Management</a></li>
                                    @if (Auth::user()->idRole == 2)
                                        <li style="width:100%"><a href="{{ url('team-management') }}">Team Management</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li><a href="{{ url('note') }}">Your Note</a></li>
                            <li><a href="{{ url('project_history') }}">History</a></li>
                            <li><a data-toggle="modal" href='#send-message'>Contact</a></li>
                            @endif
                            <li><a href="#">About us</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
    <div id="content">
        @yield('content')
    </div>
    <div id="footer">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="col-md-4">
                    <p style="font-size:16px;padding-top: 6px">@2016 The Balance Team</p>
                </div>
                <div class="col-md-4">
                    <p>
                        <a href=""><span style="font-size:25px;padding:0 7px"><i class="fa fa-facebook"></i></span></a>
                        <a href=""><span style="font-size:25px;padding:0 7px"><i class="fa fa-twitter"></i></span></a>
                        <a href="skype:eureka.m0198"><span style="font-size:25px;padding:0 7px"><i class="fa fa-skype"></i></span></a>
                    </p>
                </div>
                <div class="col-md-4" style="font-size:16px;padding-top: 6px">Enclave Company</div>
            </div>
            <div class="col-md-1"></div>
    </div>
        <!-- Change password -->
    <div class="modal fade" id="change-password">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Change password</h4>
                </div>
                <div class="modal-body">
                    <div class="change-pass-container">
                        <form id="form-change-pass" method="POST" action="{{ url('/change-password') }}">
                        {!! csrf_field() !!}
                            <div class="input-text">
                                <p>Current password:</p>
                                <input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Current password"></input>
                            </div>
                            <div class="input-text">
                                <p>New password:</p>
                                <input type="password" class="form-control"  id="new_pass" name="new_pass" placeholder="New password"></input>
                            </div>
                            <div class="input-text">
                                <p>Comfirm password:</p>
                                <input type="password" class="form-control" id="renew_pass" name="renew_pass" placeholder="Comfirm password"></input>
                            </div>
                            <div class="change-pass-button modal-footer"    >
                                <input type="submit" name="button" id="save-button" class="btn btn-primary" value="Save"></input>
                                <a class="btn btn-default" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  <!--change password -->
             <!-- Messagebox after change password!-->
            <div>
                @if(Session::has('message1'))
                    <a data-toggle="modal" id="modal" href='#modal-id'></a>
                    <div class="modal fade" id="modal-id">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                        {{Session::get('message1')}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" href='#change-password'>OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 @elseif (Session::has('message2'))
                    <a data-toggle="modal" id="modal1" href='#modal-id1'></a>
                    <div class="modal fade" id="modal-id1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                        {{Session::get('message2')}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
            </div>

        <div class="modal fade" id="send-message">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Send Message to Admin</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/send-message') }}" method="POST" accept-charset="utf-8" id="form-contact">
                        {{csrf_field()}}
                            <textarea name="message" rows="8" cols="55" placeholder="Enter your message"></textarea>
                            <div class="send-message-button modal-footer">
                                <input type="submit" name="button" id="save-button" class="btn btn-primary" value="Send"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

            <!-- Notification after sending message!-->
            <div>       
                @if(Session::has('mess1'))            
                    <a data-toggle="modal" id="mess1" href='#mess1-id'></a>
                    <div class="modal fade" id="mess1-id">
                        <div class="modal-dialog">
                            <div id="my-modal" class="modal-content">
                                <div class="modal-body">
                                        {{Session::get('mess1')}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 @elseif (Session::has('mess2'))
                    <a data-toggle="modal" id="mess2" href='#mess2-id1'></a>
                    <div class="modal fade" id="mess2-id1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                        {{Session::get('mess2')}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" href='#send-message'>OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
            </div>

        <script src="{{ asset('third-library/jquery/jquery-2.2.3.min.js') }}"></script>
        <!-- Bootstrap JavaScript -->
        <script src="{{ asset('third-library/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-validate/jquery.validate.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-validate/additional-methods.js') }}"></script>
        
        <script src="{{ asset('js/custom.js') }}"></script>
        
         <!-- Change password validate -->
        <script type="text/javascript">
        $('#form-change-pass').validate({
            rules:{
                old_pass:{
                    required:true,
                    // remote:{
                    //     url:"{{asset('check/check-pass')}}",
                    //     type:"POST",
                    //     data: {
                    //         '_token': $('input[name=_token]').val()
                    //     }
                    // }       
                },
                new_pass:{
                    required:true,  
                    minlength:6,
                    maxlength:16,
                    notEqualTo: "#old_pass"
                },
                renew_pass:{
                    equalTo:"#new_pass"
                }
            },
            messages:{
                old_pass:{
                    required:"Please enter your current password!",
                    //remote: "Your current password is inconrrect!"
                },
                new_pass:{
                    required:"Please enter your new password!",
                    minlength:"Min length password is equal or more than 6!",
                    maxlength:"Max length password is equal or less than 16!",
                    notEqualTo: "New password and current password must not match!"
                },
                renew_pass:{
                    equalTo:"New password and password confirm must match!"
                }
            }
        });
    </script> <!-- Change password validate -->
    <script>
            jQuery(function(){
               jQuery('#modal').click();
            });
             jQuery(function(){
               jQuery('#modal1').click();
            });
        $('#modal-id').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
        $('#modal-id1').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
        $('#form-change-pass').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
        </script>

    <!-- contact -->
        <script type="text/javascript">
            $('#form-contact').validate({
                rules: {
                    message: {
                        required: true,
                        minlength: 4
                    }
                },
                messages: {
                    message: {
                        required: "Enter content of your message.",
                        minlength: "Message should has length more than 4 characters."
                    }
                }
            });
        </script>

        <script>
                jQuery(function(){
                   jQuery('#mess1').click();
                });
                 jQuery(function(){
                   jQuery('#mess2').click();
                });
            $('#mess1-id').on('show.bs.modal', function (e) {
                $('body').addClass('test');
            });
            $('#mess2-id1').on('show.bs.modal', function (e) {
                $('body').addClass('test');
            });
            $('#form-contact').on('show.bs.modal', function (e) {
                $('body').addClass('test');
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                setTimeout(function(){
                    $("#my-modal").hide();
                },4000);
            });
        </script>
        @yield('script')
    </body>
</html>
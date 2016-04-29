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
    <link href="{{ asset('css/admin/master.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/message.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/animate.css') }}">
    @yield('css')
</head>

<body>
    <div class="containfer-fluid">
        <div id="left-bar" class="col-md-3">
            <div class="logo">
                <h4>Enclave Admin System</h4>
            </div>
            <div id="nav">
                <ul>
                    <li class="account"><a href="{{ url('admin/personal-information') }}"><i class="fa fa-lock" aria-hidden="true"></i>Personal Information</a></li>
                    <li class="project"><a href="{{ url('admin/project') }}"><i class="fa fa-folder-open" aria-hidden="true"></i>Project Management</a></li>
                    <li class="statistics"><a href="{{ url('admin/stastics') }}"><i class="fa fa-area-chart" aria-hidden="true"></i>Statistics</a></li>
                    <li class="note"><a href="{{ url('admin/note') }}"><i class="fa fa-book" aria-hidden="true"></i>Note</a></li>
                    <li class="system_history"><a href="{{ url('admin/history_system') }}"><i class="fa fa-book" aria-hidden="true"></i>Project History</a></li>
                    <li class="feeback_history"><a href="{{ url('admin/history_feedback') }}"><i class="fa fa-calendar" aria-hidden="true"></i>Feedback History</a></li>
                    <li class="aditional additionalmanagement">
                        <ul class="nav nav-stacked" id="add-menu">
                            <li class="" ><a href="#"><span><i class="fa fa-plus" aria-hidden="true"></i></span>Additional Management</a></li>
                            <li class="addnewskill"><a href="{{ url('/admin/add-skill') }}"><span><i class="fa fa-globe" aria-hidden="true"></i></span>Develop skill</a></l i>
                            <li class="englishrecord"><a href="{{ url('/admin/add-english-record') }}"><span><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>English record</a></li>
                        </ul>
                    </li>
                    <li id="sign-out-collapse"><a href="{{ url('logout') }}"><i class="glyphicon glyphicon-off"></i>Sign out</a></li>
                </ul>
            </div>
        </div>
        <div id="maincontent">
            <div id="topbar">
                <ul id="action">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    
                    <!-- Messsage -->
                    <?php
                       $servername = "localhost";
                       $username = "root";
                       $password = "1234";
                       $dbname = "MainDB";
                 
                       // Create connection
                 
                       $conn = new mysqli($servername, $username, $password, $dbname);
                 
                       // Check connection
                 
                       if ($conn->connect_error) {
                 
                           die("Connection failed: " . $conn->connect_error);
                 
                       } 
                 
                       $sql = "SELECT * from Message where M_Status = '0'";
                       $result = $conn->query($sql);
                       $row = $result->fetch_assoc();
                       $count = $result->num_rows;
                       $conn->close();
                    ?>
                    <li>
                        <a class="dropdown-toggle" href="" data-toggle="dropdown" id="notificationLink"><i class="fa fa-envelope-o"></i>
                            <span class="badge badge1">{{ $count }}</span>
                        </a>
                        <div class="dropdown-menu" id="in" style="padding: 3px 0px 0px;margin-right: 240px; left: 530px;">
                            <div id="notificationTitle">Message</div>
                            <div id="notificationsBody" class="notifications" style="height: 330px; overflow-x: hidden; overflow-y: auto;">
                                <?php
                                    $list_message = DB::table('Message')->select('*')->where('M_Status','=','0')->get();
                                ?>
                                @foreach( $list_message as $idmessage )
                                    <div>                               
                                        <td onclick="">{{ $idmessage->sender }} has sent a message for you</td>
                                    </div class="horizontal-line">
                                    <!-- <td>{{ $idmessage->dateSend }}</td> -->
                                    <br>             
                                @endforeach
                            </div>
                            <div id="notificationFooter"><a href="{{ url('/admin/message') }}" id="ft_see" style="color: #fff">See All</a></div>
                        </div>
                    </li>                      
                    <!-- End Message -->    
                    <?php 
                        $countC_E = count(App\Request_info::select()
                                    ->where('status', '=', '0')->get());
                        $countE_E = count(App\RequestE_E::select()
                                    ->where('status', '=', '0')->get());
                        $count = $countC_E + $countE_E;
                    ?>
                    <li><a href="{{ url('/admin/request-notify') }}"><i class="fa fa-flag-o" aria-hidden="true"></i><span class="badge">{{ $count }}</span></a></li>
                    <li class="sign-out"><a href="{{ url('logout') }}"><i class="glyphicon glyphicon-off"></i></a></li>
                    <li class="divider"></li>
                    <li class="toggle" sign="collapse"><a href="#"><i class="fa fa-bars"></i></a></li>
                </ul>
            </div>
            <div id="content">
                <div class="row">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="hide-collapse pull-right" data-toggle="collapse" data-target="#panel-content"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                <a class="collapse show-collapse pull-right" data-toggle="collapse" data-target="#panel-content"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            </div>
                            <div class="clearfix"></div>
                            <div id="panel-content" class="collapse in">
                                <div class="panel-body">
                                    Basic panel example
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
            </div>
        </div>
    </div>  
    <!-- jQuery -->
    <script src="{{ asset('third-library/jquery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap JavaScript -->
    <script src="{{ asset('third-library/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
    jQuery(document).ready(function($) {
        $('.toggle > a').click(function(event) {
            if($(this).parent().attr('sign') == 'collapse'){
                $(this).parent().removeAttr('sign');
                $('#content').addClass('margin-top-320');
                $('#left-bar > #nav').addClass('block-display');
                $('#left-bar > #nav').addClass('animated fadeInDownBig');
            }
            else{
                $(this).parent().attr('sign', 'collapse');
                $('#content').removeClass('margin-top-320');
                $('#left-bar > #nav').removeClass('block-display');
            }
        });
    });
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('.glyphicon-chevron-down').parent().click(function(event) {
                $('.show-collapse').removeClass('collapse');
                $(this).hide();
            });
            $('.glyphicon-chevron-up').parent().click(function(event) {
                $(this).addClass('collapse');
                $('.glyphicon-chevron-down').parent().show();
            });
        });
        $(document).ready(function(){    
            $('#add-menu').hover(function(){
                    $('#add-menu .addnewskill').toggle(100);
                    $('#add-menu .englishrecord').toggle(100);
            });
        });
    </script>
    @yield('script')
</body>
</html>

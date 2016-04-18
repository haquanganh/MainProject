<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('third-library/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('third-library/font-awesome-4.6.1/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('third-library/animate.css') }}">
    <!-- styles -->
    <link href="{{ asset('css/admin/master.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    <div class="container-fluild">
        <div id="nav" class="row">
            <div class="col-md-12" style="margin-bottom: 0px;">
                <div id="title" class="pull-left">
                    <img src="{{ asset('images/DB1.png') }}">
                    <span style="font-size: 32px;">@yield('name')</span>
                </div>
                <div id="notify" class="pull-right">
                    <a href="#" class="glyphicon glyphicon-home"></a>
                    <div class="vertical-line" ></div>
                    <a href="#"><i class="fa fa-envelope-o"></i> <span>Messsage</span></a>
                    <div class="vertical-line" ></div>
                    <a href="{{ url('/admin/request-notify') }}"><i class="fa fa-flag"></i> <span>Notification</span></a>
                    <div class="vertical-line" ></div>
                    <a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i><span>Logout</span</a>
                    <a href="javascript:void(0)" class="btn-collapse" check="0"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
</a>
                </div>
            </div>
        </div>
        <div id="content" class="row">
            <div id="left-bar" class="col-md-3">
                <ul id="menu" class="nav nav-stacked">
                    <li class="account"><a href="{{ url('admin/personal-information') }}">Account Management</a></li>
                    <li class="project"><a href="{{ url('admin/project') }}">Project Management</a></li>
                    <li class="stastics"><a href="{{ url('admin/stastics') }}">Statistic</a></li>
                    <li class="note"><a href="#">Note</a></li>
                    <li class="historysystem"><a href="{{ url('admin/history_system') }}">History System</a></li>
                    <li class="historyfeedback"><a href="{{ url('admin/history_feedback') }}">History Feedback</a></li>
                </ul>
            </div>
            <div id="main-content" class="col-md-9">
            <br>
            @yield('content')
            </div>
        </div>
        <div id="footer" class="row">
            <div class="col-md-12"></div>
        </div>
    </div>
    <script src="{{ asset('third-library/jquery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap JavaScript -->
    <script src="{{ asset('third-library/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $('document').ready(function(){
            $('.btn-collapse').click(function(){
                if($(this).find("i").hasClass('fa-caret-square-o-down')){
                    $('#left-bar > ul').css('display','inline').animate();
                    $(this).find("i").removeClass('fa-caret-square-o-down');
                    $(this).find("i").addClass('fa-caret-square-o-up');
                }
                else{
                    $('#left-bar > ul').css('display','none');
                    $(this).find("i").removeClass('fa-caret-square-o-up');
                    $(this).find("i").addClass('fa-caret-square-o-down');
                }
            });
        });
    </script>
    @yield('script')
</body>
</html>
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
                    <div class="arrow" style="float:left"></div>
                    <h4 class="pull-right" style="margin-top: 15px!important;font-size: 25px;margin-left: 30px;">Account Management</h4>
                </div>
                <div id="notify" class="pull-right">
                    <a href="#" class="glyphicon glyphicon-home"></a>
                    <div class="vertical-line"></div>
                    <a href="#"><i class="fa fa-envelope-o"></i><span> Messsage</span></a>
                    <div class="vertical-line"></div>
                    <?php 
                        $countC_E = count(App\Request_info::select()
                                    ->where('status', '=', '0')->get());
                        $countE_E = count(App\RequestE_E::select()
                                    ->where('status', '=', '0')->get());
                        $count = $countC_E + $countE_E;
                    ?>
                    <a href="{{ url('/admin/request-notify') }}"><i class="fa fa-flag"></i>Notification <span class="badge">{{ $count }}</span></a>
                    <div class="vertical-line"></div>
                    <a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i><span> Logout</span</a>
                    <a href="javascript:void(0)" class="btn-collapse" check="0"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
</a>
                </div>
            </div>
        </div>
        <div id="content" class="row">
            <div id="left-bar" class="col-md-3">
                <ul id="menu" class="nav nav-stacked">
                    <li class="account"><a href="{{ url('admin/personal-information') }}"><span><i class="fa fa-lock" aria-hidden="true"></i></span>Account Management</a></li>
                    <li class="project"><a href="{{ url('admin/project') }}"><span><i class="fa fa-folder-open" aria-hidden="true"></i></span>Project Management</a></li>
                    <li class="stastics"><a href="{{ url('admin/stastics') }}"><span><i class="fa fa-area-chart" aria-hidden="true"></i></span>Statistic</a></li>
                    <li class="note"><a href="#"><span><i class="fa fa-book" aria-hidden="true"></i></span>Note</a></li>
                    <li class="historysystem"><a href="{{ url('admin/history_system') }}"><span><i class="fa fa-clock-o" aria-hidden="true"></i></span>History System</a></li>
                    <li class="historyfeedback"><a href="{{ url('admin/history_feedback') }}"><span><i class="fa fa-calendar" aria-hidden="true"></i></span>History Feedback</a></li>
                </ul>
            </div>
            <div id="main-content" class="col-md-9">
            <br>
            @yield('content')
            </div>
        </div>
        <!-- <div id="footer" class="row">
            <div class="col-md-12"></div>
        </div> -->
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
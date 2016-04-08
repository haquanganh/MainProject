<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
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
                    <span style="font-size: 32px;">Acount Management</span>
                </div>
                <div id="notify" class="pull-right">
                    <a href="#" class="glyphicon glyphicon-home"></a>
                    <div class="vertical-line" ></div>
                    <a href="#"><i class="fa fa-envelope-o"></i> Messsage</a>
                    <div class="vertical-line" ></div>
                    <a href="#"><i class="fa fa-flag"></i> Notification</a>
                    <div class="vertical-line" ></div>
                    <a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i>Logout</a>
                </div>
            </div>
        </div>
        <div id="content" class="row">
            <div id="left-bar" class="col-md-3">
                <ul id="menu" class="nav nav-stacked">
                    <li class="account"><a href="{{ url('admin/personal-information') }}">Account Management</a></li>
                    <li class="project"><a href="{{ url('admin/project') }}">Project Management</a></li>
                    <li class="stastics"><a href="#">Statistic</a></li>
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
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    @yield('script')
</body>

</html>
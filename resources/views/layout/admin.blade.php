<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- styles -->
    <link href="{{ asset('css/admin/master.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <!-- Logo -->
                    <div class="logo">
                        <h1><a href="index.html">@yield('name')</a></h1>
                    </div>
                </div>
                <div class="col-md-5">
                </div>
                <div class="col-md-2">
                    <div class="navbar navbar-inverse" role="banner">
                        <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Anh (Astro) Q.Ha  <b class="caret"></b></a>
                                    <ul class="dropdown-menu animated fadeInUp">
                                        <li><a href="profile.html">My Personal Information</a></li>
                                        <li><a href="login.html">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar content-box" style="display: block;">
                    <ul class="nav">
                        <!-- Main menu -->
                        <li class="current"><a href="index.html"><i class="glyphicon glyphicon-home"></i> History System</a></li>
                        <li><a href="calendar.html"><i class="glyphicon glyphicon-calendar"></i> Account Management</a></li>
                        <li><a href="stats.html"><i class="glyphicon glyphicon-stats"></i> Statistics (Charts)</a></li>
                        <li><a href="tables.html"><i class="glyphicon glyphicon-list"></i> Personal Information</a></li>
                        <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Project Management</a></li>
                        <li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> History Feedback</a></li>
                        <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Note</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
            @yield('content')
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="copy text-center">
                Copyright 2016- Balance Team
            </div>
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
    @yield('script')
</body>

</html>
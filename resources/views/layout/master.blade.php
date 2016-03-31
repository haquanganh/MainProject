<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
	    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/unslider/2.0.3/css/unslider.css">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/masterpage.css') }}">
        @yield('css')
	</head>
	<body>
    <div class="container-fluid">
		<div id="header">
            <div class="container">
                <div id="tophead">
                    <a href="#" class="logo"><img src="{{ asset('images/enclave_logo.png') }}"></a>
                    <div class="dropdown" style="z-index:2001">
                        <a class="dropdown-toggle" href="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img src="{{ asset('images/user.png') }}" alt="" style="width:52px;height:52px">
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="/personal-information">Anh (Astro) Q. Ha</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Change password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                        <a href="#" class="dropdown-toggle" type="button">
                            <img src="{{ asset('images/notification.png') }}" alt="" style="width:52px;height:52px">
                        </a>
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
                            <li><a href="#">Employee Information</a></li>
                            <li class="dropdown ">
                                <a href="#" data-toggle="dropdown" class=" dropdown-toggle">Project Management   <span class="caret"></span></a>
                                <ul class="dropdown-menu" id="project-dropdown">
                                    <li style="width:100%"><a href="/project">Project Management</a></li>
                                    <li style="width:100%"><a href="#">Team Management</a></li>
                                </ul>
                            </li>
                            <li><a href="">Statistic</a></li>
                            <li><a href="#">Note</a></li>
                            <li><a href="#">History</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">About us</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>

            <!-- #header -->
        </div>
    <div id="content">
        @yield('content')
    </div>
    <div id="footer" style="text-align:center; padding:30px 0px 130px 0;">
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
        <script src="https://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    	</div>
        @yield('script')
        <script src="{{ asset('js/custom.js') }}"></script>
	</body>
</html>
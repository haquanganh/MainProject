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

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div id="header">
        <div id="tophead">
            <a href="#" class="logo"><img src="{{ asset('images/enclave_logo.png') }}"></a>
            <div class="dropdown">
                <button class="btn btn-default btn-lg dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span aria-hidden="true" class="glyphicon glyphicon-user"></span></button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="/personal-information">Anh (Astro) Q. Ha</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Change password</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
                <button class="btn btn-default btn-lg" type="button"><span aria-hidden="true" class="glyphicon glyphicon-flag"></span></button>
            </div>
        </div>
        <nav role="navigation" class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Employee Information</a></li>
                        <li>
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Project Management   <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Project Management</a></li>
                                <li><a href="#">Team Management</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Statistic</a></li>
                        <li><a href="#">Note</a></li>
                        <li><a href="#">History</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">About us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <!-- #header -->
    </div>
    <div id="content">
        @yield('content')
    </div>
    <div id="footer">
        <div class="clear40"></div>
        <div class="row">
            <div class="col-md-4 img"><img src="{{ asset('images/enclave_logo.png') }}"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
        <br>
        <p class="copyright">© 2007 - 2015 Enclave ODC, Ltd. All Rights Reserved. Terms and Conditions.</p>
        <div class="social-icon pull-right">
            <a href=""><i class="fa fa-facebook"></i></a>
            <a href=""><i class="fa fa-twitter"></i></a>
            <a href=""><i class="fa fa-skype"></i></a>
        </div>
        <br>
        <hr>
        <div class="information">
            <div class="row">
                <div class="col-md-6">
                    <p>Trụ sở chính: 17 Lê Duẩn, Phường Bến Nghé, Quận 1, TP Hồ Chí Minh</p>
                    <p>Văn phòng đại diện tại Đà Nẵng: 453-455 Hoàng Diệu, Quận Hải Châu, TP Đà Nẵng</p>
                </div>
                <div class="col-md-6">
                    <p>Tên đơn vị: Technology Resources Vietnam Limited</p>
                    <p>Người đại diện: Richard Anthony William Yvanovich</p>
                    <p>Số giấy chứng nhận đăng ký kinh doanh: 411043000753</p>
                </div>
            </div>
        </div>
    </div>
        
        <script src="https://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    	<script src="{{ asset('js/custom.js') }}"></script>
        @yield('script')
	</body>
</html>
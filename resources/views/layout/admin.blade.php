<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- styles -->
    <link href="{{ asset('css/admin/master.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    <div class="container-fluild">
        <div id="header">
            <div class="row" style="height: 100%">
                <div class="col-md-12" style="height: 100%">
                    <div class="title pull-left"><h3>Admin Daskboard</h3></div>
                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Tutorials
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HTML</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSS</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">JavaScript</a></li>
                          <li role="presentation" class="divider"></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Menu 1</a></li>
                    <li><a href="#">Menu 2</a></li>
                    <li><a href="#">Menu 3</a></li>
                  </ul>
            </div>
            <div class="col-md-10">
                @yield('content')
            </div>
        </div>
        <div id="footer"></div>
    </div>
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    @yield('script')
</body>

</html>
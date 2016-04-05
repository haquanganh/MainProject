<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $__env->yieldContent('title'); ?></title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
	    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/unslider/2.0.3/css/unslider.css">
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/masterpage.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/change_pass.css')); ?>">
        <?php echo $__env->yieldContent('css'); ?>
	</head>
	<body>
    <div class="container-fluid">
		<div id="header">
            <div class="container">
                <div id="tophead">
                    <a href="#" class="logo"><img src="<?php echo e(asset('images/enclave_logo.png')); ?>"></a>
                    <a href="#" class="dropdown-toggle" type="button">
                            <img id="notification" src="<?php echo e(asset('images/notification.png')); ?>" alt="">
                    </a>
                    <div class="dropdown" style="z-index:2001">
                        <a class="dropdown-toggle" href="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img id="user" src="<?php echo e(asset('images/user.png')); ?>" alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="top:60px;left:-50px">
                            <li><a href="/personal-information">Anh (Astro) Q. Ha</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a data-toggle="modal" href='#change-password'>Change password</a></li>
                            <li role="separator" class="divider"></li>
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
                            <li><a href="<?php echo e(url('/employee-information')); ?>">Employee Information</a></li>
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
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <div id="footer">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="col-md-4">
                    <p style="font-size:16px;padding-top: 6px">@2016  The Balance Team</p>
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
    </div> <!--Footer-->


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
                        <form id="form-change-pass" method="POST" action="<?php echo e(url('/change-password')); ?>">
                        <?php echo csrf_field(); ?>

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
                <?php if(Session::has('message1')): ?>            
                    <a data-toggle="modal" id="modal" href='#modal-id'></a>
                    <div class="modal fade" id="modal-id">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                        <?php echo e(Session::get('message1')); ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" href='#change-password'>OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php elseif(Session::has('message2')): ?>
                    <a data-toggle="modal" id="modal1" href='#modal-id1'></a>
                    <div class="modal fade" id="modal-id1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                        <?php echo e(Session::get('message2')); ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php endif; ?>
            </div>

        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/jquery-validate/jquery.validate.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/jquery-validate/additional-methods.js')); ?>"></script>
    </div>
        <?php echo $__env->yieldContent('script'); ?>
        <script src="<?php echo e(asset('js/custom.js')); ?>"></script>

         <!-- Change password validate -->
        <script type="text/javascript">
        $('#form-change-pass').validate({
            rules:{
                old_pass:{
                    required:true,
                    // remote:{
                    //     url:"<?php echo e(asset('check/check-pass')); ?>",
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
        </script>
	</body>
</html>
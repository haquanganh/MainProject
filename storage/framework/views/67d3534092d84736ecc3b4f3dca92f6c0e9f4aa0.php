<?php $__env->startSection('title','Home page'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/project.css')); ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="clear20" style="height: 20px"></div>
            <div id="img-title">
                <p>Project Management</p>
           </div>
            <div class="container">
                <div class="row" style="margin-bottom: 0px;margin-left:20px;margin-right:20px">
                    <h4 style="margin-left:15px;float:left"><i>In progress</i></h4>
                    <div class="project_select pull-right">
                        <form action="" method="POST" role="form">
                            <select class="list">
                                <option value="1">In progress</option>
                                <option value="2">Done</option>
                            </select>
                            <?php
                                    $idRole = Auth::user()->idRole;
                             ?>
                            <?php if($idRole == 2): ?>
                                <a href="/create-project" class="add"><img src="images/add-new-icon.png" style="width:50px;height:50px;" alt=""></a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <hr>
                <?php
                        $idEmployee = App\Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
                        $projects_PM = App\Project::where('idPStatus','=',1)->where('idPManager','=',$idEmployee)->get();
                        $projects_LD = App\Project::where('idPStatus','=',1)->where('idTeamLeader','=',$idEmployee)->get();
                        $project_TM = App\Employee::find($idEmployee)->Project;
                ?>
                <?php if(Session::has('flat')): ?>
                    <div class="alert alert-success" role="alert"><?php echo e(Session('flat')); ?></div>
                <?php endif; ?>
                <div class="row folder">
                <?php foreach($projects_PM as $l): ?>
                    <div class="col-md-3 projects">
                        <div class="content-box-large" onclick="window.location='<?php echo e(url('project_detail')); ?>/<?php echo e($l->idProject); ?>'">
                            <p class="name-project"><b><?php echo e($l->P_Name); ?></b></p>
                            <p class="time-project"><i><?php echo e($l->P_DateCreate); ?> <span>-</span><?php echo e($l->P_DateFinish); ?></i></p>

                        </div>
                    </div>
                <?php endforeach; ?>
                <?php foreach($projects_LD as $l): ?>
                    <div class="col-md-3 projects">
                        <div class="content-box-large" onclick="window.location='<?php echo e(url('project_detail')); ?>/<?php echo e($l->idProject); ?>'">
                            <p><b><?php echo e($l->P_Name); ?></b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i><?php echo e($l->P_DateCreate); ?> <span>-</span><?php echo e($l->P_DateFinish); ?></i></p>

                        </div>
                    </div>
                <?php endforeach; ?>
                <?php foreach($project_TM as $l): ?>
                    <div class="col-md-3 projects">
                        <div class="content-box-large" onclick="window.location='<?php echo e(url('project_detail')); ?>/<?php echo e($l->idProject); ?>'">
                            <p><b><?php echo e($l->P_Name); ?></b></p>
                            <br>
                            <br>
                            <p class="pull-right"><i><?php echo e($l->P_DateCreate); ?><span>-</span> <?php echo e($l->P_DateFinish); ?></i></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".list").select2();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
               setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 2000);
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.list').change(function(){
                var idPStatus = $(this).val();
                var idAccount = <?php echo e(Auth::user()->idAccount); ?>;
                var list_n = $('.projects').length;
                $.ajax({
                    url: '<?php echo e(url('/get-listProject')); ?>',
                    type: 'GET',
                    cache: false,
                    data:{"idAccount" : idAccount,"idPStatus" :idPStatus},
                    success: function(data){
                        var result = $.parseJSON(data);
                        if(data != 'Empty'){
                            if(list_n > 0){
                                $('.projects').remove();
                            }
                           $.each( result[0], function( key, value ) {
                                $('.folder').append('<div class="col-md-3 projects"><div class="content-box-large" onclick="window.location=\''+'<?php echo e(url('project_detail')); ?>/'+value.idProject+'\';"><p class="name-project"><b>'+value.P_Name+'</b></p><br><br><p class="time-project"><i>'+value.P_DateStart+'<span>-</span>'+value.P_DateFinish+'</i></p></div></div>');
                           });
                           $.each( result[1], function( key, value ) {
                                $('.folder').append('<div class="col-md-3 projects"><div class="content-box-large" onclick="window.location=\''+'<?php echo e(url('project_detail')); ?>/'+value.idProject+'\';"><p class="name-project"><b>'+value.P_Name+'</b></p><br><br><p class="time-project"><i>'+value.P_DateStart+'<span>-</span>'+value.P_DateFinish+'</i></p></div></div>');
                           });
                           $.each( result[2], function( key, value ) {
                                if(value.idPStatus == idPStatus){
                                    $('.folder').append('<div class="col-md-3 projects"><div class="content-box-large" onclick="window.location=\''+'<?php echo e(url('/project_detail')); ?>/'+value.idProject+'\';"><p class="name-project"><b>'+value.P_Name+'</b></p><br><br><p class="time-project"><i>'+value.P_DateStart+'<span>-</span>'+value.P_DateFinish+'</i></p></div></div>');
                                }
                           });
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
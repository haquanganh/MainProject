<?php $__env->startSection('title','Edit Project'); ?>
<?php $__env->startSection('css'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/edit_project.css')); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="img-title">
                <p>Edit Project</p>
            </div>
            <div class="clear40" style="height: 20px;"></div>
            <form class="form-inline" role="form" method="POST" action="<?php echo e(url('/project/edit')); ?>/<?php echo e($project->idProject); ?>">
            <?php echo e(csrf_field()); ?>

                <div class="info row" style="margin-bottom: 10px">
                    <div class="col-xs-3 form-group <?php echo e($errors->has('in_PName') ? ' has-error' : ''); ?> validate"  <?php echo $errors->has('in_PName') ? ' data-toggle="tooltip" data-placement="top" title="'.$errors->first('in_PName').'"' : ''; ?>>
                        <label for=""><i>Project</i></label>
                        <input type="text" name="in_PName" class="form-control " placeholder="Name Of Project" value="<?php echo e($project->P_Name); ?>">
                    </div>
                    <div class="col-xs-3 form-group">
                        <label for=""><i>Client</i></label>
                        <?php
                            $clients = App\Clients::all();
                        ?>
                        <select class="list" name="sl_Client">
                        <?php foreach($clients as $c): ?>
                            <option value="<?php echo e($c->idClient); ?>" <?php echo e($c->idClient == $project->idClient ? 'selected' : ''); ?>><?php echo e($c->ClientName); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-3 form-group <?php echo e($errors->has('wrong_day') || $errors->has('wrong_start_day') ? ' has-error' : ''); ?> validate"  <?php echo $errors->has('wrong_start_day') ? ' data-toggle="tooltip" data-placement="top" title="'.$errors->first('wrong_start_day').'"' : ($errors->has('wrong_day') ? ' data-toggle="tooltip" data-placement="top" title="'.$errors->first('wrong_day').'"' :''); ?> >
                        <label for=""><i>Time</i></label>
                        <?php
                            $sd = new DateTime($project->P_DateStart);
                            $ed = new DateTime($project->P_DateFinish);
                            $startday = $sd->format('m/d/y');
                            $endday = $ed->format('m/d/y');
                        ?>
                        <input type="text" name="daterange"  class="form-control" value="<?php echo e($startday); ?> - <?php echo e($endday); ?>" />
                    </div>
                    <div class="col-xs-3 form-group">
                        <label for=""><i>Project Status</i></label>
                        <select class="list" name="sl_PStatus">
                            <option value="1" <?php echo e($project->idPStatus == '1' ? 'selected' : ''); ?>>In progress</option>
                            <option value="2" <?php echo e($project->idPStatus == '2' ? 'selected' : ''); ?>>Done</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="">
                    <div class="row table-responsive">
                        <div class="row table-responsive">
                            <div class="col-xs-12">
                                <table class="table table-striped table-bordered table-responsive results text-center">
                                    <thead >
                                        <tr>
                                            <td>Avatar</td>
                                            <td>English name</td>
                                            <td>Full Name</td>
                                            <td>Email</td>
                                            <td>Choose</td>
                                            <td>Leader</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $idPManager = $project->idPManager;
                                        $team_employees = App\Team::where('idPmanager','=',$idPManager)->first()->Employee;
                                        $project_employees = App\Project::find($project->idProject)->Employee;
                                    ?>
                                    <?php foreach($team_employees as $key=>$e): ?>
                                    <?php if($e->idStatus == 2): ?>
                                        <?php
                                            $check = (array) App\ProjectEmployee::where('idEmployee','=',$e->idEmployee)->where('idProject','=',$project->idProject)->get();
                                        ?>
                                        <tr class="<?php echo e(!empty(array_filter($check)) ? 'TopRow' : ''); ?>" >
                                            <td><img src="<?php echo e(asset('images/personal_images')); ?>/<?php echo e($e->E_Avatar); ?>" class="img img-circle" alt=""></td>
                                            <td><?php echo e($e->E_EngName); ?></td>
                                            <td><?php echo e($e->E_Name); ?></td>
                                            <td><?php echo e($e->E_Skype); ?></td>
                                            <td>
                                                <input class="checkbox" type="checkbox" name="cb[<?php echo e($key); ?>]" <?php echo e(!empty(array_filter($check)) ? 'checked' : ''); ?> data="<?php echo e($e->idEmployee); ?>">
                                            </td>
                                            <td>
                                                <input class="r_leader" type="radio" name="r_leader" value="<?php echo e($e->idEmployee); ?>" <?php echo e($e->idEmployee == $project->idTeamLeader ? 'checked' : ''); ?> <?php echo e(empty(array_filter($check)) ? 'disabled' : ''); ?>></input>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                    <tr class="warning no-result">
                                      <td colspan="6"><i class="fa fa-warning"></i> No result</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:5px;">
                    <div class="col-md-6">
                        <label for=""><i>Search</i></label>
                        <input type="text" class="form-control search" placeholder="Search for employee">
                    </div>
                    <div class="col-md-6">
                        <div class="submit" style="float:right">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <a href="#" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker();
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".list").select2();
    });
    </script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
    <script>
        $(document).ready(function() {
            $(".search").keyup(function() {
                var searchTerm = $(".search").val();
                var listItem = $('.results tbody').children('tr');
                var searchSplit = searchTerm.replace(/ /g, "'):containsi('");
                $.extend($.expr[':'], {
                    'containsi': function(elem, i, match, array) {
                        return (elem.textContent || elem.innerText || '').toLowerCase()
                            .indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });
                $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(
                    function(e) {
                        $(this).attr('visible', 'false');
                    });
                $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
                    $(this).attr('visible', 'true');
                });
                var jobCount = $('.results tbody tr[visible="true"]').length;
                $('.counter').text(jobCount + ' item');
                if (jobCount == '0') {
                    $('.no-result').show();
                } else {
                    $('.no-result').hide();
                }
            });
        });
    </script>
    <script>
        $(".checkbox").click(function() {
            var row = $(this).parents("tr:first");
            $id = $(this).attr('data');
            if ($(this).is(':checked', true)) {
                var firstRow = row.parent().find("tr:first").not(row);
                row.insertBefore(firstRow).addClass("TopRow");
                $(this).parent().parent().find('.r_leader').attr('disabled',false);
                $(this).val($id +',yes');
            } else if (row.hasClass('TopRow')) {
                var nonTopRows = row.siblings().not('.TopRow');
                var found = false;
                nonTopRows.each(function() {
                    if (row.data('pos') < $(this).data('pos') && !found) {
                        found = true;
                        row.insertBefore($(this));
                    }
                });
                if (!found) row.appendTo(row.parent());
                row.removeClass("TopRow");
                $(this).parent().parent().find('.r_leader').attr('disabled',true);
                $old_value = $(this).val();
                $(this).val($id +',no');
            }
        });
    </script>
    <script>
        $('document').ready(function() {
            $('.checkbox:checked').each(function() {
                $id = $(this).attr('data');
                var row = $(this).parents("tr:first");
                if ($(this).is(':checked', true)) {
                    var firstRow = row.parent().find("tr:first").not(row);
                    row.insertBefore(firstRow);
                    $(this).val($id +',yes');
                } else if (row.hasClass('TopRow')) {
                    var nonTopRows = row.siblings().not('.TopRow');
                    var found = false;
                    nonTopRows.each(function() {
                        if (row.data('pos') < $(this).data('pos') && !found) {
                            found = true;
                            row.insertBefore($(this));
                        }
                    });
                    if (!found) row.appendTo(row.parent());
                    row.removeClass("TopRow");

                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
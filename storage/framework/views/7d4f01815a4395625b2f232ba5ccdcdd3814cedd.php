<?php $__env->startSection('title','Employee Information'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/employee_information.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div id="img-title">
        <p>Employee Information</p>
    </div>
    <div class="search-form">
	    <form method="POST" action="<?php echo e(url('/employee-information')); ?>">
	        <?php echo csrf_field(); ?>

	        <input class="btn btn-primary" type="submit" value="Search" ></input>
	        <input class="form-control" id="search" type="text" name="search" placeholder="Enter Name, Skill or Cost/hour" onblur="this.value=removeSpaces(this.value);"></input>
	        <div class="clear"></div>
	    </form>
    </div>
	    <?php if(isset($message)): ?>
	        <div style="text-align: center; font-size: 20px; color: black;">
	            <?php echo e($message); ?>

	        </div>
	    <?php endif; ?>
    <?php if(isset($Listskill)): ?>	
    		<div class="table-responsive" style="padding: 20px;">
           <table class="table table-striped table-bordered results" cellspacing="0" width="100%">
               <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Skype</th>
                            <th>Phone</th>
                            <th>Role</th>

                        </tr>
                </thead>
                <?php foreach($Listskill as $employee): ?>
                    <?php
                        $id_Role = App\User::find($employee->idAccount)->idRole;
                        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
                    ?>
                <tbody>
                    <tr>
                            <td class="img" style="width: 20px;"><img src="<?php echo e(asset('images/personal_images')); ?>/<?php echo e($employee->E_Avatar); ?>" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                            <td><?php echo e($employee->E_Name); ?></td>
                            <td><?php echo e($employee->E_DateofBirth); ?></td>
                            <td><?php echo e($employee->E_Skype); ?></td>
                            <td>0<?php echo e($employee->E_Phone); ?></td>
                            <td><?php echo e($name_Role); ?></td>
                        </tr>
                </tbody>
                <?php endforeach; ?>
           </table>
           </div>
    <?php else: ?> 
    <div class="table-responsive" style="padding: 20px;">
    <table class="table table-striped table-bordered results" cellspacing="0" width="100%">
               <thead>
                        <tr class="info">
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Skype</th>
                            <th>Phone</th>
                            <th>Role</th>

                        </tr>
                </thead>
                <?php foreach($list_employee as $employee): ?>
                    <?php
                        $id_Role = App\User::find($employee->idAccount)->idRole;
                        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
                    ?>
                <tbody>
                    <tr>
                            <td class="img" style="width: 20px;"><img src="<?php echo e(asset('images/personal_images')); ?>/<?php echo e($employee->E_Avatar); ?>" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                            <td><?php echo e($employee->E_Name); ?></td>
                            <td><?php echo e($employee->E_DateofBirth); ?></td>
                            <td><?php echo e($employee->E_Skype); ?></td>
                            <td>0<?php echo e($employee->E_Phone); ?></td>
                            <td><?php echo e($name_Role); ?></td>
                        </tr>
                </tbody>
                <?php endforeach; ?>
           </table>
           </div>
		<?php endif; ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- <script type="text/javascript" src="<?php echo e(asset('js/jquery.quicksearch.js')); ?>"></script>
    <script>
    $(document).ready(function(){
            $('#search').quicksearch('.results tbody tr',{
                'selector': 'th'
            });
    });
        
    </script> -->
    <script language="javascript" type="text/javascript">
        function removeSpaces(string) {
         return string.split(' ').join('');
        }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
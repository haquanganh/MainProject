<?php $__env->startSection('title','Personal Information'); ?>
<?php $__env->startSection('name','Personal Information'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/admin/dataTables.bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/admin/personal_information.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Date of birth</th>
                            <th>Skype</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_employee as $employee): ?>
                    <?php
                        $id_Role = App\User::find($employee->idAccount)->idRole;
                        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
                    ?>
                    <?php if($id_Role != 1): ?>
                        <tr>
                            <td class="img" style="width: 20px;"><img src="<?php echo e(asset('images/personal_images')); ?>/<?php echo e($employee->E_Avatar); ?>" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
                            <td><?php echo e($employee->E_Name); ?></td>
                            <td><?php echo e($employee->E_Sex == 1 ? 'Male' : 'Female'); ?></td>
                            <td><?php echo e($employee->E_DateofBirth); ?></td>
                            <td><?php echo e($employee->E_Skype); ?></td>
                            <td>0<?php echo e($employee->E_Phone); ?></td>
                            <td><?php echo e($name_Role); ?></td>
                            <td><a href="<?php echo e(route('admin.personal-information.edit',$employee->idEmployee)); ?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/admin/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/admin/dataTables.bootstrap.min.js')); ?>"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('body'); ?>
    <div ng-view></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('/js/estrasol/app.js')); ?>" type="text/javascript"></script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
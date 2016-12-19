<!DOCTYPE html>
<html>
    <head>
        <title>Bounce :: Tennis Lifestyle</title>
        <?php echo $__env->make('admin.metas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('admin.style-sheets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </head>
    <body class="fixed-left" ng-app="setpoint" ng-controller="MainCtrl">
        <div id="wrapper">
            <?php echo $__env->make('admin.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <?php echo $__env->yieldContent('body'); ?>
                    </div> <!-- container -->

                </div> <!-- content -->
                <?php echo $__env->make('admin.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php echo $__env->make('admin.menu-derecha', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php echo $__env->make('admin.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>
<!---->
<?php $__env->startSection('body'); ?>
    <nav>
        <ul class="menu sub-menu-productos">
            <li><a href="">POPULARES</a></li>
            <li><a href="">DESCUENTOS</a></li>
            <li><a href="">NUEVOS</a></li>
        </ul>
    </nav>

    <div class="row products">
        <?php foreach($products as $product): ?>
            <?php echo $__env->make('public.blocks.product',[
                'product' => $product
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endforeach; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('public.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
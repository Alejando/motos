<?php $__env->startSection('body'); ?>
    <div class="row products">        
        <?php $__empty_1 = true; foreach($products->items() as $product): $__empty_1 = false; ?>
            <?php echo $__env->make('public.blocks.product', [ 
                'product' => $product,
                'categorySlug' => $categorySlug
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endforeach; if ($__empty_1): ?>
            <h3 style="text-align: center">No se encotraron productos</h3>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('public.base',[
    'showOffert'=>false,
    'showBannerBottom' => false
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
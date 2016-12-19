<?php
$categories = DwSetpoint\Models\Category::getRoots();
$getWidthSubs = function ($subs) {
    $toplength = 0;
    foreach ($subs as $subacategory){
        $lenghName = strlen($subacategory->name);
        if($lenghName>$toplength){
            $toplength = $lenghName;
        }
    }
    $toplength;
    return "$toplength";
}
?>
<div class="cajamenumovil hidden-md hidden-lg">
    <a class="btncatalogo transicion"><i class="fa fa-bars"></i> <span>CATEGORÍAS</span></a>
    <div class="menumainmovil">
        <div class="cajacerrar"><a class="btncerrar transicion"><i class="fa fa-close"></i></a></div>
        
        <?php foreach($categories as $category): ?>
            <?php $subs = $category->subcategories;?>
        
            <?php if($subs->count()): ?>
                <a href="" data-btnsub="<?php echo e(str_slug($category->name)); ?>" class="transicion"><?php echo e(strtoupper($category->name)); ?><i class="fa fa-angle-right pull-right"></i></a>
                <div data-mnusub="<?php echo e(str_slug($category->name)); ?>" class="submenumovil">   
                    <div class="cajacerrar transicion"><a class="btncerrar"><i class="fa fa-close"></i></a></div>
                    <?php foreach($subs as $sub): ?>
                        <?php if($sub->subcategories->count()): ?>
                            <h3><span><?php echo e($sub->name); ?></span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                            <?php foreach($sub->subcategories as $s): ?>
                            <a href="<?php echo e($s->getURL()); ?>" class="transicion"><?php echo e($s->name); ?></a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <h3><span><?php echo e($sub->name); ?></span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <a href="" data-btnsub="" class="transicion"><?php echo e(strtoupper($category->name)); ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
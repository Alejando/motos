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
?><ul class="menumain hidden-sm hidden-xs">
    <?php foreach($categories as $category): ?>
        <?php $subs = $category->subcategories;?>
        <?php if($subs->count()): ?>
            <?php $width = $getWidthSubs($subs)?>
            <li>
                <a href="" class="transicion"><?php echo e(strtoupper($category->name)); ?></a>
                <div class="cajasubmenu" style="width:<?php echo e(($width*$subs->count())+2); ?>em">
                    <div class="row lineaencabezado">                        
                        <?php foreach($subs as $sub): ?>
                            <?php if($sub->subcategories->count()): ?>
                                <div style="width:<?php echo e($width); ?>em; float:left;">
                                    <h3><span><?php echo e($sub->name); ?></span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                                </div>
                            <?php else: ?>
                                <div style="width:<?php echo e($width); ?>em; float:left;">
                                    <h3><a href="<?php echo e($sub->getURL()); ?>"><?php echo e($sub->name); ?></a></h3>
                                </div>
                            <?php endif; ?>                        
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="row">
                        <?php foreach($subs as $sub): ?>
                            <?php if($sub->subcategories->count()): ?>                                
                                <div style="width:<?php echo e($width); ?>em; float:left;">
                                    <ul>
                                        <?php foreach($sub->subcategories as $subc): ?>
                                            <li><a href="<?php echo e($subc->getURL()); ?>"><?php echo e($subc->name); ?></a></li> 
                                        <?php endforeach; ?>                                        
                                    </ul>
                                </div>
                            <?php endif; ?>                            
                        <?php endforeach; ?>                        
                    </div>
                </div>
            </li>
        <?php else: ?>
            <li><a href="<?php echo e($category->getURL()); ?>" class="transicion"><?php echo e(strtoupper($category->name)); ?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
    <li><a href="" class="transicion">DESCUENTOS</a></li>
</ul>
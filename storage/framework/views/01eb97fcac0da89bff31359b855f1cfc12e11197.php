
<?php $__env->startSection('headers'); ?>
    <script>
        var product = <?php echo e($product->id); ?>;
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
<div ng-app="setpoint" ng-controller="ProductDetailsCtrl">
        <div class="breadcrumbcustom">
            <?php if($category): ?>
                <?php foreach($parents as $parent): ?>
                    <?php echo e(ucwords($parent)); ?> <span class="separador">-</span>
                <?php endforeach; ?>
                <span class="current"><?php echo e($category->name); ?></span>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="cajaimagen">
                    <img ng-src="{{selectedImg ? product.getImg(selectedImg, 468, 438):''}}" class="img-responsive" />
                    <span class="zoom"></span>
                </div>
                <div class="margentop30">
                    <div>
                        <div class="item"  ng-repeat="item in selectedImgs" class="item" style="float: left;
                                width:95px;
                                height: 95px;"> 
                            <a class="btnvista"
                                ng-click="selectImg(item)" 
                                style="
                                cursor: pointer;
                                background: url('{{product ? product.getImg(item,100,100) : ''}}') center center;
                            "></a>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="cajadetalle">
                    <img src="<?php echo e($product->brand->getImgURL(120,66)); ?>" class="pull-right" />
                    <h2 class="titulo"><?php echo e($product->name); ?></h2>
                    <div class="serie">Num. Serie <?php echo e($product->serialNumber); ?></div>
                    <div class="row margentop50">
                        <div class="col-sm-6">
                            <h3 class="precioazul"><?php echo e(Helpers::formatCurrency($product->priceFrom)); ?></h3>
                        </div>
                        <?php if($product->hasDiscount()): ?>
                            <div class="col-sm-6">
                                <h3 class="precioamarillo">
                                    <?php echo e(Helpers::formatCurrency($product->getClculateDiscount())); ?>

                                    <div class="globo pabsoluto"><span><?php echo e($product->discountPercentage); ?>%</span></div>
                                </h3>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row margentop30">
                        <div class="col-xs-6">
                            <div class="cajacantidad">
                                <input type="text" name="cantidad" id="cantidad" value="1" />
                                <div class="botones">
                                    <a class="btnmenos">-</a>
                                    <a class="btnmas">+</a>
                                </div>
                            </div>
                            <div class="etiqueta">
                                <div><span>Cantidad</span></div>
                            </div>
                        </div>
                        <?php if($product->sizes->count()): ?>
                            <div class="col-xs-6">
                                <div class="etiqueta">
                                    <div>
                                        <span>
                                            <select name="talla" id="talla" class="form-control stalla">
                                                <option></option>
                                                <?php foreach($product->sizes as $size): ?>
                                                    <option value="<?php echo e($size->id); ?>"><?php echo e($size->name); ?></option>
                                                <?php endforeach; ?>                                        
                                            </select>
                                            Talla
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if($product->colors->count()): ?>
                        <div class="colores barraverde margentop30">
                            <?php foreach($product->colors as $color): ?>
                            <span class="marino"  
                                ng-click="selectColor(<?php echo e($color->id); ?>)"
                                ng-class="{'color-selected': selectedColor==<?php echo e($color->id); ?> }">
                                <span style="background-color: <?php echo e($color->rgb); ?>;"></span>                                    
                            </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="row margentop30">
                        <div class="col-sm-4">
                            <a href="./carrito" class="btncarrito">
                                <div>
                                    <span>Agregar</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="btnredes">
                                <a href="" class="tw"></a>
                                <a href="" class="fb"></a>
                                <a href="" class="yt"></a>
                                <a href="" class="in"></a>
                            </div>
                        </div>
                    </div>
                    <div class="barraverde margentop30">
                        <a class="btndescripcion">Descripción</a>
                    </div>
                    <div><?php echo e($product->description); ?></div>
                </div>
            </div>
        </div>
    </div>
    

    

    <div class="margentop30 cajatextura">
        <a class="btnlike"></a>
        <div class="margentop30">
            <div id="owl-otros" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="producto">
                        <div class="productohover">
                            <div class="productotable">
                                <div>
                                    <a href="" class="btnk"></a>
                                    <h3>$000.00</h3>
                                    <a href="" class="btnc"></a>
                                </div>
                            </div>
                        </div>
                        <img src="<?php echo e(asset('img/template/productoejemplo.jpg')); ?>" class="img-responsive" />
                        <h3>Zapatos Verdes Bonitos</h3>
                        <h2>$000.00</h2>
                    </div>
                </div>
                <div class="item">
                    <div class="producto">
                        <div class="productohover">
                            <div class="productotable">
                                <div>
                                    <a href="" class="btnk"></a>
                                    <h3>$000.00</h3>
                                    <a href="" class="btnc"></a>
                                </div>
                            </div>
                        </div>
                        <img src="<?php echo e(asset('img/template/productoejemplo.jpg')); ?>" class="img-responsive" />
                        <h3>Zapatos Verdes Bonitos</h3>
                        <h2>$000.00</h2>
                    </div>
                </div>
                <div class="item">
                    <div class="producto">
                        <div class="productohover">
                            <div class="productotable">
                                <div>
                                    <a href="" class="btnk"></a>
                                    <h3>$000.00</h3>
                                    <a href="" class="btnc"></a>
                                </div>
                            </div>
                        </div>
                        <img src="<?php echo e(asset('img/template/productoejemplo.jpg')); ?>" class="img-responsive" />
                        <h3>Zapatos Verdes Bonitos</h3>
                        <h2>$000.00</h2>
                    </div>
                </div>
                <div class="item">
                    <div class="producto">
                        <div class="productohover">
                            <div class="productotable">
                                <div>
                                    <a href="" class="btnk"></a>
                                    <h3>$000.00</h3>
                                    <a href="" class="btnc"></a>
                                </div>
                            </div>
                        </div>
                        <img src="<?php echo e(asset('img/template/productoejemplo.jpg')); ?>" class="img-responsive" />
                        <h3>Zapatos Verdes Bonitos</h3>
                        <h2>$000.00</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cajaestrella margentop30">
        <img src="<?php echo e(asset('img/agassi.png')); ?>" />
        <h2>Andre Agassi</h2>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
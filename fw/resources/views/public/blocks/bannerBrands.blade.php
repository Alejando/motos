<?php
$brands = DwSetpoint\Models\Brand::getBrands();
?>
<div class="marcas">
    <div id="owl-marcas" class="owl-carousel owl-theme">
    	@foreach($brands as $brand)
    		<div class="item">
                    <img src="{{$brand->getImgURL(143,80)}}" alt="Productos {{$brand->name}}">
    		</div>
    	@endforeach
    </div>
</div>
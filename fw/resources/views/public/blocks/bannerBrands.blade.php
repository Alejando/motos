<?php
$brands = DwSetpoint\Models\Brand::getBrands();
?>
<div class="marcas">
    <div id="owl-marcas" class="owl-carousel owl-theme">
    	@foreach($brands as $brand)
    		<div class="item">
    			<img src="{{ asset('marca/'.$brand->id.'/marca-143x80.png') }}">
    		</div>
    	@endforeach
    </div>
</div>
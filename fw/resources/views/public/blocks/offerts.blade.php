<?php
$products = DwSetpoint\Models\Product::getMainProducts();
?>

<section class="offerts">
    <div id="owl-offerts" class="owl-carousel owl-theme">
        @foreach($products as $product)
        <div class="item">
            <div class="producto">
                <a href="{{$product->getURL(isset($categorySlug)?$categorySlug:'general')}}">
                    <div class="productohover">
                        <div class="productotable">
                            <div>
                                <!-- <span  ng-class="{btnkon: checkFav({{$product->id}})}" class="btnk" ng-click="addBookmark($event, {{$product->id}})"></span> -->
                                <h3>${{$product->price_from}}</h3>
                            <span href="" class="btnc"></span>
                            </div>
                        </div>
                    </div>
                </a>
                @if ($product->discount_percentage > 0)
                    <div class="offert sprite globo-2 text-center">%{{$product->discount_percentage}}</div>
                @endif
                <img src="{{$product->getURLCover()}}" class="img-responsive"/>
                <h3>{{$product->name}}</h3>
                <h2>${{$product->price_from}}</h2>
            </div>
        </div>
        @endforeach
    </div>
    <div style="clear: both"></div>
    <div class="subtitle">
        LIFESTYLE
    </div>
</section>

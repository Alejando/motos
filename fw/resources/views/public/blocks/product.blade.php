<div class="col-md-3 col-sm-4 col-xs-12" ng-controller="ProductListCtrl">
    <div class="item">
        <div class="producto">
            <a href="{{$product->getURL(isset($categorySlug)?$categorySlug:'general')}}">
                <div class="productohover">
                    <div class="productotable">
                        <div>
                            <!-- <span  ng-class="{btnkon: checkFav({{$product->id}})}" class="btnk" ng-click="addBookmark($event, {{$product->id}})"></span> -->
                            @if ($product->discount_percentage > 0)
                                <h3 style="text-decoration: line-through;">{{Helpers::formatCurrency($product->price_from)}}</h3>
                                <h2 style="color: #ffffff;">{{Helpers::formatCurrency($product->priceFrom-$product->getClculateDiscount())}}</h2> 
                            @else
                                <h2 style="color: #ffffff;">{{Helpers::formatCurrency($product->price_from)}}</h2> 
                            @endif
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
            @if ($product->discount_percentage > 0)
                <h3 style="text-decoration: line-through;">{{Helpers::formatCurrency($product->price_from)}}</h3>
                <h2 style="color: #ff0000;">{{Helpers::formatCurrency($product->priceFrom-$product->getClculateDiscount())}}</h2> 
            @else
                <h2>{{Helpers::formatCurrency($product->price_from)}}</h2> 
            @endif
        </div>
    </div>
</div>

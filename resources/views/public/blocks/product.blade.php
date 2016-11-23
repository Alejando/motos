<div class="col-md-3 col-sm-4 col-xs-12" ng-controller="ProductListCtrl">
    <div class="item">
        <div class="producto">
            <a href="{{$product->getURL(isset($categorySlug)?$categorySlug:'general')}}">
                <div class="productohover">
                    <div class="productotable">
                        <div>
                            <span  ng-class="{btnkon: checkFav({{$product->id}})}" class="btnk" ng-click="addBookmark($event, {{$product->id}})"></span>
                            <h3>$000.00</h3>
                        <span href="" class="btnc"></span>
                        </div>
                    </div>
                </div>
            </a>
            @if ($product->discount_percentage > 0)
                <div class="offert sprite globo-{{rand(1, 2)}}">%{{$product->discount_percentage}}</div>
            @endif
            <img src="{{$product->getURLCover()}}" class="img-responsive"/>
            <h3>{{$product->name}}</h3>
            <h2>$0,000.00 {{$product->id}}</h2>
        </div>
    </div>
</div>
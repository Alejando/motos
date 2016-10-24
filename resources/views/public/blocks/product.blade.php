<div class="col-md-3 col-sm-4 col-xs-12">
    <div class="producto">
        <a href="{{$product->getURL(isset($categorySlug)?$categorySlug:'general')}}">
        <div class="productohover">
            <div class="productotable">
                <div>
                    <span class="btnk"></span>
                    <h3>$000.00</h3>
                    <span href="" class="btnc"></span>
                </div>
            </div>
        </div>
        </a>
        <img src="{{$product->getURLCover()}}" class="img-responsive" />
        <h3>{{$product->name}}</h3>
        <h2>$0,000.00</h2>
    </div>
</div>
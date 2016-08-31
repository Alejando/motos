<div class="col-md-3 inputs-mgn" ng-repeat="fav in favs">
    <a href="{{asset('')}}/@{{auction.code}}-@{{auction.title | slugify}}" class="caja-detalle">
        <img ng-src="@{{fav.getUrlCover('horizontal')}}" class="img-responsive">
        <div id="titulo-en-detalle" class="titulo-en-detalle">
            @{{fav.title}}
        </div>
        <div id="fecha-subasta" class="fecha-subasta">
            @{{fav.start_date| date:'dd/MM/yyyy h:mm a' }}
        </div>
        <div id="precio-inicial" class="precio-inicial">
            Cover <span style="text-align: right;float: right;font-weight: bold;">@{{fav.cover|currency:"$"}}</span>
        </div>
    </a>
</div>
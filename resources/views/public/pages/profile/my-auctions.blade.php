<div class="col-md-3 inputs-mgn" ng-repeat="auction in enrolleds">
    <a href="{{asset('subastas/juego')}}/@{{auction.code}}" class="caja-detalle">
        <img ng-src="@{{auction.getUrlCover('horizontal')}}" class="img-responsive">
        <div id="titulo-en-detalle" class="titulo-en-detalle">@{{auction.title}}</div>
        <div id="precio-rangos" class="price-range">
            Oferta<br>desde @{{auction.min_offer|currency:"$"}} hasta @{{auction.max_offer|currency:"$"}}
        </div>
        <div id="fecha-subasta" class="fecha-subasta">@{{auction.start_date| date:'dd/MM/yyyy h:mm a' }}</div>
        <div id="precio-inicial" class="precio-inicial">Cover<span style="text-align: right;float: right;font-weight: bold;">@{{auction.cover|currency:"$"}}</span></div>
        <div id="precio-final" class="precio-final">Mi Oferta<span style="text-align: right;float: right;font-weight: bold;">@{{auction.sold_for|currency:"$"}}</span></div>
    </a>
</div>
<div ng-hide="enrolleds.length" class="text-center">
    <h2>Aun no has apartado tu lugar para alguna subasta</h2>
</div>
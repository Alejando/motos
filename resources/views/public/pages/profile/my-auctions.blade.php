<div class="col-md-3 inputs-mgn" ng-repeat="auction in enrolleds">
    <a href="{{asset('subastas/juego')}}/@{{auction.code}}" class="caja-detalle">
        <img ng-src="@{{auction.getUrlCover('horizontal')}}" class="img-responsive">
        <div id="titulo-en-detalle" class="titulo-en-detalle">@{{auction.title}}</div>
        <div id="precio-rangos" class="price-range">
            Oferta<br>desde @{{auction.min_offer|currency:"$"}} hasta @{{auction.max_offer|currency:"$"}}
        </div>
        <div id="fecha-subasta" class="fecha-subasta subasta-verde">
            <timer interval="1000" language="es" class="subasta-tiempo-perfil" 
                ng-show="auction.isStandBy()"
                end-time="auction.start_date">
                    <small>Inicia en</small><br>@{{hours}} hr, @{{minutes}} min, @{{seconds}} seg
            </timer>
            <timer interval="1000" language="es" class="subasta-tiempo" 
                ng-show="auction.isStarted()"
                end-time="auction.end_date">
                    <small>Finaliza en</small><br>@{{hours}} hr, @{{minutes}} min, @{{seconds}} seg
            </timer>
            <div class="subasta-tiempo" ng-show="auction.isFinished()">
                La subasta ha terminado
            </div>
        </div>
        <div id="precio-inicial" class="precio-inicial">Cover<span style="text-align: right;float: right;font-weight: bold;">@{{auction.cover|currency:"$"}}</span></div>
        <div id="precio-final" class="precio-final">Mi Oferta<span style="text-align: right;float: right;font-weight: bold;">@{{auction.sold_for|currency:"$"}}</span></div>
    </a>
</div>
<div ng-hide="enrolleds.length" class="text-center">
    <h2>Aun no has apartado tu lugar para alguna subasta</h2>
</div>
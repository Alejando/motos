<div class="col-md-3 inputs-mgn" ng-repeat="fav in favs">
    <a href="{{asset('')}}#!@{{fav.code}}/@{{fav.title | slugify}}" class="caja-detalle">
        <div class="remove-fav" ng-click="removeFav(fav, $event);"><i class="fa fa-times" aria-hidden="true" code="@{{fav.code}}"></i></div>
        <img ng-src="@{{fav.getUrlCover('horizontal')}}" class="img-responsive">
        <div id="titulo-en-detalle" class="titulo-en-detalle">
            @{{fav.title}}
        </div>
        <div id="fecha-subasta" class="fecha-subasta subasta-verde">
            <timer interval="1000" language="es" class="subasta-tiempo-perfil" 
                ng-show="fav.isStandBy()"
                end-time="fav.start_date">
                    <small>Inicia en</small><br>@{{hours}} hr, @{{minutes}} min, @{{seconds}} seg
            </timer>
            <timer interval="1000" language="es" class="subasta-tiempo" 
                ng-show="fav.isStarted()"
                end-time="fav.end_date">
                    <small>Finaliza en</small><br>@{{hours}} hr, @{{minutes}} min, @{{seconds}} seg
            </timer>
            <div class="subasta-tiempo" ng-show="fav.isFinished()">
                La subasta ha terminado
            </div>
        </div>
        <div id="precio-inicial" class="precio-inicial">
            Tu asiento <span style="text-align: right;float: right;font-weight: bold;">@{{fav.cover|currency:"$"}}</span>
        </div>
    </a>
</div>
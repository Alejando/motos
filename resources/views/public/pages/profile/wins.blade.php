<div class="col-md-3 inputs-mgn" ng-repeat="auction in wins">
    <a href="{{asset('pago-ganador')}}/@{{auction.code}}" class="caja-detalle">
        <img ng-src="@{{auction.getUrlCover('horizontal')}}" class="img-responsive">
        <div id="titulo-en-detalle" class="titulo-en-detalle">@{{auction.title}}</div>
        <div id="fecha-subasta" class="fecha-subasta">@{{auction.start_date| date:'dd/MM/yyyy h:mm a' }}</div>
        <div id="precio-inicial" class="precio-inicial">Tu asiento<span style="text-align: right;float: right;font-weight: bold;">@{{auction.cover|currency:"$"}}</span></div>
        <div id="precio-final" class="precio-final">Mi oferta<span style="text-align: right;float: right;font-weight: bold;">@{{auction.sold_for|currency:"$"}}</span></div>
    </a>
</div>
<div ng-hide="wins.length" class="text-center"> 
    <h2><a href="{{asset("")}}" style="color:black" >Participa en nuestras proximas subastas</a></h2>
</div>
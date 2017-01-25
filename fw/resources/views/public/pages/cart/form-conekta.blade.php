<div method="POST" id="conektaCardForm" role="form">
     <span class="card-errors"></span>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12"><img style="width:90%;" src="{{asset('/css/creditcards.png')}}"/></div>
    </div>
    <div class="form-group">
        <label class="col-md-12 control-label" for="nombretarjetahabiente">Nombre del tarjetahabiente:</label>
        <div class="col-md-12">
            <input type="text"
                class="form-control"
                placeholder="Ej. Oscar Robles Torres"                        
                required              
                value=""
                data-conekta="card[name]"
                id="nombretarjetahabiente"
            >
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12 control-label" for="nombretarjetahabiente">Teléfono del Tarjetahabiente:</label>
        <div class="col-md-12">
            <input type="text"
                class="form-control tel"
                placeholder="Ej. 444223344"
                required
            >
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12 control-label" for="tarjeta">Número de la tarjeta de crédito:</label>
        <div class="col-md-12">
            <input type="text"
                id="tarjeta"
                class="form-control"
                placeholder="Ej. 87129873"                        
                required
                value=""
                data-conekta="card[number]"
            >
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12 control-label" for="cvc">
            CVC
        </label>
        <div class="col-md-12">
            <input type="text" id="cvc" size="4" style="width:6em; float: left" placeholder="xxx"  class="form-control" data-conekta="card[cvc]" />
            <img src="{{asset('img/cvc.png')}}" style="float: left; margin-left: 10px; margin-top: 5px">
        </div>
    </div>
    <div class="form-inline">
        <div class="form-group">
            <label class="col-xs-12 control-label">
                <span>Fecha de expiración (MM/AAAA)</span>            
            </label>
            <div class="col-xs-12" style="padding-left: 15px">
                <input type="text"  class="form-control" style="width:4em" placeholder="MM" size="2" maxlength="2" data-conekta="card[exp_month]"/>
                <span class="">/</span>
                <input type="text"  class="form-control" style="width:6em" placeholder="AAAA" size="4" maxlength="4" data-conekta="card[exp_year]"/>
            </div>
        </div>
    </div>
</div>
<h2>Pedido @{{order.id}} </h2>
<div>
    <b>User:</b> @{{order.relations.user.name}} (@{{order.relations.user.email}})<br>
    <b>Pagada:</b> @{{order.paid}} @{{order.paid==1 ? 'SI' : 'No'}} <br>
    <b>Metodo de pago:</b> @{{order.getNamePSP()}}
</div>
<div class="form-group">
    <div class="col-xs-10 col-xs-offset-1" ng-show="order.paid && !order.sent">
        <button class="btn btn-primary col-xs-12 text-center" ng-click="sendOrder(order)">
            <span class="fa fa-send-o" ></span> Enviar</button>    
    </div>
</div>

<h3>Detalle</h3>
<div>
    <table class="table table-striped">
        <tr>
            <th>Producto</th>
            <th>Catindad</th>
            <th>Color</th>
            <th>Tamaño</th>
            <th>Precio C/U</th>
        </tr>
        <tr ng-repeat="item in order.relations.items">
            <td>@{{item.relations.product.name}}</td>
            <td>@{{item.quantity}}</td>
            <td>@{{item.relations.stock.relations.color.name}}</td>
            <td>@{{item.relations.stock.relations.size.name}}</td>
            <td>@{{item.price|currency}}</td>
        </tr>
    </table>    
</div>
<h3>Información de envío</h3>
<div>
    <div>
        <b>Calle:</b> @{{order.relations.address.street}} <b>No.</b> @{{order.relations.address.street_number}} 
        <span ng-show="order.relations.address.suite_number"><b>Interior:</b> @{{order.relations.address.suite_number}}</span>
    </div>
    <div>
        <b>Colonia:</b> @{{order.relations.address.neighborhood}} <b>C.P.:</b> @{{order.relations.address.cp}} 
    </div>
    <div>
        <b>Ciudad:</b> @{{order.relations.address.city}}
    </div>
    <div>
        <b>Estado:</b> @{{order.relations.address.relations.state.name}}
    </div>
    <div>
        <b>País:</b> @{{order.relations.address.relations.country.name}}
    </div>
    
</div>
<div class="form-group">
    <div class="col-xs-12 text-right">
        <button class="btn btn-danger btn-sm text-center">
            <span class="fa fa-times"></span> Cancelar Pedido</button>    
    </div>
</div>
<div style="clear: both"></div>
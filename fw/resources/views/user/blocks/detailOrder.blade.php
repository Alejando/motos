
 <h2>Folio: @{{order.id}} <span class="pull-right">@{{order.created_at | date : DATETIME_FORMAT}}</span> </h2>

<h3>Detalle</h3>
<div>
    <table class="table table-striped">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio C/U</th>
            <th>Total</th>
        </tr>
        <tr ng-repeat="item in order.items">
            <td>@{{item.product.name}}</td>
            <td>@{{item.quantity}}</td>
            <td>@{{item.price|currency}}</td>
            <td>@{{(item.price * item.quantity) |currency}}</td>
        </tr>
    </table>   
    <table class="table table-striped  pull-right" style="width: auto;">
        <tr><th>Subtotal:</th><td>@{{order.subtotal | currency}}</td></tr>
        <tr ng-show="order.coupon_id"><th>Descuento:</th><td> - @{{order.discount | currency:"$"}}</td></tr> 
        <tr><th>Envio:</th><td>@{{order.shipping|currency}}</td></tr>
        <tr style="background-color: silver; color:black"><th>Total:</th><td>@{{order.total|currency}}</td></tr>
    </table>
    <div style="clear: both"></div>
</div>

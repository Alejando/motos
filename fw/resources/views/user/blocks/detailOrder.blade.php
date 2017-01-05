<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<table>
	<tr>
	    <th>Cantidad</th>
	    <th>Producto</th>
	    <th>Precio</th>
	</tr>
	<tr ng-repeat="item in items">
		<td>@{{ item.quantity }}</td>
	    <td>@{{ item.product.name }}</td>
	    <td>@{{ item.price }}</td>
	</tr>
</table>
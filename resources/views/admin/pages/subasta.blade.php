<div class="row content shadow">
    <h2 style="text-align: center">@{{auction.title}}</h2>
    <table class="table-bordered table">
        <tr>
            <th>Status</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Termino</th>
            <th>Lugares Vendidos</th>
            <th>Ingresos</th>
            <th>Vendido Por</th>
        </tr>
        <tr>
            <td>@{{auction.getStatusStr()}}</td>
            <td>@{{auction.getStartDate()}}</td>
            <td>@{{auction.getEndDate()}}</td>
            <td>@{{auction.totalEnrollments| currency }}</td>
            <td>@{{auction.inflows|currency}}</td>
            <td>@{{auction.soldFor|currency}}</td>
        </tr>
        <div class="text-center" style="margin: 10px;">
            <button class='btn btn-primary'>Editar</button>
            <button class="btn btn-primary">Cerrar</button>
            <button class='btn btn-primary'>Publicar</button>
            <button class='btn btn-danger'>Cancelar</button>
        </div>
    </table>
</div>
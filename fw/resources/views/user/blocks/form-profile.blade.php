<div  class="cols-md-12 card-box ">
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)" name="brandForm" novalidate>
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="user.name" 
                        class="form-control" 
                        placeholder="Nueva Marca"
                        name="name"
                        >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Correo</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="user.email" 
                        class="form-control" 
                        placeholder="Nueva Marca"
                        name="email"
                        >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Celular</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="user.cellphone" 
                        class="form-control" 
                        placeholder="Nueva Marca"
                        name="cellphone"
                        >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Teléfono</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="user.homephone" 
                        class="form-control" 
                        placeholder="Nueva Marca"
                        name="homephone"
                        >
            </div>
            
        </div>
        <!-- <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button> -->
    </form>
</div>


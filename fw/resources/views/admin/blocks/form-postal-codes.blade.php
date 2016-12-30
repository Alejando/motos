<form class="form-horizontal" ng-submit="saveCPs($event)" name="colorForm" novalidate>
    <div class="form-group">
        <label class="col-md-3 control-label" for="name">C.P</label>  
        <div class="col-md-6">
            <textarea ng-model="codes" name="name" type="text" placeholder="Nombre" class="form-control"></textarea>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary waves-effect waves-light">Agregar</button>
        </div>
        <div class="">*Separe por comas para insertar varios</div>
    </div>
    <div>
        <table datatable=""
            dt-options="dtOptionsShippingZones"  
            dt-instance="dtInstanceShippingZones" 
            dt-columns="dtColumnsShippingZones" 
            class="table table-striped table-bordered"></table>
        <div style="clear: both"></div>
    </div>
    
</form>
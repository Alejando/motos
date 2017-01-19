<div  class="cols-md-12 card-box ">
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)" novalidate>
        <div class="form-group">
            <label class="col-md-3 control-label">Etiqueta</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.label" 
                        class="form-control" 
                        name="label">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Calle</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.street" 
                        class="form-control" 
                        name="street">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Número Ext.</label>
            <div class="col-md-4">
                <input  type="text" 
                        ng-model="selectedItem.street_number" 
                        class="form-control" 
                        name="street_number">
            </div>
            
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Número Int.</label>
            <div class="col-md-4">
                <input  type="text" 
                        ng-model="selectedItem.suite_number" 
                        class="form-control" 
                        name="suite_number">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Colonia</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.neighborhood" 
                        class="form-control" 
                        name="neighborhood">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Delegación</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.delegation" 
                        class="form-control" 
                        name="delegation">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Codigo Postal</label>
            <div class="col-md-4">
                <input  type="text" 
                        ng-model="selectedItem.postal_code" 
                        class="form-control" 
                        name="postal_code">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Ciudad</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.city" 
                        class="form-control" 
                        name="city">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">País</label>
            <div class="col-md-8">
                <select name="country" 
                        id="country" 
                        ng-change="chooseCountry()"
                        ng-model="selectedCoutry"
                        ng-options="country.name for country in countries track by country.id"
                        class="form-control"
                ></select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Estado</label>
            <div class="col-md-8">
                <select 
                    name="state"  
                    id="estado"
                    ng-change="chooseState()" 
                    ng-model="selectedState"
                    ng-options="state.name for state in states track by state.id"
                    data-fact="festado"
                    class="form-control"
                    required>
                    <option value="">Estado/Provincia</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Nombre(s)</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.first_name" 
                        class="form-control" 
                        name="first_name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Apellidos</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.last_name" 
                        class="form-control" 
                        name="last_name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Teléfono</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.tel" 
                        class="form-control" 
                        name="tel">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Instrucciones</label>
            <div class="col-md-8">
                <textarea   type="text" 
                        	ng-model="selectedItem.instructions" 
                        	class="form-control" 
                        	name="instructions"
                        	rows="4"></textarea>
            </div>
        </div>

    </form>
</div>
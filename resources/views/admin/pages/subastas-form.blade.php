<div class="row content shadow">
    <form class="form-horizontal col-sm-10 subastas-form" >  
        <div class="form-group">
            <label style="text-align: left" class="col-sm-1 control-label">Titulo:</label>
            <input type="text" class="input-sm col-xs-12"
                   ng-class="{
                       'col-sm-8' : creando!=true,
                       'col-sm-10' : creando==true
                   }"
                   ng-model="auction.title"
                   placeholder="Titulo de la subasta (descripción breve del articulo a subastar)"
            >
            <button ng-hide="creating" class="btn btn-default col-sm-1 col-sm-offset-1" ng-click="createNewAuction()">Crear</button>
        </div>
        <div ng-show="creating">
            <div class="form-group">
                <label class="col-sm-12">Descripción:</label>
                <div style="width: 95%; margin: 0 auto;">
                    <div text-angular ng-model="auction.description"></div>
                </div>
                
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-labelc">Oferta Minima:</label>
                <input type="number" 
                    class="input-sm col-sm-3 col-xs-12" 
                    placeholder="Cantidad minima a ofertar"
                    ng-model="auction.minBid"
                >
                <label class="col-sm-2 col-sm-offset-1 control-labelc">Oferta Máxima:</label>
                <input type="number" 
                    class="input-sm col-sm-3 col-xs-12" 
                    placeholder="Cantidad máxima a ofertar"
                    ng-model="auction.maxBid"
                >
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-labelc">Número de ofertas:</label>
                <input type="" class="input-sm col-sm-3 col-xs-12 " placeholder="Número de pujas por usuario">
                <label class="col-sm-2 col-sm-offset-1">Tope:</label>
                <input type="text" 
                    class="input-sm col-sm-3 col-xs-12" 
                    placeholder="Cantidad máxima a pagar por el producto"
                    ng-model="auction.maxOffer"
                >
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-labelc">Cupo Minimo:</label>
                <input type="text" class="input-sm col-sm-3 col-xs-12" placeholder="Minimo de usuarios requeridos">
                <label class="col-sm-2 col-sm-offset-1 control-labelc">Cupo Máximo:</label>
                <input type="text" 
                    class="input-sm col-sm-3 col-xs-12" 
                    placeholder="Máximo de usuarios permitidos"
                    ng-model="auction.userTop"
                >
            </div>
            
            <div class="form-group">
                <label class="col-sm-2">Delay:</label>
                <input type="text" 
                    class="input-sm col-sm-3 col-xs-12" 
                    placeholder="Tiempo de espera entre una puja y otra (5 seg. por defecto)"
                    ng-model="auction.delay"
                >
                <label class="col-sm-2 col-sm-offset-1 control-labelc">Mercado:</label>
                <select class="input-sm col-sm-3" ng-model="auction.target">
                    <option>Selecciona a que mercado esta dirigido</option>
                    <option value="0">Femenino</option>
                    <option value="1">Masculino</option>
                    <option value="2">Mixto</option>
                </select>
            </div>
            
            <div class="form-group date-pickers">
                <label class="col-sm-2">Fecha/Hr Inicio:</label>
                <div class="col-sm-3 col-xs-12 input-datetimes">
                    <div class="input-group timepicker datepicker">
                        <input type="text" 
                               class="form-control" 
                               datetime-picker="dd/MM/y"
                               ng-model="auction.startDate"
                               is-open="startDate.open"
                               enable-time="false"
                               datepicker-options="startDate.datepickerOptions"
                               close-on-date-selection="false" 
                               datepicker-append-to-body="true" />
                        <span class="input-group-btn">
                            <button type="button" 
                                    class="btn btn-default" 
                                    ng-click="openCalendar($event, 'startDate')">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                    <input type="text" class="input-sm timepicker"  
                           data-ng-model="date"  
                           data-lng-clockpicker 
                           data-lng-clockpicker-options="optionsStartTime"
                           >
                </div>
                <label class="col-sm-2 col-sm-offset-1">Fecha/Hr Fin:</label>
                <div class="col-sm-3 input-datetimes col-xs-12">
                    <div class="input-group timepicker datepicker">
                        <input type="text" 
                               class="form-control " 
                               datetime-picker="dd/MM/y"
                               ng-model="auction.endDate"
                               is-open="endDate.open"
                               enable-time="false"
                               datepicker-options="endDate.datepickerOptions"
                               close-on-date-selection="false" 
                               datepicker-append-to-body="true" />
                        <span class="input-group-btn">
                            <button type="button" 
                                    class="btn btn-default" 
                                    ng-click="openCalendar($event, 'endDate')">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>

                    <input type="text" class="input-sm timepicker col-xs-12" 
                           data-ng-model='hrEnd' 
                           data-lng-clockpicker 
                           data-lng-clockpicker-options='optionsEndingTime'
                           >
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-2">Tiempo inactividad subasta:</label>
                <input type="text" 
                    class="input-sm col-sm-3 col-xs-12"
                    placeholder="Tiempo máximo de inactividad (20 min. por defecto)"
                    ng-model="auction.delay"
                >
                <label class="col-sm-2 col-sm-offset-1">Tiempo inactividad usuario:</label>
                <input type="text" 
                    class="input-sm col-sm-3 col-xs-12"
                    placeholder="Tiempo máximo de inactividad (15 min. por defecto)"
                    ng-model="auction.delay"
                >
                
            </div>

            <div class="form-group">
                <label class="col-sm-12 control-labelc">Fotos</label>

            </div>
            <div
                class="dropzone"
                method="post"
                enctype="multipart/form-data"
                ng-dropzone
                dropzone="dropzone"
                dropzone-config="dropzoneConfig"
                event-handlers="{ 'addedfile': dzAddedFile, 'error': dzError, 'processing' : dzProcessing}"
                ></div>
            <div style="width: 90%; margin: 0 auto; margin-top: 10px; overflow-x: none; ">
                <div style="display: inline-block; position: relative; margin: 10px;"  ng-repeat="pic in pics track by $index">
                    <div style="display: inline-block; position: relative;">
                        <img ng-src="@{{pic}}" height="200px" class="thumbnail" style="display: inline-block">
                    </div>
                    <div style="float: right; position: absolute; bottom: 20px; left: 100%; margin-left: -40px;">
                        <button ng-click="removePic(pic)" 
                                class="glyphicon glyphicon-remove-circle btn-sm btn thumbnail-auction" style="opacity: 0.4; color:red; background: transparent; border: none; font-size: 20px;"></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <label><input type="checkbox" ng-model="auction.published"> Publicar</label>
            </div>
            <div class="form-group col-sm-12 text-center" style="margin-top: 25px;">
                <button style="margin-left: 5px" class="btn btn-primary col-sm-1 col-sm-offset-4" ng-click="saveSaveAuction()">Guardar</button>
                <button style="margin-left: 5px" class="btn btn-primary col-sm-1" ng-click="saveSaveAuction()">Cancelar</button>
                <button style="margin-left: 5px" class="btn btn-primary col-sm-1" ng-click="saveSaveAuction()">Clonar</button>
                
                <button class="btn btn-danger" style="float: right">Elminar</button>
            </div>
        </div>
    </form>
</div>
@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Dirección de envío</span>
    </div>

    <div class="pasos">
        <a href="./carrito" class="transicion"><span><b>1</b></span></a>
        <a href="./envio" class="transicion activo"><span><b>2</b></span></a>
        <a href="./pago" class="transicion"><span><b>3</b></span></a>
    </div>

    <div class="cajadatos margentop30">
        <h2 class="subtitulo">Datos de Envío</h2>
        <form id="formenvio" method="post">
            <div class="row margentop20">
                <div class="col-md-2">
                    <label for="nombre" class="pull-right">Nombre</label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="nombre" id="nombre" class="form-control" />
                </div>
                <div class="col-md-2">
                    <label for="apellido" class="espacio pull-right">Apellidos</label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="apellido" id="apellido" class="form-control" />
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-md-2">
                    <label for="direccion" class="pull-right">Dirección</label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="direccion" id="direccion" data-fact="fdireccion" class="form-control" />
                </div>
                <div class="col-md-2">
                    <label for="entrecalles" class="espacio pull-right">Entre Calles</label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="entrecalles" id="entrecalles" data-fact="fentrecalles" class="form-control" />
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-md-2">
                    <label for="colonia" class="pull-right">Colonia</label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="colonia" id="colonia" data-fact="fcolonia" class="form-control" />
                </div>
                <div class="col-md-2">
                    <label for="cp" class="espacio pull-right">Código Postal</label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="cp" id="cp" data-fact="fcp" class="form-control" />
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-md-2">
                    <label for="estado" class="pull-right">Estado</label>
                </div>
                <div class="col-md-4">
                    <select name="estado" id="estado" data-fact="festado" class="form-control">
                        <option value="">Estado/Provincia</option>
                        <option value="203">Aguascalientes</option>
                        <option value="195">Baja California</option>
                        <option value="216">Baja California Sur</option>
                        <option value="622">Campeche</option>
                        <option value="219">Chiapas</option>
                        <option value="209">Chihuahua</option>
                        <option value="198">Coahuila</option>
                        <option value="215">Colima</option>
                        <option value="213">Distrito Federal</option>
                        <option value="199">Durango</option>
                        <option value="194">Estado de México</option>
                        <option value="196">Guanajuato</option>
                        <option value="208">Guerrero</option>
                        <option value="211">Hidalgo</option>
                        <option value="190">Jalisco</option>
                        <option value="210">Michoacan</option>
                        <option value="207">Morelos</option>
                        <option value="214">Nayarit</option>
                        <option value="191">Nuevo León</option>
                        <option value="218">Oaxaca</option>
                        <option value="192">Puebla</option>
                        <option value="201">Queretaro</option>
                        <option value="220">Quintana roo</option>
                        <option value="200">San Luis Potosi</option>
                        <option value="206">Sinaloa</option>
                        <option value="620">Sonora</option>
                        <option value="217">Tabasco</option>
                        <option value="204">Tamaulipas</option>
                        <option value="193">Tlaxcala</option>
                        <option value="205">Veracruz</option>
                        <option value="202">Yucatán</option>
                        <option value="222">Zacatecas</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="ciudad" class="espacio pull-right">Ciudad</label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="ciudad" id="ciudad" data-fact="fciudad" class="form-control" />
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-md-2">
                    <label for="telefono" class="pull-right">Teléfono</label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="telefono" id="telefono" class="form-control" />
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-md-2">
                    <label for="instrucciones" class="pull-right">Instrucciones</label>
                </div>
                <div class="col-md-10">
                    <textarea name="instrucciones" id="instrucciones" cols="30" rows="4" class="form-control"></textarea>
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-md-10 col-md-offset-2">
                    <label class="qfactura">
                        <input type="checkbox" name="factura" id="factura" /> 
                        <span>¿Requieres factura?</span>
                    </label>
                </div>
            </div>

            <div class="cajafactura">
                <div class="row margentop20">
                    <div class="col-md-2">
                        <label for="razon" class="pull-right">Razón Social</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="razon" id="razon" class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <label for="rfc" class="espacio pull-right">R.F.C.</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="rfc" id="rfc" class="form-control" />
                    </div>
                </div>

                <div class="row margentop20">
                    <div class="col-md-10 col-md-offset-2">
                        <label class="qfactura">
                            <input type="checkbox" name="didentica" id="didentica" /> 
                            <span>Dirección fiscal igual a la de envío</span>
                        </label>
                    </div>
                </div>

                <div class="row margentop20">
                    <div class="col-md-2">
                        <label for="fdireccion" class="pull-right">Dirección</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="fdireccion" id="fdireccion" class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <label for="fentrecalles" class="espacio pull-right">Entre Calles</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="fentrecalles" id="fentrecalles" class="form-control" />
                    </div>
                </div>

                <div class="row margentop20">
                    <div class="col-md-2">
                        <label for="fcolonia" class="pull-right">Colonia</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="fcolonia" id="fcolonia" class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <label for="fcp" class="espacio pull-right">Código Postal</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="fcp" id="fcp" class="form-control" />
                    </div>
                </div>

                <div class="row margentop20">
                    <div class="col-md-2">
                        <label for="festado" class="pull-right">Estado</label>
                    </div>
                    <div class="col-md-4">
                        <select name="festado" id="festado" class="form-control">
                            <option value="">Estado/Provincia</option>
                            <option value="203">Aguascalientes</option>
                            <option value="195">Baja California</option>
                            <option value="216">Baja California Sur</option>
                            <option value="622">Campeche</option>
                            <option value="219">Chiapas</option>
                            <option value="209">Chihuahua</option>
                            <option value="198">Coahuila</option>
                            <option value="215">Colima</option>
                            <option value="213">Distrito Federal</option>
                            <option value="199">Durango</option>
                            <option value="194">Estado de México</option>
                            <option value="196">Guanajuato</option>
                            <option value="208">Guerrero</option>
                            <option value="211">Hidalgo</option>
                            <option value="190">Jalisco</option>
                            <option value="210">Michoacan</option>
                            <option value="207">Morelos</option>
                            <option value="214">Nayarit</option>
                            <option value="191">Nuevo León</option>
                            <option value="218">Oaxaca</option>
                            <option value="192">Puebla</option>
                            <option value="201">Queretaro</option>
                            <option value="220">Quintana roo</option>
                            <option value="200">San Luis Potosi</option>
                            <option value="206">Sinaloa</option>
                            <option value="620">Sonora</option>
                            <option value="217">Tabasco</option>
                            <option value="204">Tamaulipas</option>
                            <option value="193">Tlaxcala</option>
                            <option value="205">Veracruz</option>
                            <option value="202">Yucatán</option>
                            <option value="222">Zacatecas</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="fciudad" class="espacio pull-right">Ciudad</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="fciudad" id="fciudad" class="form-control" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="botonera margentop50">
        <a href="./pago" class="transicion">Continuar</a>
    </div>
@stop
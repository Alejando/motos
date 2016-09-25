@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Carrito de compras</span>
    </div>

    <div class="pasos">
        <a href="./carrito" class="transicion activo"><span><b>1</b></span></a>
        <a href="./envio" class="transicion"><span><b>2</b></span></a>
        <a href="./pago" class="transicion"><span><b>3</b></span></a>
    </div>

    <div class="cajacarrito margentop30">
        <div class="row fila">
            <div class="col-sm-2 hidden-xs">
                <div class="btnvista" style="background: url('{{ asset('img/template/productoejemplo.jpg') }}') center center;"></div>
            </div>
            <div class="col-sm-2 col-xs-4">
                <div class="cajatxt">
                    <div>
                        <h3 class="productonombre">
                            Zapatos Verdes Bonitos
                            <span>Num. Serie 0215225</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 hidden-xs">
                <div class="cajatxt">
                    <div>
                        <h3 class="productonombre">
                            Precio Unitario
                            <b>$000.00</b>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-4">
                <div class="cajatxt">
                    <div>
                        <h3 class="productonombre">
                            Cantidad
                            <input type="number" name="cantidad" value="1" min="1">
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-4">
                <div class="cajatxt">
                    <div>
                        <h3 class="productonombre">
                            Subtotal
                            <b>$000.00</b>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 hidden-xs">
                <div class="cajatxt">
                    <div>
                        <a href="" class="btneliminar transicion"><div><span>X</span></div></a>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

    <div class="row margentop30">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="pull-right cajacupon">
                <h3 class="subtitulo hidden-xs">Canjea Cupón</h3>
                <input type="text" name="cupon" id="cupon" class="hidden-xs" />
                <input type="text" name="cupon" id="cupon" class="visible-xs" placeholder="Canjea Cupón" />
                <a class="btncupon transicion">Aplicar</a>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="cuenta">
                <div class="row">
                    <div class="col-xs-6"><span class="cgris">Subtotal</span></div>
                    <div class="col-xs-6"><span class="cgris">$000.00</span></div>
                </div>
                <div class="row descuento">
                    <div class="col-xs-6"><span>Descuento cupón</span></div>
                    <div class="col-xs-6"><span>$000.00</span></div>
                </div>
                <div class="row envio">
                    <div class="col-xs-6"><span>Envío</span></div>
                    <div class="col-xs-6"><span>$000.00</span></div>
                </div>
                <div class="row total">
                    <div class="col-xs-6"><span>Total</span></div>
                    <div class="col-xs-6"><span>$000.00</span></div>
                </div>
            </div>

            <div class="cuenta margentop20">
                <div class="row">
                    <div class="col-md-12"><span class="cazul">Método de envío</span></div>
                </div>
                <div class="row">
                    <div class="col-xs-6"><span class="cgris">Paquetería</span></div>
                    <div class="col-xs-6">
                        <select name="paqueteria" id="paqueteria" class="form-control combo">
                            <option value="">Fedex</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6"><span class="cgris">Servicio</span></div>
                    <div class="col-xs-6">
                        <select name="servicio" id="servicio" class="form-control combo">
                            <option value="">Nacional</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6"><span class="cgris">Tipo</span></div>
                    <div class="col-xs-6">
                        <select name="tipo" id="tipo" class="form-control combo">
                            <option value="">Terrestre</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="botonera margentop50">
        <a href="./envio" class="transicion">Continuar</a>
    </div>
@stop
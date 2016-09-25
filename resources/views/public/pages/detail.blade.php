@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Zapatos <span class="separador">-</span> Marca <span class="separador">-</span> <span class="current">Modelo</span>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="cajaimagen">
                <img src="{{ asset('img/template/productoejemplo.jpg') }}" class="img-responsive" />
                <span class="zoom"></span>
            </div>
            <div class="margentop30">
                <div id="owl-detalle" class="owl-carousel owl-theme">
                    <div class="item"><a class="btnvista" style="background: url('{{ asset('img/template/productoejemplo.jpg') }}') center center;"></a></div>
                    <div class="item"><a class="btnvista" style="background: url('{{ asset('img/template/productoejemplo.jpg') }}') center center;"></a></div>
                    <div class="item"><a class="btnvista" style="background: url('{{ asset('img/template/productoejemplo.jpg') }}') center center;"></a></div>
                    <div class="item"><a class="btnvista" style="background: url('{{ asset('img/template/productoejemplo.jpg') }}') center center;"></a></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="cajadetalle">
                <img src="{{ asset('img/template/wilson.png') }}" class="pull-right" />
                <h2 class="titulo">ZAPATOS VERDES BONITOS</h2>
                <div class="serie">Num. Serie 0215225</div>
                <div class="row margentop50">
                    <div class="col-sm-6">
                        <h3 class="precioazul">$000.00</h3>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="precioamarillo">
                            $000.00
                            <div class="globo pabsoluto"><span>30%</span></div>
                        </h3>
                    </div>
                </div>
                <div class="row margentop30">
                    <div class="col-xs-6">
                        <div class="cajacantidad">
                            <input type="text" name="cantidad" id="cantidad" value="1" />
                            <div class="botones">
                                <a class="btnmenos">-</a>
                                <a class="btnmas">+</a>
                            </div>
                        </div>
                        <div class="etiqueta">
                            <div><span>Cantidad</span></div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="etiqueta">
                            <div>
                                <span>
                                    <select name="talla" id="talla" class="form-control stalla">
                                        <option value="">6</option>
                                        <option value="">6.5</option>
                                        <option value="">7</option>
                                        <option value="">7.5</option>
                                        <option value="">8</option>
                                        <option value="">8.5</option>
                                        <option value="">9</option>
                                        <option value="">9.5</option>
                                        <option value="">10</option>
                                    </select>
                                    Talla
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="colores barraverde margentop30">
                    <span class="marino"><span></span></span>
                    <span class="verde"><span></span></span>
                    <span class="azul"><span></span></span>
                    <span class="naranja"><span></span></span>
                </div>
                <div class="row margentop30">
                    <div class="col-sm-4">
                        <a href="./carrito" class="btncarrito">
                            <div>
                                <span>Agregar</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-8">
                        <div class="btnredes">
                            <a href="" class="tw"></a>
                            <a href="" class="fb"></a>
                            <a href="" class="yt"></a>
                            <a href="" class="in"></a>
                        </div>
                    </div>
                </div>
                <div class="barraverde margentop30">
                    <a class="btndescripcion">Descripción</a>
                </div>
            </div>
        </div>
    </div>

    <div class="margentop30 cajatextura">
        <a class="btnlike"></a>
        <div class="margentop30">
            <div id="owl-otros" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="producto">
                        <div class="productohover">
                            <div class="productotable">
                                <div>
                                    <a href="" class="btnk"></a>
                                    <h3>$000.00</h3>
                                    <a href="" class="btnc"></a>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('img/template/productoejemplo.jpg') }}" class="img-responsive" />
                        <h3>Zapatos Verdes Bonitos</h3>
                        <h2>$000.00</h2>
                    </div>
                </div>
                <div class="item">
                    <div class="producto">
                        <div class="productohover">
                            <div class="productotable">
                                <div>
                                    <a href="" class="btnk"></a>
                                    <h3>$000.00</h3>
                                    <a href="" class="btnc"></a>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('img/template/productoejemplo.jpg') }}" class="img-responsive" />
                        <h3>Zapatos Verdes Bonitos</h3>
                        <h2>$000.00</h2>
                    </div>
                </div>
                <div class="item">
                    <div class="producto">
                        <div class="productohover">
                            <div class="productotable">
                                <div>
                                    <a href="" class="btnk"></a>
                                    <h3>$000.00</h3>
                                    <a href="" class="btnc"></a>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('img/template/productoejemplo.jpg') }}" class="img-responsive" />
                        <h3>Zapatos Verdes Bonitos</h3>
                        <h2>$000.00</h2>
                    </div>
                </div>
                <div class="item">
                    <div class="producto">
                        <div class="productohover">
                            <div class="productotable">
                                <div>
                                    <a href="" class="btnk"></a>
                                    <h3>$000.00</h3>
                                    <a href="" class="btnc"></a>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('img/template/productoejemplo.jpg') }}" class="img-responsive" />
                        <h3>Zapatos Verdes Bonitos</h3>
                        <h2>$000.00</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cajaestrella margentop30">
        <img src="{{ asset('img/agassi.png') }}" />
        <h2>Andre Agassi</h2>
    </div>
@stop
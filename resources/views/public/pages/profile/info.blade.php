<div class="col-md-12 inputs-mgn">
    <form class="login-form">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <input ng-model="user.name" type="text" name="nombre" class="form-control2" placeholder="Nombre completo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input ng-model="user.email" type="email" name="correo" class="form-control2" placeholder="Correo electrónico">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <span class="leyenda-fecha-nac">Fecha de nacimiento</span>
                            </div>
                            <div class="col-xs-12 col-sm-2 nac">
                                <select name="dia" ng-model="brithday.day" class="form-control2" placeholder="Día">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-3 nac margen-nac">
                                <select name="mes" ng-model="brithday.month" class="form-control2" placeholder="Mes">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-3 nac">
                                <select name="year" ng-model="brithday.year" class="form-control2" placeholder="Año">
                                    @for($i=1916;$i< date('Y')-15; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="form-group row">
                    <div class="col-sm-12">
                        <select ng-model="user.fnGender" ng-model-options="{getterSetter: true}" name="sexo" class="form-control2">
                            <option value="1">Hombre</option>
                            <option value="0">Mujer</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" style="display: none">
                    <div class="col-sm-12">
                        <select name="interes" class="form-control2" placeholder="Intereses">
                            <option value="" disabled selected>Elige un interés...</option>
                            <option value="1">Electrónica</option>
                            <option value="2">Joyería</option>
                            <option value="3">Coleccionable</option>
                            <option value="4">Decoración</option>
                            <option value="5">Prendas</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <fieldset class="password-fieldset">
                <legend>Cambiar contraseña</legend>
                <div class="col-sm-6">
                    <input ng-model="$parent.newPassword" type="password" name="newPassword" class="pass form-control2" placeholder="Nueva contraseña">
                </div>
                <div class="col-sm-6 margen-nac">
                    <input ng-model="$parent.confirmPassword" type="password" name="confirmPassword" class="pass form-control2" placeholder="Confirma tu contraseña">
                </div>
                <div  ng-show="errors.confirmPassword" class=col-sm-12 error-message">* @{{errors.confirmPassword}}</div>
            </fieldset>
        </div>
        <div class="form-group row">
            <fieldset class="password-fieldset">
                <legend>Confirma todos tus cambios con tu contraseña actual</legend>
                <div class="col-sm-6 col-sm-offset-3">
                    <input ng-model="user.password" type="password" name="password" class="pass form-control2" placeholder="Contrasñea actual">
                </div>
                <div  ng-show="errors.password" class=col-sm-12 error-message">* @{{errors.password}}</div>
            </fieldset>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn-login btn-primary" ng-click="updateProfile()">Guardar</button>
                <button type="submit" class="btn-login btn-primary" ng-click="rollback()">Cancelar</button>
            </div>
        </div>
    </form>
</div>
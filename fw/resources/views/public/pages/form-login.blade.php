<div ng-controller="LoginCtrl" class="container col-sm-8 col-sm-offset-2 login-form" style="
     display: none;
     background-color: rgba(250,250, 250, .5); 
     border: solid 1px #8DC53E;
     border-radius: 10px;
     padding: 15px;
     ">
    <form name="formLogin" novalidate="" ng-cloak>
        <h2 class="subtitulo">Ingresar a mi cuenta</h2>
        <div style="clear: both"></div>
        <div class="text-center" style="margin: 10px">
            <a href="{{route('facebook.login')}}"><img src="{{asset('img/facebook-login.png')}}" height="40"></a>
        </div>
        <div class="form-group row">
            <label for="nombre" class="col-form-label col-sm-2">Email</label>
            <div class="col-sm-9">
                <input type="email" required="" name="email" ng-model="email" id="nombre" class="form-control" style="width: 100%"/>
            </div>
        </div>
        <div class="alert alert-danger ng-cloak" style="margin-top: 1px;" 
             ng-show="formLogin.email.$invalid && formLogin.email.$touched">
            <div ng-show="formLogin.email.$error.required">El campo usuario es requerido</div>
            <div ng-show="formLogin.email.$error.email">Escribe tu direccion de correo con la que te has registrado</div>
        </div>
        <div class="form-group row">
            <label for="nombre" class="col-form-label col-sm-2">Password</label>
            <div class="col-sm-9 col-xs-12">
                <input type="password" required="" ng-model="password" name="password" id="nombre" class="form-control" style="width: 100%"/>
            </div>
        </div>

        <div class="alert alert-danger ng-cloak" style="margin-top: 1px"
             ng-show="formLogin.password.$invalid && formLogin.password.$touched">
            <div ng-show="formLogin.password.$error.required">El campo password es requerido</div>
        </div>
        <div class="form-group row">
            <label class="form-check-label col-sm-offset-9" style="white-space: nowrap">
                <input class="form-check-input" type="checkbox" value="" style="height: auto">
                Recordarme
            </label>
        </div>  
        <div class="alert alert-danger ng-cloak" style="margin-top: 1px"
             ng-show="error">
            <div>@{{menssage}}</div>
        </div>
        <div class="form-group row">
            <div class="botonera text-right" style="text-align: right; margin: 10px">
                <a href="" ng-click="login()" class="transicion">Entrar</a>
            </div>
        </div>
        <div class="form-group row text-right" style="padding-right: 15px;">
            <a href="">Recuperar contraseña</a><br>
            <a href="{{route('cart.registration-form')}}">Aun no tengo una cuenta</a>
        </div>
    </form>
</div>
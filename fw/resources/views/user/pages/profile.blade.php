@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Perfil</span>
    </div>

    
<div class="cajadatos margentop30" ng-controller="ProfileUserCtrl">       
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-success ">
      <div class="panel-heading">
        <h3 class="panel-title">Datos Personales</h3>
      </div>
      <div class="panel-body">
        <div class="row">
        <!--   <div class="col-md-3 col-lg-3 " align="center"> <img src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" style="height: 200px; width: 200px" class="img-circle img-responsive"> </div> -->

          <div class=" col-md-10 col-lg-10 col-md-offset-1 col-mg-offset-1 "> 
            <table class="table table-user-information">
              <tbody>
                <tr>
                  <th>Nombre:</th>
                  <td ng-cloak>@{{ user.name }}</td>
                </tr>
                <tr>
                  <th>Correo:</th>
                  <td ng-cloak>@{{ user.email }}</td>
                </tr>
                <tr>
                  <th>Celular:</th>
                	<td ng-cloak>@{{ user.cellphone }}</td>
                </tr>
                <tr>
                  <th>Fecha de nacimiento:</th>
                 	<td ng-cloak>@{{ user.birthdate | date:"dd/MM/yyyy" }}</td>
                </tr>

              </tbody>
            </table>
            <div class="text-center">
              <a ng-click="editProfile()" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar datos</a>
              <a href="{{url('restablecer/password')}}" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Restablecer contraseña</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>  
            
</div>
@stop
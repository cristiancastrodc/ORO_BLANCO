<div class="modal fade" id="modalSesion" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="h3">La sesión ha caducado. Por favor, vuelva a ingresar su usuario y contraseña.</h1>
      </div>
      <div class="modal-body">
        <div ng-show="mensajeSesion">
          <div class="alert alert-danger" role="alert">
            {@ mensajeSesion @}
          </div>
        </div>
        <form>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group input-field">
            <label for="tbUser">Usuario</label>
            <input type="text" class="form-control" id="tbUser" name="tbUser" autocomplete="off" ng-model="user"/>
          </div>
          <div class="form-group input-field">
            <label for="tbPassword">Password</label>
            <input type="password" class="form-control" id="tbPassword" name="tbPassword" ng-model="password"/>
          </div>
          <input type="password" class="fake_pass" id="fake_pass" name="fake_pass">
        </form>
      </div>
      <div class="modal-footer ob-modal-footer">
        <button type="button" class="btn btn-ob main-color waves-effect waves-light" ng-click="validarSesion()" ng-disabled="!user || !password">Entrar</button>
      </div>
    </div>
  </div>
</div>

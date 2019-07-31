<small class="text-muted">Nombre: </small>
<p>{{Auth::user()->usu_nombre}} {{Auth::user()->usu_appaterno}} {{Auth::user()->usu_apmaterno}}</p>
<hr>
<small class="text-muted">C.I.: </small>
<p>{{Auth::user()->usu_ci}}</p>
<hr>
<small class="text-muted">Acceso al Modulo: </small>
<p>{{Auth::user()->usu_modulo}}</p>
<hr>
<small class="text-muted">Cargo: </small>
<p>{{Auth::user()->usu_cargo}}</p>
<hr>
<button class="btn " onclick="showEditUsu()">Actualizar datos</button>
<button class="btn " onclick="refreshPerfil()">Cambiar Contraseña</button>
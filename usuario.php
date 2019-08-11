<?php
  session_start();
  if($_SESSION['roleG']!=0)
  {
  	header("location: login.php");
  }
  require_once "inc/config.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require "inc/headerUploader.php"; ?>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <!-- Navbar Logo, Barra superior donde se tiene las notificaciones el buscador el boton de menu etc-->
    <?php require "inc/navbar.php"; ?>
    <!-- nav bar final -->
    <!-- Sidebar menu lateral -->
    <?php require "inc/menuLateralUsuarios.php"; ?>
    <!-- menu lateral fin -->
    <!-- contenido inicio -->
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-user"></i> Usuarios</h1>
          <p>Gestion de Usuarios</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="configConsole.php">Inicio</a></li>
          <li class="breadcrumb-item">Usuarios</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <span class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoUsuario">
						  	Agregar nuevo <span class="fa fa-plus-circle"></span>
						  </span>
						  <hr>
              <!-- div donde se cargara el data table -->
              <div id="divDataTable">
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- crear modal para nuevo usuario -->
    <form id="wfrNuevoUsuario" name="wfrNuevoUsuario" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modalNuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="txtNombre" name="txtNombre" required>
						<label>CI</label>
						<input type="text" class="form-control input-sm" id="txtCi" name="txtCi">
						<label>Celular</label>
						<input type="number" class="form-control input-sm" id="txtCel" name="txtCel">
            <label>Direccion</label>
						<input type="text" class="form-control input-sm" id="txtDireccion" name="txtDireccion">
            <label>Usuario</label>
						<input type="text" class="form-control input-sm" id="txtUsuario" name="txtUsuario" required>
            <label>Password</label>
						<input type="password" class="form-control input-sm" id="txtPassword" name="txtPassword" required>
            <label>Re-Password</label>
						<input type="password" class="form-control input-sm" id="txtRePassword" name="txtRePassword" required>
            <label>Fecha de Nacimiento</label>
						<input type="date" class="form-control input-sm" id="txtNacimiento" name="txtNacimiento">
            <label>Rol</label>
            <select class="form-control" id="cmbRole" name="cmbRole" required>
              <optgroup label="Rol">
                <?php
                  $query="select * from role";
                  $buscarU=$con->query($query);
                  while($row=$buscarU->fetch(PDO::FETCH_NUM))
                  {
                    echo "<option value='$row[0]'>$row[1]</option>";
                  }
                ?>
              </optgroup>
            </select>
            <label>Foto</label>
            <input id="fileFoto" name="fileFoto" multiple="false" type="file">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Nuevo Usuario</button>
				</div>
			</div>
		</div>
	</div>
  </form>

  <!-- modal para actualizar -->
  <form id="wfrActualizarUsuario" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
            <input type="hidden" class="form-control input-sm" id="hdeCodUsuarioA" name="hdeCodUsuarioA">
            <label>Nombre</label>
						<input type="text" class="form-control input-sm" id="txtNombreA" name="txtNombreA" required>
						<label>CI</label>
						<input type="text" class="form-control input-sm" id="txtCiA" name="txtCiA">
						<label>Celular</label>
						<input type="number" class="form-control input-sm" id="txtCelA" name="txtCelA">
            <label>Direccion</label>
						<input type="text" class="form-control input-sm" id="txtDireccionA" name="txtDireccionA">
            <label>Usuario</label>
						<input type="text" class="form-control input-sm" id="txtUsuarioA" name="txtUsuarioA" required>
            <label>Password</label>
						<input type="password" class="form-control input-sm" id="txtPasswordA" name="txtPasswordA" required>
            <label>Fecha de Nacimiento</label>
						<input type="date" class="form-control input-sm" id="txtNacimientoA" name="txtNacimientoA">
            <label>Rol</label>
            <select class="form-control" id="cmbRoleA" name="cmbRoleA" required>
              <optgroup label="Rol">
                <?php
                  $query="select * from role";
                  $buscarU=$con->query($query);
                  while($row=$buscarU->fetch(PDO::FETCH_NUM))
                  {
                    echo "<option value='$row[0]'>$row[1]</option>";
                  }
                ?>
              </optgroup>
            </select>
            <label>Foto</label>
            <div id="divFotoAntiguo"></div>
            <input id="fileFotoA" name="fileFotoA" multiple="false" type="file">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-warning" id="btnActualizar">Actualizar</button>
				</div>
			</div>
		</div>
  </form>
	</div>

  <!-- Essential javascripts for application to work-->
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- script para funcionar el select con busquedas -->
  <script type="text/javascript" src="js/plugins/select2.min.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <!-- javascript para notificacionse -->
  <script type="text/javascript" src="js/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <!-- llamar a la data table de usuarios -->
    <script type="text/javascript">
      // cargar la datatable usuarios
    	$(document).ready(function(){
        $("#fileFoto").fileinput({
          // uploadUrl: "/file-upload-batch/1",
          // uploadAsync: false,
          overwriteInitial: true,
          allowedFileExtensions: ['jpg', 'png', 'gif'],
          // overwriteInitial: false,
          // maxFileSize: 1000,
          // maxFilesNum: 1,
          allowedFileTypes: ['image'],
          // slugCallback: function(filename) {
          //   return filename.replace('(', '_').replace(']', '_');
          // }
          showUpload: false,
          showCancel: false
        });
        $("#fileFotoA").fileinput({
          // uploadUrl: "/file-upload-batch/1",
          // uploadAsync: false,
          overwriteInitial: true,
          allowedFileExtensions: ['jpg', 'png', 'gif'],
          // overwriteInitial: false,
          // maxFileSize: 1000,
          // maxFilesNum: 1,
          allowedFileTypes: ['image'],
          // slugCallback: function(filename) {
          //   return filename.replace('(', '_').replace(']', '_');
          // }
          showUpload: false,
          showCancel: false
        });
    		$('#divDataTable').load('inc/tablaUsuario.php');
      // llenar por ajax nuevo usuarios
        $(document).on("submit","#wfrNuevoUsuario",function(event){
          event.preventDefault();
          // datos=$('#wfrNuevo').serialize();
          if($('#txtPassword').val() == $('#txtRePassword').val())
          {

            var f = $(this);
            var formData = new FormData(document.getElementById("wfrNuevoUsuario"));
            formData.append("dato", "valor");
            $.ajax({
              url:"ajax/agregarUsuario.php",
              type:"POST",
              dataType: "html",
              data: formData,
              cache: false,
              contentType: false,
    	        processData: false
            })
              // data:datos,
              .done(function(r){
                if(r==1){
                  $('#wfrNuevoUsuario')[0].reset();
                  $('#divDataTable').load('inc/tablaUsuario.php');
                  $('#modalNuevoUsuario').modal('hide');
                  swal("Nuevo Usuario", "El Registro fue Exitoso.", "success");
                }else{
                  swal("Nuevo Usuario", "Error de Registro:"+r, "error");
                }
              });
          }
          else {
            swal("Nuevo Usuario", "El Password no Coincide", "error");

          }

         });

         //ajax actualizar
        $(document).on("submit","#wfrActualizarUsuario",function(event){
          event.preventDefault();
          var f = $(this);
          var formData = new FormData(document.getElementById("wfrActualizarUsuario"));
          formData.append("dato", "valor");
     			$.ajax({
     				url:"ajax/actualizarUsuario.php",
            type:"POST",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
  	        processData: false
          })
            .done(function(r){
              if(r==1){
                $('#modalEditarUsuario').modal('hide');
                swal("Actualizar Usuario","Registro Exitoso!","success");
                $('#divDataTable').load('inc/tablaUsuario.php');
         			}else{
                swal("Nuevo Usuario","Error en Registrar!","error");
         			}
            });

        });
      });
    </script>
    <script type="text/javascript">
      // funcion borrar usuario
      function borrarUsuario(codUsuario)
      {
        swal({
      		title: "Esta Seguro?",
      		text: "Los Datos no Podran Recuperarse!",
      		type: "warning",
      		showCancelButton: true,
      		confirmButtonText: "SI, Borrar!",
      		cancelButtonText: "NO, cancelar!",
      		closeOnConfirm: false,
      		closeOnCancel: true
      	}, function(isConfirm) {
      		if (isConfirm) {
            // llamar ajax para borrar
            $.ajax({
      				type:"POST",
      				data:"codUsuario=" + codUsuario,
      				url:"ajax/eliminarUsuario.php",
      				success:function(r){
      					if(r==1){
      						$('#divDataTable').load('inc/tablaUsuario.php');
                  swal("Borrado!", "El Registro fue Eliminado.", "success");
      					}else{
                  swal("Error de Borrado!", "Hubo un problema con la Conexion.", "error");
      					}
      				}
      			});
      		}
      	});
      }
      // funcion Actualizar
      function llenarDatos(codUsuario)
      {
        // alert(codUsuario);
        $.ajax({
    			type:"POST",
    			data:"codUsuario=" + codUsuario,
    			url:"ajax/obtenDatosUsuario.php",
    			success:function(r){
    				datos=jQuery.parseJSON(r);
            $('#hdeCodUsuarioA').val(datos['codUsuario']);
    				$('#txtNombreA').val(datos['nombre']);
    				$('#txtCiA').val(datos['ci']);
    				$('#txtCelA').val(datos['cel']);
            $('#txtDireccionA').val(datos['direccion']);
            $('#txtUsuarioA').val(datos['usuario']);
            $('#txtPasswordA').val(datos['password']);
            $('#txtNacimientoA').val(datos['fechaNacimiento']);
    				$('#cmbRoleA').val(datos['codRole']);
            $('#divFotoAntiguo').html("<img class='img-fluid' width='150' src='foto/"+datos['foto']+"' >");
    			}
    		});

        $('#modalEditarUsuario').modal('show');
      }
    </script>
  </body>
</html>

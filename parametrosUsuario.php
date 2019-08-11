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
    <?php require "inc/header.php"; ?>
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
          <h1><i class="fa fa-user"></i> Parametros de Usuarios</h1>
          <p>Gestion de Parametros de Usuarios</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="configConsole.php">Inicio</a></li>
          <li class="breadcrumb-item">Parametros de Usuarios</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">

              <!-- div donde se cargara el data table -->
              <div id="divDataTable">
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- crear modal para nuevo usuario -->
  <!-- modal para actualizar -->
  <form id="wfrActualizarUsuario">
  <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Parametros de Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
            <input class="form-control" type="hidden" class="form-control input-sm" id="hdeCodA" name="hdeCodA">
            <label>Nombre</label>
            <input class="form-control" type="text" name="txtNombreA" id="txtNombreA" readonly>
            <label>CI</label>
            <input class="form-control" type="text" name="txtCiA" id="txtCiA" readonly>
            <label>Usuario</label>
            <input class="form-control" type="text" name="txtUsuarioA" id="txtUsuarioA" readonly>
            <label>Linea Empresarial</label>
            <select class="form-control" id="cmbLineaA" name="cmbLineaA" required>
              <optgroup label="Linea Empresarial">
                <option value="0">Ninguno</option>
                <?php
                  $query1="select * from lineaempresa where estado=1";
                  $buscarU1=$con->query($query1);
                  while($row1=$buscarU1->fetch(PDO::FETCH_NUM))
                  {
                    echo "<option value='$row1[0]'>$row1[1]</option>";
                  }
                ?>
              </optgroup>
            </select>
						<label>Almacen</label>
            <select class="form-control" id="cmbAlmacenA" name="cmbAlmacenA" required>
              <optgroup label="Almacen">
                <option value="0">Ninguno</option>
                <?php
                  $query="select * from almacen";
                  $buscarU=$con->query($query);
                  while($row=$buscarU->fetch(PDO::FETCH_NUM))
                  {
                    echo "<option value='$row[0]'>$row[1]</option>";
                  }
                ?>
              </optgroup>
            </select>
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
    <script src="js/jquery-3.2.1.min.js"></script>
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
    		$('#divDataTable').load('inc/tablaParametrosUsuario.php');
      // llenar por ajax nuevo usuarios
         //ajax actualizar
         $(document).on("submit","#wfrActualizarUsuario",function(event){
          event.preventDefault();
     			datos=$('#wfrActualizarUsuario').serialize();
     			$.ajax({
     				type:"POST",
     				data:datos,
     				url:"ajax/actualizarParametroUsuario.php",
     				success:function(r){
     					if(r==1){
                $('#modalEditarUsuario').modal('hide');
                swal("Actualizar Parametros Usuario","Registro Exitoso!","success");
                $('#divDataTable').load('inc/tablaParametrosUsuario.php');
     					}else{
                swal({
                   title: "Parametros de Usuario",
                   text: "Error en Registrar!",
                   icon: "error"
                });
     					}
     				}
     		  });
          });


        });
    </script>
    <script type="text/javascript">
      // funcion borrar usuario

      // funcion Actualizar
      function llenarDatos(codUsuario)
      {
        // alert(codUsuario);
        $.ajax({
    			type:"POST",
    			data:"codUsuario=" + codUsuario,
    			url:"ajax/obtenDatosParametroUsuario.php",
    			success:function(r){
    				datos=jQuery.parseJSON(r);
            $('#hdeCodA').val(datos['codUsuario']);
    				$('#txtNombreA').val(datos['nombre']);
    				$('#txtCiA').val(datos['ci']);
            $('#txtUsuarioA').val(datos['usuario']);
            // alert(datos['codAlmacen']);
            $('#cmbAlmacenA').val(datos['codAlmacen']);
            $('#cmbLineaA').val(datos['codLinea']);

    			}
    		});

        $('#modalEditarUsuario').modal('show');
      }
    </script>
  </body>
</html>

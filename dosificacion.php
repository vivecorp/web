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
  <?php require "inc/headerUploader.php" ?>
</head>
<body class="app sidebar-mini rtl">
  <div id="loading-screen" >
    <img src="images/spinning-circles.svg" >
  </div>
  <!-- Navbar-->
  <!-- Navbar Logo, Barra superior donde se tiene las notificaciones el buscador el boton de menu etc-->
  <?php require "inc/navbar.php"; ?>
  <!-- nav bar final -->
  <!-- Sidebar menu lateral -->
  <?php require "inc/menuLateralConfig.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-cog"></i> Dosificacion</h1>
        <p>Gestion de Dosificaciones</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="configConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Dosificaciones</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <span class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
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

  <form id="wfrNuevo" method="post">
  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Dosificacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>NIT</label>
          <input type="text" class="form-control input-sm" id="txtNit" name="txtNit" required>
          <label>Llave</label>
          <input type="text" class="form-control input-sm" id="txtLlave" name="txtLlave" required>
          <label>Re-Llave</label>
          <input type="text" class="form-control input-sm" id="txtReLlave" name="txtReLlave" required>
          <label>Nro Autorizacion</label>
          <input type="text" class="form-control input-sm" id="txtAutorizacion" name="txtAutorizacion" >
          <label>Re-Nro Autorizacion</label>
          <input type="text" class="form-control input-sm" id="txtReAutorizacion" name="txtReAutorizacion" >
          <label>Fecha Limite</label>
          <input type="date" class="form-control input-sm" id="txtFechaLimite" name="txtFechaLimite" >
          <label>Re-Fecha Limite</label>
          <input type="date" class="form-control input-sm" id="txtReFechaLimite" name="txtReFechaLimite" >
          <label>Estado</label>
          <div class="toggle-flip">
            <label>
              <input type="checkbox" id="chkEstado" checked name="chkEstado"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
            </label>
          </div>
          <label>Actividad Economica</label>
          <select class="form-control" id="cmbActividadEconomica" name="cmbActividadEconomica" required>
            <optgroup label="">
              <?php
                $query="select * from actividadeconomica";
                $buscarU=$con->query($query);
                while($row=$buscarU->fetch(PDO::FETCH_NUM))
                {
                  echo "<option value='$row[0]'>$row[2]</option>";
                }
              ?>
            </optgroup>
          </select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Nuevo Dosificacion</button>
      </div>
    </div>
  </div>
  </div>
  </form>
<!-- modal para actualizar -->
<form id="wfrActualizar" enctype="multipart/form-data" method="post">
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Dosificacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control input-sm" id="hdeCodA" name="hdeCodA">
        <label>NIT</label>
        <input type="text" class="form-control input-sm" id="txtNitA" name="txtNitA" required>
        <label>Llave</label>
        <input type="text" class="form-control input-sm" id="txtLlaveA" name="txtLlaveA" required>
        <label>Nro Autorizacion</label>
        <input type="text" class="form-control input-sm" id="txtAutorizacionA" name="txtAutorizacionA" >
        <label>Fecha Limite</label>
        <input type="date" class="form-control input-sm" id="txtFechaLimiteA" name="txtFechaLimiteA" >
        <label>Estado</label>
        <div class="toggle-flip">
          <label>
            <input type="checkbox" id="chkEstadoA"  name="chkEstadoA"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
          </label>
        </div>
        <label>Actividad Economica</label>
        <select class="form-control" id="cmbActividadEconomicaA" name="cmbActividadEconomicaA" required>
          <optgroup label="">
            <?php
              $query="select * from actividadeconomica";
              $buscarU=$con->query($query);
              while($row=$buscarU->fetch(PDO::FETCH_NUM))
              {
                echo "<option value='$row[0]'>$row[2]</option>";
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
  <!-- <script src="js/jquery-3.2.1.min.js"></script> -->
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
    $(document).ready(function(){
      // loader Inicio
      var screen = $('#loading-screen');
      configureLoadingScreen(screen);
      // uploader java
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
      // carga del datatable
      $('#divDataTable').load('inc/tablaDosificacion.php');
    // llenar por ajax nuevo usuarios
      // $(document).on("submit","#wfrNuevo",function(event){
      $(document).on("submit","#wfrNuevo",function(event){
        event.preventDefault();

        band=0;
        if($('#txtLlave').val() != $('#txtReLlave').val())
        {
          band=1;
          msg="Las Llaves no son Iguales";
        }
        if($('#txtAutorizacion').val() != $('#txtReAutorizacion').val())
        {
          band=1;
          msg="Los Nro de Autorizacion no son Iguales";
        }
        if($('#txtFechaLimite').val() != $('#txtReFechaLimite').val())
        {
          band=1;
          msg="Las Fechas Limites no son Iguales";
        }
        if(band==0)
        {
          datos=$('#wfrNuevo').serialize();
          $.ajax({
            type:"POST",
            data:datos,
            url:"ajax/agregarDosificacion.php",
            success:function(r){
              if(r==1){
                $('#wfrNuevo')[0].reset();
                $('#divDataTable').load('inc/tablaDosificacion.php');
                $('#modalNuevo').modal('hide');
                swal("Nueva Dosificacion","Registro Satisfactorio!","success");
              }
              else{
                swal("Nueva Dosificacion","Error de Registro!","error");
              }
            }
          });
        }
        else {
          swal("Nueva Dosificacion",msg,"error");
        }
      });
       //ajax actualizar
      $(document).on("submit","#wfrActualizar",function(event){
        event.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("wfrActualizar"));
        formData.append("dato", "valor");
        $.ajax({
          url:"ajax/actualizarDosificacion.php",
          type:"POST",
          dataType: "html",
          data: formData,
          cache: false,
          contentType: false,
	        processData: false
        })
        .done(function(r){
          if(r==1){
            $('#modalEditar').modal('hide');
            swal("Actualizar Dosificacion", "El Registro fue Exitoso.", "success");
            $('#divDataTable').load('inc/tablaDosificacion.php');
          }else{
            swal("Actualizar Dosificacion", "Error de Registro:"+r, "error");
          }
        });

      });
    });


  </script>
  <script type="text/javascript">
    // funcion borrar

    // funcion Actualizar
    function llenarDatos(cod)
    {
      // alert(codUsuario);
      $.ajax({
        type:"POST",
        data:"cod=" + cod,
        url:"ajax/obtenDatosDosificacion.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          $('#hdeCodA').val(datos['codDosificacion']);
          $('#txtNitA').val(datos['nit']);
          $('#txtLlaveA').val(datos['llave']);
          $('#txtAutorizacionA').val(datos['nroAutorizacion']);
          $('#txtFechaLimiteA').val(datos['fechaLimite']);
          // $('#txtTelefonoA').val(datos['telefono']);
          chk=datos['estado'];
          // $('#txA').val(estado);
          if(chk==1)
          {
            $('#chkEstadoA').prop('checked', true);
          }
          if(chk==2)
          {
            $('#chkEstadoA').prop('checked', false);
          }

          $('#cmbActividadEconomicaA').val(datos['codActividadEconomica']);
        }
      });

      $('#modalEditar').modal('show');
    }
    // loader
    function configureLoadingScreen(screen){
      $(document)
        .ajaxStart(function () {
          screen.fadeIn();
        })
        .ajaxStop(function () {
          screen.fadeOut();
        });
    }
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require "inc/headerUploader.php" ?>
</head>
<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <!-- Navbar Logo, Barra superior donde se tiene las notificaciones el buscador el boton de menu etc-->
  <?php require "inc/navbar.php"; ?>
  <!-- nav bar final -->
  <!-- Sidebar menu lateral -->
  <?php require "inc/menuLateralProductos.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-user"></i> Lineas Empresarial</h1>
        <p>Gestion de Lineas Empresarial</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Lineas Empresarial</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">

            <input id="foto" name="foto" class="file-loading" type="file" multiple="false" align="center">

          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- crear modal para nuevo usuario -->



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

  <script>
      $("#foto").fileinput({
        // uploadUrl: 'upload.php', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        // overwriteInitial: false,
        // maxFileSize: 1000,
        // maxFilesNum: 1,
        allowedFileTypes: ['image'],
        // slugCallback: function(filename) {
        //   return filename.replace('(', '_').replace(']', '_');
        // }
        showUpload: false
      });
    </script>

  <!-- llamar a la data table de usuarios -->
  <script type="text/javascript">

    // cargar la datatable usuarios
    $(document).ready(function(){
    // preview imagen del Uploader
//     $("#input-b9").fileinput({
//   uploadUrl: "/file-upload-batch/1",
//   theme: 'explorer-fa',
//   uploadAsync: true,
//   reversePreviewOrder: true,
//   initialPreviewAsData: true,
//   overwriteInitial: false,
//   initialPreview: [
//       "http://lorempixel.com/800/460/animals/3",
//       "http://lorempixel.com/800/460/animals/4",
//       "http://lorempixel.com/800/460/animals/5",
//       "http://lorempixel.com/800/460/animals/6",
//       "http://lorempixel.com/800/460/animals/7"
//   ],
//   initialPreviewConfig: [
//       {caption: "Animals-3.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 3},
//       {caption: "Animals-4.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 4},
//       {caption: "Animals-5.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 5},
//       {caption: "Animals-6.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 6},
//       {caption: "Animals-7.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 7}
//   ],
//   allowedFileExtensions: ["jpg", "png", "gif"]
// }).on('filesorted', function(e, params) {
//   console.log('Modified initial preview is ', $("#input-pr-rev").data('fileinput').initialPreview);
// })


      $('#divDataTable').load('inc/tablaLineaEmpresa.php');
    // llenar por ajax nuevo usuarios
      $(document).on("submit","#wfrNuevo",function(event){
        event.preventDefault();
        datos=$('#wfrNuevo').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"ajax/agregarLineaEmpresa.php",
          success:function(r){
            if(r==1){
              $('#wfrNuevo')[0].reset();
              $('#divDataTable').load('inc/tablaLineaEmpresa.php');
              $('#modalNuevo').modal('hide');
              swal({
                title: "Nueva Linea Empresarial",
                text: "Registro Exitoso!",
                icon: "success"
              });
            }else{
              swal({
                title: "Nueva Linea Empresarial",
                text: "Error en Registrar!",
                icon: "error"
              });

            }
          }
        });
       });

       //ajax actualizar
       $(document).on("submit","#wfrActualizar",function(event){
        event.preventDefault();
        datos=$('#wfrActualizar').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"ajax/actualizarProveedor.php",
          success:function(r){
            if(r==1){
              $('#modalEditar').modal('hide');
              swal({
                title: "Actualizar Proveedor",
                text: "Registro Exitoso!",
                icon: "success"
              });
              $('#divDataTable').load('inc/tablaProveedor.php');
            }else{
              swal({
                 title: "Actualizar Proveedor",
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
    // funcion borrar
    function borrar(cod)
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
      },function(isConfirm) {
        if (isConfirm) {
          // llamar ajax para borrar
          $.ajax({
            type:"POST",
            data:"cod=" + cod,
            url:"ajax/eliminarProveedor.php",
            success:function(r){
              if(r==1){
                $('#divDataTable').load('inc/tablaProveedor.php');
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
    function llenarDatos(cod)
    {
      // alert(codUsuario);
      $.ajax({
        type:"POST",
        data:"cod=" + cod,
        url:"ajax/obtenDatosProveedor.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          $('#hdeCodProveedorA').val(datos['codProveedor']);
          $('#txtEmpresaA').val(datos['empresa']);
          $('#cmbPaisA').val(datos['pais']);
          $('#txtContactoA').val(datos['contacto']);
          $('#txtEmailA').val(datos['email']);
          $('#txtTelefonoA').val(datos['tel']);
          $('#txtCelularA').val(datos['cel']);
          $('#txtDireccionA').val(datos['direccion']);
        }
      });

      $('#modalEditar').modal('show');
    }
  </script>
</body>
</html>

$(document).on("submit","#wfrLogin",function(event){
  event.preventDefault();
  var $form = $(this);
  var dataForm = {
    usuario: $("#txtUsuario").val(),
    password: $("#txtPassword").val()
  }
  var urlPhp = 'ajax/procesarLogin.php';
  $.ajax({
    type: 'POST',
    url: urlPhp,
    data: dataForm,
    dataType: 'json',
    async: true,
  })
  .done(function ajaxDone(res){
    console.log(res);
    if(res.error !== undefined){
      $("#msgError").html(res.error).show();
      return false;
    }
    if(res.redirect !== undefined){
      window.location = res.redirect;
    }
  })
  .fail(function ajaxError(e){
    console.log(e);
  })
  .always(function ajaxSiempre(){
    console.log('final de la llamada ajax');
  })
  return false;
});

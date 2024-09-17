$(document).ready(function(){ 
   /* $.getJSON('http://api.wipmania.com/jsonp?callback=?', function (data) {
        $("#btn_pais").html("País: " + data.address.country);
    });*/

    $("#btn_entrar").click(function(evento){
        evento.preventDefault();
        if($("#txt_usuario").val()===""){
            mostrar_msg("Por favor digite su Usuario");
            $("#txt_usuario").focus();
        }else if($("#txt_clave").val()===""){
            mostrar_msg("Por favor digite su Clave de Acceso");
            $("#txt_usuario").focus();
        }else{
            autenticar();
        }
    });
    
    function autenticar(){
        var parametros = {
            "usuario"   : $("#txt_usuario").val(),
            "clave"     : $("#txt_clave").val(),
            "llamador"  : "autenticar"
        };
	
         $.ajax({
          url:   "backend/controlador_admin.php",
          type: 'POST',
          data: parametros,
          error : function() {
            mostrar_msg("Ocurrio un Error al autenticarse");
          },
          success: function(r){
              if(r.length<3){
                mostrar_msg("La cuenta no existe, intente nuevamente");
              }else{
                  $("#contenedor").load("dashboard.html");
              }
              
          }
      });
    }

    
   function mostrar_msg(cuerpo){
        $('#cuerpo').html("<p>"+cuerpo+"</p>");
        $("#btn_ventana_modal").click();
    }
    
    
    
});

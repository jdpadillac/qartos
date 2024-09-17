$(document).ready(function(){ 

    $("#div_cabecera").load("../frontend/cabecera.html");

   $("#btn_cambiar_clave").click(function(event){
       event.preventDefault();
       
       if($("#txt_clave").val()===""){
            mostrar_ventana_msg("Por favor digite su nueva Clave");
            $("#txt_clave").focus();
            
       }else if($("#txt_clave1").val()===""){
           mostrar_ventana_msg("Por favor repita su nueva Clave");
            $("#txt_clave1").focus();
            
       }else if($("#txt_clave").val() !== $("#txt_clave1").val()){
            mostrar_ventana_msg("Las claves no concuerdan");
            $("#txt_clave1").focus();
            
       }else{
           modificar_clave();
       }
       
       
   });

    
    
    function modificar_clave(){
        
        var parametros = {
            "id_usuario" : $("#id_usuario").val(),
            "clave"      : $("#txt_clave").val(),
            "llamador"   : "modificar_clave"
        };
        
        $.ajax({
            url:   "../backend/controlador.php",
            type: 'POST',
            //dataType : 'json',
            data: parametros,
            error : function(e) {
         
                 mostrar_ventana_msg("Ocurrio un error al cambiar la Clave");
                 
             },
             success: function(result){
                mostrar_ventana_msg("Clave cambiada.<br>" + result);
             }

         });
    }
    
   
    
    
    function mostrar_ventana_msg(cuerpo){
        $('#cuerpo_msg').html(cuerpo);
        $("#btn_msg").click();
    }
    
});

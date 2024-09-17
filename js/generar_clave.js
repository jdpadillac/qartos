$(document).ready(function(){ 

    /* Pantalla de index */
    $("#mnu_recuperar_clave").click(function(){
        ventana_recuperar_clave();
    });

    function ventana_recuperar_clave(){
        $("#cuerpo").hide();
        $("#div_recuperar_clave_index").show();
        $("#btn_ventana_modal").click();
    }

    $("#btn_recuperar_clave_index").click(function(){
        armar_clave($("#txt_recuperar_clave_index").val(),"backend/controlador.php","index");
    });

    function armar_clave(correo, camino,pantalla){
        if(correo===null || correo===""){
            alert("Por favor digite su cuenta de correo");
        }else{
            var abecedario = ["a","b","c","d","e","f","g","h","i","j","k",
                "l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
                "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O",
                "P","Q","R","S","T","U","V","W","X","Y","Z",
                "0","1","2","3","4","5","6","7","8","9",
                ".","-","_","$","&","#","@"];

            var numeroAleatorio = 3;
            var clave_new="";
            for(var i = 0; i<8; i++){
                numeroAleatorio = parseInt(Math.random()*abecedario.length);
                clave_new+=abecedario[numeroAleatorio];
            }
            grabar_clave_temporal(correo,clave_new,camino,pantalla);
           
        }
    }

    function grabar_clave_temporal(correo, clave,camino, pantalla){
        var parametros = {
            "correo"   : correo,
            "clave"    : clave,
            "llamador" : "modificar_clave_recuperar"
        };

        $.ajax({
            url: camino,
            data: parametros,            
            type: "POST",
            error : function() {
                alert("Ocurrio un error al generar su clave temporal");
            },

            success: function () {
                $("#nbres_correo").val("");
                $("#municipio_correo").val("");
                $("#correo_correo").val(correo);
                $("#clave_correo").val(clave);
                $("#id_correo").val("");
                $("#destinbo_correo").val("Recuperar_Clave");
                $("#btn_enviar_correo").click();
                var div_clave="";
                var div_cuerpo="";

                if(pantalla==="index"){
                    div_clave="div_recuperar_clave_index";
                    div_cuerpo="cuerpo";

                }else{
                    div_clave="div_recuperar_clave";
                    div_cuerpo="div_cuerpo";

                }
                enviar_correo(div_cuerpo,"","",correo,clave,"","Recuperar_Clave");
                $("#"+div_clave).hide();
                $("#"+div_cuerpo).html("Se ha enviado un correo electrónico a la cuenta <strong>" + correo +
                "</strong><br>Revise su correo para recuperar su clave." +
                "<br><br><em>Equipo de qartos!</em>");
                $("#"+div_cuerpo).show();
                   
                
            }
        });
    }
   
    /**Pantalla de busqueda */
    $("#btn_recuperar_clave_buscar").click(function(){
        armar_clave($("#txt_recuperar_clave_buscar").val(),"../backend/controlador.php","buscar");
    });

    /*Función para el envío de correo */
    function enviar_correo(div,nbres,municipio,correo,clave,id,destino){
        var url="";
        var parametros = {
            "nbres_destino" : nbres,
            "municipio"     : municipio,
            "correo"        : correo,
            "clave"         : clave,
            "id"            : id,
            "destino"       : destino
        };
        
        var pathname = window.location.pathname;
        /*var URLactual = window.location.href;
        var loc = window.location;
        var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
        var ruta= loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
        var dominio = window.location.host;
        var URLhash = window.location.hash;
        var URLsearch = window.location.search;

        alert("pathname " + pathname + 
        "<br> URL " + URLactual + 
        "<br> Ruta absoluta " + ruta + 
        "<br> Dominio " + dominio +
        "<br> Hash " + URLhash + 
        " <br> Search " + URLsearch);*/
        if(pathname!=="/qartos_v3/"){       //Servidor local
            url="../";
        }
        /*if(pathname!==""){                //Servidor en la web
            url="../";
        }*/


        $.ajax({
            url: url+"backend/correo/enviar_correo.php",
            data: parametros,
            type: "POST",
            error : function(e) {
                $("#"+div).html("Ocurrió un error al enviar el correo de cambio de clave." +
                    "<br><br><em>Equipo de qartos!</em>");
            },
            success: function (data) {
                $("#"+div).html("Se ha enviado un correo electrónico a la cuenta <strong>" + correo +
                    "</strong><br>Revise su correo para recuperar su clave." +
                    "<br><br><em>Equipo de qartos!</em>");
            }
        });
    }
});
$(document).ready(function(){ 

        id_usuario    = "";
        nbre_usuario  = "";
        correo_usuario= "";
        codigo_moneda = "";           //codigo internacional de la moneda
        simbolo_moneda= "";           //simbolo internacional de la modeda
        calificacion1 =0;
        calificacion2 =0;
        calificacion3 =0;
    
    
    var list_municipios;            //maneja el array de municipios seleccionados
    
    $("#btn_autenticarse").click(function(event){
        event.preventDefault();
        if($("#email").val()===""){
            mostrar_msg("Por favor digite su cuenta de correo");
            $("#email").focus();
            
        }else if ($("#clave").val()===""){
            mostrar_msg("Por favor digite su Clave de acceso");
             $("#clave").focus();
             
        }else{
            validar_acceso();
        }
   });
    
    
     $("#mnu_crear_propiedad").click(function(event){
        event.preventDefault();
        window.open("frontend/propiedad.php?id_usuario="+id_usuario+"&nbre_usuario="+nbre_usuario);
    });
    
    $(".terminos").click(function(event){
        event.preventDefault();
        window.open("politicas.pdf");
    });
    
    $("#mnu_administrar_propiedades").click(function(event){
        event.preventDefault();
        window.open("frontend/listar.php?id_propietario="+id_usuario+"&nbre_propietario="+nbre_usuario);
    });
    
    $("#mnu_calificaciones").click(function(event){
        event.preventDefault();
        window.open("frontend/calificaciones.php?"+
                "id_usuario="+id_usuario+
                "&nbre_usuario="+nbre_usuario+
                "&cal1="+calificacion1+
                "&cal2="+calificacion2+
                "&cal3="+calificacion3);
    });
    
    $("#mnu_cambiar_clave").click(function(event){
        event.preventDefault();
        window.open("frontend/cambiar_clave.php?" +
        "id_usuario="+id_usuario +
        "&nbre_usuario="+nbre_usuario);
    });
    
    $("#mnu_modificar_informacion").click(function(event){
        event.preventDefault();
        window.open("frontend/editar_informacion.php?id_usuario="+id_usuario+"&nbre_usuario="+nbre_usuario);
    });
    
    $("#mnu_salir").click(function(event){
        event.preventDefault();
        mostrar_msg("Gracias por visitarnos<br>" +
        "Regresa pronto!<br><br>" +
        "qartos teams.");
        location.reload();
    });
    
    
    $("#btn_registrarme").click(function(event){
        event.preventDefault();
        if($("#txt_nbres_reg").val()===""){
            mostrar_msg("Por favor digite sus Nombres");
            $("#txt_nbres_reg").focus();
            
        }else if($("#txt_apellidos_reg").val()===""){
            mostrar_msg("Por favor digite sus Apellidos");
            $("#txt_apellidos_reg").focus();
            
        }else if($("#txt_municipio_reg").val()===""){
            mostrar_msg("Por favor digite el Municipio donde vive");
            $("#txt_municipio_reg").focus();
            
        }else if($("#txt_correo_reg").val()===""){
            mostrar_msg("Por favor digite su cuenta de Correo");
            $("#txt_correo_reg").focus();
            
        }else if ($("#txt_clave_reg").val()===""){
            mostrar_msg("Por favor digite su Clave de acceso");
            $("#txt_clave_reg").focus();
            
        }else{
            grabar_usuario();
        }
   });
   
    $(".btn_buscar_arriendo").click(function(event){
        event.preventDefault();
        window.open('frontend/buscar.php?servicio=ARRIENDO'+    //servicio que se buscará
        "&id_usuario="+id_usuario +                             //id del usuario registrado
        "&nbre_usuario="+nbre_usuario+                          //nbre del usuario registrado
        "&correo_usuario="+correo_usuario);                     //correo del usuario registrado
   });
   
    $(".btn_buscar_compra").click(function(event){
        event.preventDefault();
        window.open('frontend/buscar.php?servicio=COMPRA'+      //servicio que se buscará
        "&id_usuario="+id_usuario +                             //id del usuario registrado
        "&nbre_usuario="+nbre_usuario+                          //nbre del usuario registrado
        "&correo_usuario="+correo_usuario);                     //correo del usuario registrado
   });
    
    $(".btn_buscar_alojamiento").click(function(event){
        event.preventDefault();
        window.open('frontend/buscar.php?servicio=ALOJAMIENTO'+    //servicio que se buscará
        "&id_usuario="+id_usuario +                             //id del usuario registrado
        "&nbre_usuario="+nbre_usuario +                         //nbre del usuario registrado
        "&correo_usuario="+correo_usuario);                     //correo del usuario registrado
   });
   
   $(".btn_buscar_subasta").click(function(event){
        window.open('frontend/buscar.php?servicio=SUBASTA'+    //servicio que se buscará
        "&id_usuario="+id_usuario +                             //id del usuario registrado
        "&nbre_usuario="+nbre_usuario +                         //nbre del usuario registrado 
        "&correo_usuario="+correo_usuario);                     //correo del usuario registrado
   });
   
   
    $("#btn_contactenos").click(function(event){
        event.preventDefault();    
        if($("#txt_nbre").val()===""){
            mostrar_msg("Por favor digite un Nombre de Contacto");
            $("#contactenos").focus();
            
        }else if($("#txt_correo").val()===""){
            mostrar_msg("Por favor digite un correo para contactarlo");
            $("#contactenos").focus();
            
        }else if($("#txt_msg").val()===""){
            mostrar_msg("Por favor digite un Mensaje");
            $("#contactenos").focus();
        }else{
            grabar_contactenos();
        }
    });
    
    
   /*Busca los municipios por cada tecla que se digite*/
    $('#txt_nbre_municipio_reg').typeahead({
       
        source: function (tecla, result) {
            var llamador = "nbre_municipio";
            var parametros = {
                "tecla"    : tecla,
                "llamador" : llamador
            };

            $.ajax({
                url: "backend/controlador.php",
                data: parametros,            
                dataType: "json",
                type: "POST",
                error : function(e) {
                    mostrar_msg("Ocurrio un error al consultar el Municipio");
                    
                },
                success: function (data) {
                    list_municipios=data;
                    result($.map(data, function (resultado) {
                        return $.trim(resultado.Municipio); //Esto es lo que se muestra en la lista
                    }));
                }
            });
        }
    });
    
     $("#txt_nbre_municipio_reg").blur(function(){   //perdió el foco
     
         $.each(list_municipios, function (i){
             if($.trim(list_municipios[i].Municipio)===$.trim($("#txt_nbre_municipio_reg").val())){
                $("#txt_id_municipio_reg").val(list_municipios[i]["Id"]);
                simbolo_moneda = list_municipios[i]["Simbolo"];
                codigo_moneda  = list_municipios[i]["Cod_Moneda"];
             }
         });
    });
    
   
   
   function grabar_usuario(){
       var parametros = {
            "nbres"     : $("#txt_nbres_reg").val(),
            "apellidos" : $("#txt_apellidos_reg").val(),
            "municipio" : $("#txt_id_municipio_reg").val(),
            "correo"    : $("#txt_correo_reg").val(),
            "clave"     : $("#txt_clave_reg").val(),
            "llamador"  : "grabar_usuario"
        };

        $.ajax({
            url: "backend/controlador.php",
            data: parametros,
            type: "POST",
            error : function(e) {
                mostrar_msg("Ocurrio un error al grabar al Usuario ");
            },
            success: function (id) {
                id_usuario = id
                nbre_usuario = $("#txt_nbres_reg").val();
                enviar_correo(
                    nbre_usuario,
                    "",
                    $("#txt_correo_reg").val(),
                    $("#txt_clave_reg").val(),
                    id,
                    "Registro_Usuario");

                mostrar_msg("Bienvenido " + nbre_usuario);
                $("#navbarDropdown").html(nbre_usuario);
                $("#navbarDropdown").removeAttr("class");
                $("#navbarDropdown").attr("class","nav-link dropdown-toggle");
                mostrar_msg("Gracias por registrarse con nosotros!.<br>" +
                "Ahora podrá realizar cualquier tipo de transacciones.<br>" +
                "Arriende, compre, venda, comercialice propiedades!<br>");
            }
        });
        
   }
   
   
    function grabar_contactenos(){
       var parametros = {
            "nbre"     : $("#txt_nbre").val(),
            "celular"  : $("#txt_celular").val(),
            "correo"   : $("#txt_correo").val(),
            "msg"      : $("#txt_msg").val(),
            "llamador" : "grabar_contactenos"
        };

        $.ajax({
            url: "backend/controlador.php",
            data: parametros,
            type: "POST",
            error : function(e) {
                mostrar_msg("Ocurrio un error al grabar el Mensaje");
            },
            success: function (data) {
                enviar_correo($("#txt_nbre").val(), "",$("#txt_correo").val(),"","","Contactenos");
                mostrar_msg("Gracias por contáctarnos!.<br>" +
                "Su mensaje ha sido recibo con éxito<br>" + 
                "Pronto nos pondremos en contacto con usted");
            }
        });
        
   }
   
   function validar_acceso(){
       var parametros = {
            "correo"   : $("#email").val(),
            "clave"    : $("#clave").val(),
            "llamador" : "validar_acceso"
        };
        
        $.ajax({
            url: "backend/controlador.php",
            data: parametros,            
            dataType: "json",
            type: "POST",
            error : function(e) {
                mostrar_msg("Ocurrio un error al autenticar su cuenta de accesos " + e);
            },
            success: function (data) {
               if(data.length===0){
                    mostrar_msg("Por favor revise los datos de acceso");
               }else{
                    id_usuario      = data[0].Id;
                    nbre_usuario    = data[0].Nbres;
                    calificacion1   = data[0].Calificacion1;
                    calificacion2   = data[0].Calificacion2;
                    calificacion3   = data[0].Calificacion3;
                    correo_usuario  = $("#email").val();
                    $("#navbarDropdown").removeAttr("class");
                    $("#navbarDropdown").attr("class","nav-link dropdown-toggle");
                    $("#navbarDropdown").html(nbre_usuario);
                    //mostrar_msg("Bienvenido " + nbre_usuario);
               }

                
            }
        });
        
   }
    

   /* Función para mostrar un mensaje en ventana modal*/
    function mostrar_msg(mensaje){
        $("#div_recuperar_clave_index").hide();
        $("#cuerpo").html(mensaje);
        $("#btn_ventana_modal").click();
    }
    



    
    /***** Manejo de correos *****/
     $("#btn_enviar_correo").click(function(event){
        event.preventDefault();    
        
        enviar_correo($("#nbres_correo").val(),
        $("#municipio_correo").val(),
        $("#correo_correo").val(),
        $("#clave_correo").val(),
        $("#id_correo").val(),
        $("#destino_correo").val());
    });
    

     /***** Función para enviar correos *****/
     function enviar_correo(nbres,municipio,correo,clave,id,destino){
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
                mostrar_msg("Ocurrió un error al enviar el correo." +
                    "<br><br><em>Equipo de qartos!</em>");
            },
            success: function (data) {
                mostrar_msg("Se ha enviado un correo electrónico a la cuenta <strong>" + correo +
                    "</strong><br>." +
                    "<br><br><em>Equipo de qartos!</em>");
            }
        });
    }

   
});
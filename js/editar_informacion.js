$(document).ready(function(){ 
    var list_buscar;                //maneja el array de municipios seleccionados
    $("#div_cabecera").load("../frontend/cabecera.html");
    
    cargar_combo("bancos");
    function cargar_combo(tabla){
        var parametros = {
            "tabla"    : tabla,
            "llamador" : "cargar_combo"
        };

         $.ajax({
          url:   "../backend/controlador.php",
          type: 'POST',
          dataType : 'json',
          data: parametros,
          error : function() {

              mostrar_ventana_modal("¡ERROR¡<br>Ocurrio un error al cargar el combo de Bancos");
          },
          success: function(data){
              $.each(data,function(key, registro) {
                  $("#cta_banco").append('<option value='+registro.Id+'>'+registro.Nbre+'</option>');
              });
            }
      });   
    }

    cargar_tarjeta();
    
    function cargar_tarjeta(){
        var id_usuario   =$("#id_usuario").val();
        var llamador ="consultar_datos_usuario";

        var parametros = {
            "id_usuario" : id_usuario,
            "llamador"   : llamador
        };
        $.ajax({
          url:   "../backend/controlador.php",
          type: 'POST',
          data: parametros,
          dataType : 'json',
          error : function() {
              mostrar_msg("Ocurrio un error al consultar sus datos");
          },
          success: function(datos){
              
            $.each(datos, function (i){
            
              $("#card_nombre").html(datos[i].Nbre);
              $("#card_municipio").html("&nbsp;&nbsp;"+datos[i].Municipio);
              $("#card_pais").html("&nbsp;&nbsp;"+datos[i].Pais+" - " + datos[i].Dpto);
              $("#card_direccion").html("&nbsp;&nbsp;"+datos[i].Direccion);
              $("#card_telefono").html("&nbsp;&nbsp;"+datos[i].Telefono);
              $("#card_correo").html("&nbsp;&nbsp;"+datos[i].Correo);
              $("#dir_correo").val(datos[i].Correo);
              $("#id_paisA").val(datos[i].Id_Pais);
              $("#id_dptoA").val(datos[i].Id_Dpto);
              $("#id_municipioA").val(datos[i].Id_Municipio);
              $("#cta_nbre").val(datos[i].Cta_Nbre);
              $("#cta_tipo").val(datos[i].Cta_Tipo);
              $("#cta_numero").val(datos[i].Cta_Numero);
              $("#cta_banco").val(datos[i].Cta_Banco);
              
              cargar_foto(datos[i].Foto);
            });
          }
        });
       
    }
    
    function cargar_foto(foto) {
        var carpeta = '../img/users/'+$("#id_usuario").val()+'/'+foto;
        $('#fotoA + img').remove();
        $('#fotoA').prop('src',carpeta);
        $('#fotoA').prop('class',"img-fluid");
        $('#fotoA').attr('width',"100%");
        $('#fotoA').attr('height',"200px");
    }
    
    $("#rutaFoto").change(function () {
        previsualizar_imagen(this);
    });

    function previsualizar_imagen(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#fotoA + img').remove();
                $('#fotoA').prop('src',e.target.result);
                $('#fotoA').prop('class',"img-fluid");
                $('#fotoA').attr('width',"100%");
                $('#fotoA').attr('height',"200px");
                $('#txtFotoA').val($('#rutaFoto').val().toString().substr(12));
            };
        }
    }
    
    
    /*Busca los municipios por cada tecla que se digite*/
    $('#nbre_municipioA').typeahead({
       source: function (tecla, result) {
            var llamador = "nbre_municipio";
           var parametros = {
               "tecla"    : tecla,
               "llamador" : llamador
           };
           
           $.ajax({
               url: "../backend/controlador.php",
               data: parametros,            
               dataType: "json",
               type: "POST",
               error : function(e) {
                 mostrar_msg("Ocurrio un error al cobsultar los Municipios" + e);
                },
               success: function (data) {
                    list_buscar=data;
                    result($.map(data, function (resultado) {
                        return $.trim(resultado.Municipio); //Esto es lo que se muestra en la lista
                    }));
                }
           });
       }
    });
    
   
    
    $("#nbre_municipioA").blur(function(){   //perdió el foco
         $.each(list_buscar, function (i){
             //alert("compara " + $.trim(list_buscar[i].Municipio) + " contra " + $.trim($("#nbre_municipio").val()));
             
             if($.trim(list_buscar[i].Municipio)===$.trim($("#nbre_municipioA").val())){
                $("#id_paisA").val(list_buscar[i]["Id_Pais"]);
                $("#id_dptoA").val(list_buscar[i]["Id_Dpto"]);
                $("#id_municipioA").val(list_buscar[i]["Id"]);
             }
         });
    });
    
    $("#btn_grabar_foto").click(function(evento){
        evento.preventDefault();

        if($("#txtFotoA").val()===""){
            mostrar_msg("Aún no ha seleccionado una foto");

        }else{

            var id_usuario = $("#id_usuario").val();
            var foto = $("#txtFotoA").val();
            var llamador = "actualizar_foto_usuario";

            var parametros = {
                "id_usuario": id_usuario,
                "foto"      : foto,
                "llamador"  : llamador
            };
            $.ajax({
                url: "../backend/controlador.php",
                type: 'POST',
                data: parametros,
                error: function () {
                    mostrar_msg("Ocurrio un error al actualizar la foto en la base de datos");
                },
                success: function () {
                    grabar_foto_en_servidor();
                }
            });
        
        }        
     });
     
     function grabar_foto_en_servidor(){
        var datos = new FormData();
            datos.append('rutaFoto', $('#rutaFoto')[0].files[0]);
            datos.append('id', $('#id_usuario').prop('value'));
            datos.append('tipo', 'users');
            
        $.ajax({
            url: '../backend/subir_foto_personal.php',
            type: 'post',
            data: datos,
            contentType: false,
            processData: false,
            error : function(resp) {
                mostrar_msg("Ocurrio un problema al grabar la foto!<br><br>"+resp);
          },
            success: function(resp) {
                mostrar_msg("Su Foto fue actualizada con éxito");
                
            }
        });
     }
     
    $("#btn_modificar_usuario").click(function(evento){
        evento.preventDefault();

        var correo    =$("#correoA").val();
        
        if(correo!==""){        //Reviso que el nuevo correo no este registrado

            var parametros = {
                "correo"    : correo,
                "llamador"  : "consultar_existencia_correo"
            };
            $.ajax({
              url:   "../backend/controlador.php",
              type: 'POST',
              data: parametros,
              error : function() {
                mostrar_msg("Ocurrio un error al consultar si existe la cuenta de correo");
              },
              success: function(msj){
                  if(msj.length>2){         //Existe el correo
                    mostrar_msg("El Correo suministrado ya existe en nuestra base de datos<br>Por favor cambie su cuenta de correo de registro");
                  }else{
                    actualizar_datos_usuario();
                  }
                  return false;
              }
            });
            
        }else{          //No hay datos para actualizar el correo
            actualizar_datos_usuario();
            
        }
    });
    
    function actualizar_datos_usuario(){
        var id_usuario =$("#id_usuario").val();
        var municipio =$("#id_municipioA").val();
        var direccion =$("#direccionA").val();
        var telefono  =$("#telefonoA").val();
        var correo    =$("#correoA").val();
        var clave     =$("#claveA").val();
        var cta_nbre  =$("#cta_nbre").val();
        var cta_tipo  =$("#cta_tipo").val();
        var cta_numero=$("#cta_numero").val();
        var cta_banco =$("#cta_banco").val();
        var llamador  ="modificar_usuario";

        if(municipio!=="" || direccion!=="" || telefono!=="" || correo!=="" || clave!==""
            || cta_nbre!=="" || cta_tipo!=="" || cta_numero!=="" || cta_banco!==""){
            var parametros = {
                "id_usuario": id_usuario,
                "municipio" : municipio,
                "direccion" : direccion,
                "telefono"  : telefono,
                "correo"    : correo,
                "clave"     : clave,
                "cta_nbre"  : cta_nbre,
                "cta_tipo"  : cta_tipo,
                "cta_numero": cta_numero,
                "cta_banco" : cta_banco,
                "llamador"  : llamador
            };

            $.ajax({
              url:   "../backend/controlador.php",
              type: 'POST',
              data: parametros,
              error : function() {
                mostrar_msg("Ocurrio un error al Actualizar sus datos");
              },
              success: function(a){
                  cargar_tarjeta();
                  mostrar_msg("¡FELICITACIONES!<br>Sus datos han sido actualizados<br><br> Gracias por confiar en qartos");
                  //enviar_correo($("#card_nombre").html(), "", $("#dir_correoA").val().trim(), "", "", "1");

                  return false;
              }
            });
        }else{
            mostrar_msg("¡Lo sentimos! <br>No hay ningún dato para actualizar");
        }
    }
    
    
    /***** Función para enviar un correo de la modificación *****
    function enviar_correo(nbres, municipio, correo, clave, id, destino){
	var nbres     = nbres;
	var municipio = municipio;
	var correo    = correo;
	var clave     = clave;
	var id        = id;
	var destino   = destino;

        var parametros = {
            "nbres"    : nbres,
            "municipio": municipio,
            "correo"   : correo,
            "clave"    : clave,
            "id"       : id,
            "destino"  : destino
        };
	
         $.ajax({
          url:   "../correo/enviar_correo.php",
          type: 'POST',
          data: parametros,
          error : function() {
            mostrar_msg("¡ERROR!<br>Ocurrio un error al enviar el correo de Actualización de Datos");
          },
          success: function(){
            mostrar_msg("¡IMPORTANTE!<br>Se ha enviado un mensaje de Modificación de Datos a su cuenta de correo");
          }
      });
    }*/
    
    
    function mostrar_msg(mensaje){
        $("#cuerpo_editar").html(mensaje);
        $("#btn_editar_info").click();
    }
   
});

$(document).ready(function(){ 
    
    $("#div_cabecera").load("../frontend/cabecera.html");
    consultar_propiedades();
    
    function consultar_propiedades(){
        var parametros = {
            "id_propietario": $("#id_propietario").val(),
            "llamador"      : "consultar_propiedades"
        };
        
        $.ajax({
          url:   "../backend/controlador.php",
          type: 'POST',
          data: parametros,
          dataType : 'json',
          error : function() {
              mostrar_msg("¡ERROR!<br>Ocurrio un error al consultar las Propiedades");
              
          },
          success: function(result){
              datos = result;
                if(result.toString()==="" || result.toString()===" "){

                  $("#div_cuadro_propiedades").html("No se encontraron resultados");
                    
                }else{
                    
                    var html = "<div class='container mt-3' id='listado'>"; //creo el contanedor tarjeta
                    
                    $.each(result, function (i){
                        var ruta=result[i].Carpeta+"/"+$("#tipo_propiedadn").val()+"/"+result[i].Id+"/";
                        var btnGrabar  = "<a href='#div_cuadro_propiedades' class='btn btn-primary form-control' " + 
                                    "data-id='" + result[i].Id + 
                                    "' data-ruta='" + ruta + 
                                    "' data-fila='" + i + 
                                    "' data-val='Grabar'>&nbsp;&nbsp;&nbsp;&nbsp; Grabar Cambios&nbsp;&nbsp;&nbsp;&nbsp;</a>";
                            
                         var btnGestionarFotos  = "<a href='#div_cuadro_propiedades' class='btn btn-primary form-control' " + 
                                    "  data-id='" + result[i].Id + 
                                    "' data-val='GestionarFotos'" +
                                    "' data-pais='" + result[i].Id_Pais +
                                    "' data-dpto='" + result[i].Id_Dpto +
                                    "' data-muni='" + result[i].Municipio +
                                    "' data-tipo='" + result[i].Id_Tipo_Propiedad +
                                    "' data-ruta='"+ruta+"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gestionar Fotos &nbsp;&nbsp;</a>";
                         
                               html+="<div class='card shadow mb-3'>" +
                                        "<div class='card-body'>"+
                                            "<div class='row'>"+        //primera fila
                                                "<div class='col-sm-4'>"+           //primera columna
                                                    "<img src='../img/prop/"+result[i].Id+"/"+result[i].Foto+"' class='img-fluid' alt='imagen'>" +
                                                "</div>" +                          //fin primera columna
                                                
                                               
                                                "<div class='col-sm-4'>"+           //segunda columna
                                                    "<h6>Tipo de Propiedad: <b>"+result[i].Tipo_Propiedad+"</b></h6>" +
                                                    "<h6>ID Propiedad : <span class='label label-default'><b>"+result[i].Id+"</b></span></h6>";
                                                    if(result[i].Activo==="1"){
                                                        html+="<span class='label label-success'><b>ESTADO:</b> ACTIVA&nbsp;&nbsp;</span>";
                                                    }else{
                                                        html+="<span class='label label-success'><b>ESTADO:</b> Inactiva</span>";
                                                    }
                                                    html+="<br><span class='label label-success'><b>Municipio</b></span><br>"+result[i].Municipio+" - " + result[i].Dpto +
                                                        " - " + result[i].Pais + "</span></h5>"+
                                                    "<span class='label label-success'><b><br>Dirección:</b></span><br>"+result[i].Direccion+"<br>"+
                                                "</div>" +              //fin segunda columna
                                                    
                                                "<div class='col-sm-4'>"+   //tercera columna
                                                    "<span class='label label-success'><b>Disponible desde:</b></span><br>"+
                                                    "<input type='date' name='fecha_ini"+i+"' id='fecha_ini"+i+"' class='form-control' value='"+result[i].Fecha_Ini_Disp+"'/>"+
                                                    "<span class='label label-success'><b>Hasta:</b></span><br>"+
                                                    "<input type='date' name='fecha_fin"+i+"' id='fecha_fin"+i+"' class='form-control' value='"+result[i].Fecha_Fin_Disp+"'/>"+
                                                    "<span class='label label-success'><b>Valor:</b></span>"+
                                                    "<input type='text' name='costo"+i+"' id='costo"+i+"' class='form-control' value='"+result[i].Valor+"'/><br>"+
                                                "</div>" +              //fin tercera columna
                                            "</div>" +                 //Cierro la fila   
                                                 
                                            "<div class='row mt-3 mb-3 mi-3 pi-3'>"+        //segunda fila
                                                "<div class='col-sm-4'>"+       //primera columna
                                                    "<h3'><b>CARACTERISTICAS</b></h3>" +
                
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                      "<input type='checkbox' id='sala"+i+"' " + pasar_boolean(result[i].Sala) + "/>"+
                                                      "<label for='sala"+i+"'>&nbsp;Sala </label>" +
                                                    "</div>"+ //termina sala
                
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                      "<input type='checkbox' id='cocina"+i+"' " + pasar_boolean(result[i].Cocina) + "/>"+
                                                      "<label for='cocina"+i+"'>&nbsp;Cocina</label>" +
                                                    "</div>"+ //termina cocina
                
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                      "<input type='checkbox' id='hab_ppal_banio"+i+"' " + pasar_boolean(result[i].Hab_Ppal_Banio) + "/>"+
                                                      "<label for='hab_ppal_banio"+i+"'>&nbsp;Habitación Principal Con Baño</label>" +
                                                    "</div>"+ //termina Hab_Ppal_Banio
                
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                      "<input type='checkbox' id='hab_ppal_aire"+i+"' " + pasar_boolean(result[i].Hab_Ppal_Aire) + "/>"+
                                                      "<label for='hab_ppal_aire"+i+"'>&nbsp;Habitación Principal Con Aire</label>" +
                                                    "</div>"+ //termina Hab_Ppal_Aire
                
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                      "<input type='checkbox' id='patio"+i+"' " + pasar_boolean(result[i].Patio) + "/>"+
                                                      "<label for='patio"+i+"'>&nbsp;Tiene Patio</label>" +
                                                    "</div>"+ //termina Patio
                                                "</div>" +              //Cierro primera columna
                                                
                                                
                                                "<div class='col-sm-4'>"+      //segunda columna
                                                  "<h3'><b>CARACTERISTICAS</b></h3>" +
                                                  "<div class='checkbox icheck-wisteria'>" +
                                                    "<input type='checkbox' id='garage"+i+"' " + pasar_boolean(result[i].Garage) + "/>"+
                                                    "<label for='garage"+i+"'>&nbsp;Tiene Garage</label>" +
                                                  "</div>"+ //termina Garage
                                          
                                                  "<div class='checkbox icheck-wisteria'>" +
                                                    "<input type='checkbox' id='bar"+i+"' " + pasar_boolean(result[i].Bar) + "/>"+
                                                    "<label for='bar"+i+"'>&nbsp;Bar</label>" +
                                                  "</div>"+ //termina Bar
                                          
                                                  "<div class='checkbox icheck-wisteria'>" +
                                                    "<input type='checkbox' id='balcon"+i+"' " + pasar_boolean(result[i].Balcon) + "/>"+
                                                    "<label for='balcon"+i+"'>&nbsp;Balcon</label><br>" +
                                                    


                                                    "<div class='form-check form-check-inline'>"+
                                                        "<input class='form-check-input' ";
                                                        if(result[i].Conjunto_Cerrado==="1"){
                                                            html+=" checked type='radio' name='conjunto"+i+"' id='conjunto_cerrado"+i+"' value='1'>";
                                                        }else{
                                                            html+=" type='radio' name='conjunto"+i+"' id='conjunto_cerrado"+i+"' value='0'>";
                                                        }
                                                        html+="<label class='form-check-label' for='cerrado"+i+"'>Conjunto Cerrado</label>"+
                                                        "</div>"+
                                                        "<div class='form-check form-check-inline'>"+
                                                        "<input class='form-check-input' ";
                                                        if(result[i].Conjunto_Abierto==="1"){
                                                            html+=" checked type='radio' name='conjunto"+i+"' id='conjunto_abierto"+i+"' value='1'>";
                                                        }else{
                                                            html+=" type='radio' name='conjunto"+i+"' id='conjunto_abierto"+i+"' value='0'>";
                                                        }
                                                        html+="<label class='form-check-label' for='abierto"+i+"'>Conjunto Abierto</label>"+
                                                        "</div>"+
                                                  "</div>"+
                                                "</div>" +              //Cierro segunda columna
                                                
                                                
                                                
                                                
                                               "<div class='col-sm-4'>"+    //tercera columna
                                                    "<h3'><b>CARACTERISTICAS</b></h3>" +
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='piscina"+i+"' " + pasar_boolean(result[i].Piscina) + "/>"+
                                                        "<label for='piscina"+i+"'>&nbsp;Piscina</label>" +
                                                    "</div>"+ //termina Piscina
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='turco"+i+"' " + pasar_boolean(result[i].Turco) + "/>"+
                                                        "<label for='turco"+i+"'>&nbsp;Baño Turco</label>" +
                                                    "</div>"+ //termina Turco
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='sauna"+i+"' " + pasar_boolean(result[i].Sauna) + "/>"+
                                                        "<label for='sauna"+i+"'>&nbsp;Sauna</label>" +
                                                    "</div>"+ //termina Sauna
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='amoblada"+i+"' " + pasar_boolean(result[i].Amoblada) + "/>"+
                                                        "<label for='amoblada"+i+"'>&nbsp;Amoblada</label>" +
                                                    "</div>"+ //termina Amoblada
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='kiosko"+i+"' " + pasar_boolean(result[i].Kiosko) + "/>"+
                                                        "<label for='kiosko"+i+"'>&nbsp;Kiosko</label>" +
                                                    "</div>"+ //termina Kiosko
                                                "</div>" +  //final de la tercera columna
                                                
                                            "</div>" +                 //Cierro segunda fila
                                            
                                            
                                            "<div class='row mt-3 mb-3'>"+        //tercera fila
                                                "<div class='col-sm-4'>"+       //1ra columna
                                                    "<h3'><b>CARACTERISTICAS</b></h3>" +
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='calefaccion"+i+"' " + pasar_boolean(result[i].Calefaccion) + "/>"+
                                                        "<label for='calefaccion"+i+"'>&nbsp;Tiene Calefaccion</label>" +
                                                    "</div>"+ //termina Calefaccion
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='sotano"+i+"' " + pasar_boolean(result[i].Sotano) + "/>"+
                                                        "<label for='sotano"+i+"'>&nbsp;Tiene Sotano</label>" +
                                                    "</div>"+ //termina Sotano
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='atico"+i+"' " + pasar_boolean(result[i].Atico) + "/>"+
                                                        "<label for='atico"+i+"'>&nbsp;Tiene Atico</label>" +
                                                    "</div>"+ //termina Atico
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='caja_fuerte"+i+"' " + pasar_boolean(result[i].Caja_Fuerte) + "/>"+
                                                        "<label for='caja_fuerte"+i+"'>&nbsp;Tiene Caja Fuerte</label><br>" +
                                                    "</div>"+ //termina Caja_Fuerte
                                                "</div>"+ //termina la primera columna
                                           
                                                "<div class='col-sm-4'>"+       //2da columna
                                                    "<span class='label label-success'><b>SERVICIOS</b></span>" +
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='wifi"+i+"' " + pasar_boolean(result[i].Wifi) + "/>"+
                                                        "<label for='wifi"+i+"'>&nbsp;Wifi</label>" +
                                                    "</div>"+ //termina Wifi
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='taxi"+i+"' " + pasar_boolean(result[i].Taxi) + "/>"+
                                                        "<label for='taxi"+i+"'>&nbsp;Taxi</label>" +
                                                    "</div>"+ //termina Taxi
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='auto_particular"+i+"' " + pasar_boolean(result[i].Auto_Particular) + "/>"+
                                                        "<label for='auto_particular"+i+"'>&nbsp;Auto Particular</label>" +
                                                    "</div>"+ //termina Auto_Particular
            
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='moto_taxi"+i+"' " + pasar_boolean(result[i].Moto_Taxi) + "/>"+
                                                        "<label for='moto_taxi"+i+"'>&nbsp;Moto Taxi</label>" +
                                                    "</div>"+ //termina Moto_Taxi
                                                "</div>"+ //termina 2da columna
                                                
                                               
                                                "<div class='col-sm-4 jumbotron' >" +       //3ra columna
                                                    "<div class='checkbox icheck-wisteria'>" +
                                                        "<input type='checkbox' id='requiere_autorizacion"+i+"' " + pasar_boolean(result[i].Requiere_Autorizacion) + "/>"+
                                                        "<label for='requiere_autorizacion"+i+"'>&nbsp;Requiere Autorización para reservar</label>" +
                                                    "</div>"+

                                                    "<h5 class='mt-3 mb-3'>Estado de la Propiedad</h5>" +   

                                                    "<div class='form-check form-check-inline'> ";
                                                    
                                                    if(result[i].Activo==="1"){
                                                        html+="<input class='form-check-input' checked type='radio' name='estado"+i+"' id='activo"+i+"' value='1'>" +
                                                                "<label class='form-check-label' for='activo"+i+"'>Activo</label>"+
                                                            "</div>"+
                                                            "<div class='form-check form-check-inline'>"+
                                                                "<input class='form-check-input' type='radio' name='estado"+i+"' id='inactivo"+i+"' value='0'>" +
                                                                "<label class='form-check-label' for='inactivo"+i+"'>Inactivo</label>"+
                                                            "</div>";

                                                    }else{
                                                        html+="<input class='form-check-input' type='radio' name='estado"+i+"' id='activo"+i+"' value='0'>" +
                                                                "<label class='form-check-label' for='activo"+i+"'>Activo</label>"+
                                                            "</div>"+
                                                            "<div class='form-check form-check-inline'>"+
                                                                "<input class='form-check-input' checked type='radio' name='estado"+i+"' id='inactivo"+i+"' value='1'>" +
                                                                "<label class='form-check-label' for='inactivo"+i+"'>Inactivo</label>"+
                                                            "</div>";
                                                    }
                                                html+="</div>"+           //termina 3ra columna
                                            "</div>"+ //termina la tercera fila
                                            
                                            
                                            "<div class='row mt-3 mb-3'>"+   //Abro la 4ta  fila para las observaciones
                                                "<div class='col-12 jumbotron >" +
                                                   "<span  class='text-muted'><b>Observaciones:&nbsp</b></span><br>" +
                                                    "<textarea class='form-control' rows='5' id='observacion"+i+"'>"+ result[i].Observacion +"</textarea><BR>" +
                                                "</div>" + 
                                            "</div>" +      //final 4ta fila
                                            
                                                 
                                            "<div class='row mt-3 mb-3'>"+        //5ta fila
                                                "<div class='col-sm-4'>" + btnGestionarFotos+"</div><br><br>" +
                                                "<div class='col-sm-4'>" + btnGrabar+"</div><br><br>" +
                                                "<div class='col-sm-4'></div>" +
                                            "</div><br>" +       //fin de la 5ta fila
                                            
                                        "</div>" +                  //Cierro card-body
                                    "</div>";                       //Cierro la tarjeta
                                    
                    });
                    html+="</div>";                     //cierro en div contenedor
                    $("#div_cuadro_propiedades").html(html);
                }
            }
        });   
    }
                    
    
    /*Funcion que activa o desactiva los ckeckbox*/
    function pasar_boolean(valor){
        var resp ="";
        if(valor==="1"){
            resp="checked";
        }
        return resp;
    }
    /*Funcion que pasa el valor de un ckeckbox a binario*/
    function pasar_binario(campo){
        var resp ="0";
        if($("#"+campo).is(':checked')) {  
            resp=1;
        }
        return resp;
    }
    
    
  $("#div_cuadro_propiedades").on('click','a.btn', function() {
      id_propiedad = $(this).data('id');
      
     if($(this).data('val')==="Grabar"){
        mostrar_msg_pregunta("Enviara propiedad No ");
        modificar_propiedad($(this).data('fila'));
          
      }else if($(this).data('val')==="GestionarFotos"){
          window.open('../frontend/cargar_fotos.php?' +
          'id_propiedad='  + id_propiedad +
          '&nbre_propietario='  + $("#nbre_propietario").val() +
          '&municipio='    + $(this).data("muni"));
      }
      
  });
  
  
  function modificar_propiedad(i){
      var llamador  ="modificar_propiedad";
      
      var parametros = {
        "id_propiedad"   : id_propiedad,
        "fechaIni"      : $("#fecha_ini"+i).val(),
        "fechaFin"      : $("#fecha_fin"+i).val(),
        "valor"         : $("#costo"+i).val(),
        "autorizacion"  : pasar_binario("requiere_autorizacion"+i),
        "observacion"   : $("#observacion"+i).val(),
        "sala"          : pasar_binario("sala"+i),
        "comedor"       : pasar_binario("comedor"+i),
        "cocina"        : pasar_binario("cocina"+i),
        "hab_ppal_aire" : pasar_binario("hab_ppal_aire"+i),
        "hab_ppal_banio": pasar_binario("hab_ppal_banio"+i),
        "amoblada"      : pasar_binario("amoblada"+i),
  	    "kiosko"        : pasar_binario("kiosko"+i),
        "bar"           : pasar_binario("bar"+i),
        "patio"         : pasar_binario("patio"+i),
        "garage"        : pasar_binario("garage"+i),
        "conjunto_cerrado" : pasar_binario("conjunto_cerrado"+i),
        "conjunto_abierto" : pasar_binario("conjunto_abierto"+i),
        "calefaccion"   : pasar_binario("calefaccion"+i),
        "sotano"        : pasar_binario("sotano"+i),
        "atico"         : pasar_binario("atico"+i),
        "caja_fuerte"   : pasar_binario("caja_fuerte"+i),
        "piscina"       : pasar_binario("piscina"+i),
        "turco"         : pasar_binario("turco"+i),
        "sauna"         : pasar_binario("sauna"+i),
        "balcon"        : pasar_binario("balcon"+i),
        "wifi"          : pasar_binario("wifi"+i),
        "taxi"          : pasar_binario("taxi"+i),
        "moto_taxi"     : pasar_binario("moto_taxi"+i),
        "auto_particular" : pasar_binario("auto_particular"+i),
        "estado"        : pasar_binario("activo"+i),
        "llamador"  : llamador
    };
    $.ajax({
      url:   "../backend/controlador.php",
      type: 'POST',
      data: parametros,
      error : function() {
        mostrar_msg("¡ERROR!<br>Ocurrio un error al Modificar la Propiedad");
      },
      success: function(resp){
        mostrar_msg("¡ACTUALIZACIÓN DE DATOS! " + resp);
      }
    });
  }
  
  
  function mostrar_msg(cuerpo){
        $('#btn_activar').prop("hidden",true);
        $('#btn_desactivar').prop("hidden",true);
        $('#cuerpo_listar').html(cuerpo);
        $("#btn_ventana_listar").click();
    }

    function mostrar_msg_pregunta(cuerpo){
        $('#btn_activar').prop("hidden",false);
        $('#btn_desactivar').prop("hidden",false);
        $('#cuerpo_listar').html(cuerpo);
        $("#btn_ventana_listar").click();
    }
});

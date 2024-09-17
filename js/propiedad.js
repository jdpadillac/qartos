
$(document).ready(function(){ 
    var list_buscar;                //maneja el array de municipios seleccionados
    var requiere_fecha;             //Requiere periodo de fecha de disponibilidad de la propiedad
    var arrendar=0;
    var vender=0;
    var alojar=0;
    var subastar=0;
    
    /* Formateo el campo valor */
    var cleave = new Cleave('.form_num', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    /*Deshabilito el bton para subir fotos*/
    $("#btn_fotos").attr("disabled",true);
    
    /*Valido el click en cada boton*/
    $("#btn_nueva_propiedad").click(function(){
        $("#btn_grabar").attr("disabled",false);
        $("#btn_fotos").attr("disabled",true);
        nueva_propiedad();            
    });
        
    $("#rdo_arrendar").click(function(){
        arrendar=1;
        vender=0;
        alojar=0;
        subastar=0;
    });
    $("#rdo_vender").click(function(){
        arrendar=0;
        vender=1;
        alojar=0;
        subastar=0;
    });
    $("#rdo_alojar").click(function(){
        arrendar=0;
        vender=0;
        alojar=1;
        subastar=0;
    });
    $("#rdo_subastar").click(function(){
        arrendar=0;
        vender=0;
        alojar=0;
        subastar=1;
    });
        
    $("#chk_conjunto_abierto").click(function(){
        if($("#chk_conjunto_abierto").prop("checked")===true){
            $("#chk_conjunto_cerrado").prop("checked",false);
        }else{
            $("#chk_conjunto_cerrado").prop("checked",true);
        }
    });
    $("#chk_conjunto_cerrado").click(function(){
        if($("#chk_conjunto_cerrado").prop("checked")===true){
            $("#chk_conjunto_abierto").prop("checked",false);
        }else{
            $("#chk_conjunto_abierto").prop("checked",true);
        }
    });
        
    /*Click al presionar sobre el botón de subir foto*/
    $("#btn_fotos").click(function(){
        if($("#id_propiedad").val()===""){
            mostrar_ventana_modal("Por favor grave primero una Propiedad para que pueda agregar fotos");
        }else{
            
            window.open("../frontend/cargar_fotos.php?"+
                "id_propiedad=" + $("#id_propiedad").val() + 
                "&nbre_propietario=" + $('#nbre_propietario').val() + 
                "&municipio=" + $('#nbre_municipioN').val());
            return false;
        }
            
    });
        
    //Cargo el combo de tipo de propiedad
    cargar_combo("tipo_propiedad"); 


    function cargar_combo(tabla){
        var parametros = {
            "tabla"     : tabla,
            "llamador"  : "cargar_combo"
        };

         $.ajax({
          url:   "../backend/controlador.php",
          type: 'POST',
          dataType : 'json',
          data: parametros,
          error : function() {

              mostrar_ventana_modal("¡ERROR¡<br>Ocurrio un error al cargar el combo de tipo de Propiedad");
          },
          success: function(data){
              $.each(data,function(key, registro) {
                  $("#tipo_propiedad").append('<option value='+registro.Id+'>'+registro.Nbre+'</option>');
              });
            }
      });   
    }
    
    $("#chk_fecha_cierre").click(function () {	 
            requiere_fecha = $('input:checkbox[id=chk_fecha_cierre]:checked').val();
            if(requiere_fecha==="on"){
                $("#fechaIni").prop("disabled",false);
                $("#fechaFin").prop("disabled",false);
            }else{
                $("#fechaIni").prop("disabled",true);
                $("#fechaFin").prop("disabled",true);
            }
    });
    
    /*Busca los municipios por cada tecla que se digite*/
     $('#nbre_municipioN').typeahead({
         
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
                success: function (data) {
                    list_buscar=data;
                    result($.map(data, function (resultado) {
                        return $.trim(resultado.Municipio); //Esto es lo que se muestra en la lista
                    }));
                }
            });
        }
    });
    
    $("#nbre_municipioN").blur(function(){   //pedió el foco
         $.each(list_buscar, function (i){
             if($.trim(list_buscar[i].Municipio)===$.trim($("#nbre_municipioN").val())){
                $("#id_municipio").val(list_buscar[i]["Id"]);
                $("#id_dpto").val(list_buscar[i]["Id_Dpto"]);
                $("#id_pais").val(list_buscar[i]["Id_Pais"]);
             }
         });
    });
    
    
    $("#btn_grabar_propiedad").click(function(evento){   //Graba los datos de la nueva propiedad
        evento.preventDefault();
        validar_datos();
            
    });
    

    function validar_datos(){
        if(arrendar==0 && vender ==0 && alojar ==0 && subastar==0){
            mostrar_ventana_modal("Por favor seleccione que quiere hacer con la Propiedad");
            $("#arrendar").focus();
        }else if($("#id_municipio").val()===""){
            mostrar_ventana_modal("Por favor seleccione un Municipio");
            $("#nbre_municipioN").focus();
        }else if($("#tipo_propiedad").val()==="0"){
            mostrar_ventana_modal("Por favor seleccione el tipo de Propiedad");
            $("#tipo_propiedad").focus();
        }else if(requiere_fecha==="on" && $("#fechaIni").val()===""){
            mostrar_ventana_modal("Por favor digite la fecha de inicio de de la Propiedad");
            $("#fechaIni").focus();
        }else if($("#direccion").val()===""){
            mostrar_ventana_modal("Por favor digite la dirección de la Propiedad");
            $("#direccion").focus();
        }else if($("#telefono").val()===""){
            mostrar_ventana_modal("Por favor digite un número telefónico de contacto");
            $("#telefono").focus();
        }else if($("#no_pisos").val()==="" || $("#no_pisos").val()==="0"){
            mostrar_ventana_modal("Por favor digite el número de Pisos");
            $("#no_pisos").focus();
        }else if($("#no_piso").val()==="" || $("#no_piso").val()==="0"){
            mostrar_ventana_modal("Por favor digite en que Piso se encuentra");
            $("#no_piso").focus();
        }else if($("#no_habitaciones").val()==="" || $("#no_habitaciones").val()==="0"){
            mostrar_ventana_modal("Por favor digite el número de Habitaciones");
            $("#no_habitaciones").focus();
        }else if($("#no_banios").val()==="" || $("#no_banios").val()==="0"){
            mostrar_ventana_modal("Por favor digite el número de Baños que tiene");
            $("#no_banios").focus();
        }else if($("#valor").val()==="" || $("#valor").val()==="0"){
            mostrar_ventana_modal("Por favor digite el Valor ");
            $("#valor").focus();
        }else{
            grabar_propiedad();
        }
    }
    
    function grabar_propiedad(){
        var id_propietario  =$("#id_propietario").val();
        var tipo_propiedad  =$("#tipo_propiedad").val();
        var municipio       =$("#id_municipio").val();
        var direccion       =$("#direccion").val();
        var geo1            =lat;
        var geo2            =long;
        var telefono        =$("#telefono").val();
        var fechaIni        =$("#fechaIni").val();
        var fechaFin        =$("#fechaFin").val();
        var valor           =$("#valor").val();
        var autorizacion    =0;
        var observacion     =$("#txt_observacion").val();
        
        var no_banios       =$("#no_banios").val();
        var no_habitaciones =$("#no_habitaciones").val();
        var no_pisos        =$("#no_pisos").val();
        var no_piso         =$("#no_piso").val();
        var sala            =0;
        var cocina          =0;
        var hab_ppal_aire   =0;
        var hab_ppal_banio  =0;
        var amoblada        =0;
        var kiosko          =0;
        var bar             =0;
        var aire            =0;
        var patio           =0;
        var garage          =0;
        var conjunto_cerrado =0;
        var conjunto_abierto =0;
        var calefaccion      =0;
        var sotano          =0;
        var atico           =0;
        var caja_fuerte     =0;
        var piscina         =0;
        var turco           =0;
        var sauna           =0;
        var balcon          =0;
        var cuarto_labores =0;
        var wifi            =0;
        var taxi            =0;
        var auto_particular  =0;
        var moto_taxi       =0;

        if($('#chk_autorizacion').prop('checked')){
            autorizacion=1;
        }
        if($('#chk_sala').prop('checked')){
            sala=1;
        }
        if($('#chk_cocina').prop('checked')){
                cocina=1;
            }
        if($('#chk_hab_ppal_aire').prop('checked')){
                hab_ppal_aire=1;
            }
        if($('#chk_hab_ppal_banio').prop('checked')){
                hab_ppal_banio=1;
            }
        if($('#chk_amoblada').prop('checked')){
                amoblada=1;
            }
        if($('#chk_kiosko').prop('checked')){
                kiosko=1;
            }
            
        if($('#chk_bar').prop('checked')){
                bar=1;
            }
        if($('#chk_aire').prop('checked')){
                aire=1;
            }
        if($('#chk_patio').prop('checked')){
                patio=1;
            }
        if($('#chk_garage').prop('checked')){
                garage=1;
            }
            
        if($('#chk_conjunto_cerrado').prop('checked')){
                conjunto_cerrado=1;
            }
        if($('#chk_conjunto_abierto').prop('checked')){
                conjunto_abierto=1;
            }
        if($('#chk_calefaccion').prop('checked')){
                calefaccion=1;
            }
        if($('#chk_sotano').prop('checked')){
                sotano=1;
            }
        if($('#chk_atico').prop('checked')){
                atico=1;
            }
        if($('#chk_caja_fuerte').prop('checked')){
                caja_fuerte=1;
            }
        if($('#chk_piscina').prop('checked')){
                piscina=1;
            }
        if($('#chk_turco').prop('checked')){
                turco=1;
            }
        if($('#chk_sauna').prop('checked')){
                sauna=1;
            }
        if($('#chk_balcon').prop('checked')){
                balcon=1;
            }
        if($('#chk_cuarto_labores').prop('checked')){
                cuarto_labores=1;
            }
        if($('#chk_wifi').prop('checked')){
                wifi=1;
            }
        if($('#chk_taxi').prop('checked')){
                taxi=1;
            }
        if($('#chk_auto_particular').prop('checked')){
                auto_particular=1;
            }
        if($('#chk_moto_taxi').prop('checked')){
                moto_taxi=1;
            }
        var llamador  ="grabar_propiedad";

      var parametros = {
        "id_propietario" : id_propietario,
        "tipo_propiedad" : tipo_propiedad,
        "municipio"     : municipio,
        "direccion"     : direccion,
        "geo1"          : geo1,
        "geo2"          : geo2,
        "arrendar"      : arrendar,
        "vender"        : vender,
        "alojar"        : alojar,
        "subastar"      : subastar,
        "telefono"      : telefono,
        "fechaIni"      : fechaIni,
        "fechaFin"      : fechaFin,
        "valor"         : valor,
        "autorizacion"  : autorizacion,
        "no_banios"     : no_banios,
        "no_habitaciones" : no_habitaciones,
        "no_pisos"      : no_pisos,
        "no_piso"       : no_piso,
        "observacion"   : observacion,
        "sala"          : sala,
        "cocina"        : cocina,
        "hab_ppal_aire" : hab_ppal_aire,
        "hab_ppal_banio" : hab_ppal_banio,
        "amoblada"      : amoblada,
        "kiosko"        : kiosko,
        "bar"           : bar,
        "aire"          : aire,
        "patio"         : patio,
        "garage"        : garage,
        "conjunto_cerrado" : conjunto_cerrado,
        "conjunto_abierto" : conjunto_abierto,
        "calefaccion"   : calefaccion,
        "sotano"        : sotano,
        "atico"         : atico,
        "caja_fuerte"   : caja_fuerte,
        "piscina"       : piscina,
        "turco"         : turco,
        "sauna"         : sauna,
        "balcon"        : balcon,
        "cuarto_labores" : cuarto_labores,
        "wifi"          : wifi,
        "taxi"          : taxi,
        "moto_taxi"     : moto_taxi,
        "auto_particular" : auto_particular,
        "llamador"      : llamador
    };

    $.ajax({
      url:   "../backend/controlador.php",
      type: 'POST',
      data: parametros,
      error : function() {
          mostrar_ventana_modal("¡ERROR!<br>Ocurrio un error al grabar la Propiedad");
      },
      success: function(id){
          $("#btn_mod_cerrar").click();
          $("#id_propiedad").val(id);
          mostrar_ventana_modal("<i><strong>¡FELICITACIONES!</strong></i><br>Acaba de registrar su Propiedad satisfactoriamente.<br>\n\
          Por favor no olvide subir las fotos para que los clientes puedan mirar las condiciones de\n\
          confort.<br>\n\
          Ahora se activará el botón para subir las fotos.<br><br>\n\
          Gracias por confiar en <strong>qartos!</strong>");
          $("#btn_fotos").attr("disabled",false);      //Activo el botón para subir las fotos
          $("#btn_grabar_propiedad").attr("disabled",true);   //Desactivo el botón para grabar
      }
    });
  }
  

  function nueva_propiedad(){
  	$("#id_municipio").val("0");
  	$("#nbre_municipioN").val("");
  	$("#tipo_propiedad").val("0");
    $("#fechaIni").val( new Date());
  	$("#fechaFin").val( new Date());
  	$("#direccion").val("");
  	$("#telefono").val("");
  	$("#latitud").val("");
  	$("#altitud").val("");
  	$("#no_pisos").val("");
  	$("#no_piso").val("");
  	$("#no_habitaciones").val("");
  	$("#no_banios").val("");
  	$("#valor").val("");
    $('#chk_sala').prop('checked',false);
    $('#chk_autorizacion').prop('checked',false);
    $('#chk_cocina').prop('checked',false);
    $('#chk_hab_ppal_aire').prop('checked',false);
    $('#chk_hab_ppal_banio').prop('checked',false);
    $('#chk_patio').prop('checked',false);
    $('#chk_garage').prop('checked',false);
    $('#chk_conjunto_cerrado').prop('checked',false);
    $('#chk_conjunto_abierto').prop('checked',false);
    $('#chk_piscina').prop('checked',false);
    $('#chk_turco').prop('checked',false);
    $('#chk_sauna').prop('checked',false);
    $('#chk_balcon').prop('checked',false);
    $('#chk_amoblada').prop('checked',false);
    $('#chk_kiosko').prop('checked',false);
    $('#chk_bar').prop('checked',false);
    $('#chk_aire').prop('checked',false);
    $('#chk_calefaccion').prop('checked',false);
    $('#chk_sotano').prop('checked',false);
    $('#chk_atico').prop('checked',false);
    $('#chk_caja_fuerte').prop('checked',false);
    $('#chk_cuarto_labores').prop('checked',false);
    $('#chk_wifi').prop('checked',false);
    $('#chk_taxi').prop('checked',false);
    $('#chk_auto_particular').prop('checked',false);
    $('#chk_moto').prop('checked',false);
    $('#txt_observacion').val("");
    $("#nbre_municipioN").focus();
    $("#btn_grabar_propiedad").prop("disabled",false);
  }

  
  function actualizar_codigo_payu(propiedadN, valoR){
  	var valor   =valoR;
  	var tipo    =2;
  	var propiedad=propiedadN;
  	var llamador  ="actualizar_codigo_payu";
                
    var parametros = {
        "valor"    : valor,
        "propiedad" : propiedad,
        "llamador" : llamador
    };

    $.ajax({
      url:   "../backend/controlador.php",
      type: 'POST',
      data: parametros,
      error : function(status, error) {
          mostrar_ventana_modal("¡ERROR!<br>Ocurrio un error al actualizar el código de PayuLatam");
      },
      success: function(){
          mostrar_ventana_modal("¡FELICIDADES!<br>Propiedad Grabada!</b>");
      }
    });   
  }
  
  
   function mostrar_ventana_modal(cuerpO){
        $('#cuerpo_propiedad').html(cuerpO);
        $("#btn_ventana_propiedad").click();
    }
    
    
    
    /**** Geolocalización*****/
    var lat=0;
    var long=0;
        
    if ("geolocation" in navigator){ 
         navigator.geolocation.getCurrentPosition(function(position){ 
            lat = parseFloat(position.coords.latitude);
            long = parseFloat(position.coords.longitude);
            var mymap = L.map('mapid').setView([lat, long], 13);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    maxZoom: 18,
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
            }).addTo(mymap);

            L.marker([lat, long]).addTo(mymap)
                    .bindPopup("<b>qartos!</b><br />Aqui esta usted " + lat + " long " + long).openPopup();

            var popup = L.popup();

            function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        .setContent("Esta es su localización de la propiedad: " + e.latlng.toString())
                        .openOn(mymap);
               var tmp =e.latlng.toString().split("(");    //quito el parentesis
               tmp = tmp[1].split(")");                    //quito el otro parentesis
               tmp = tmp[0].split(",");                    //quito la coma
               lat = parseFloat(tmp[0]);                    //saco la latitud
               long = parseFloat(tmp[1]);                   //saco la longuitud
            }

            mymap.on('click', onMapClick);
            
            
        });
    }else{
        mostrar_ventana_modal("No pudimos localizar su posicionamiento");
    }


  
});

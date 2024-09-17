$(document).ready(function(){ 
    
    $("#div_cabecera").load("../frontend/cabecera.html");
    
    /*var mymap = L.map('mapid').setView([coord1, coord2], 15);
    var popup = L.popup();*/
    var mymap;
    var popup = L.popup();
    var marker;
    
    
    function mostrar_mapa(){
        
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'José David Padilla',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);
        
        
    
    }
    
    function onMapClick(e) {
        popup
        .setLatLng(e.latlng)
        .setContent("Coordenadas: " + e.latlng.toString())
        .openOn(mymap);
    }

    mostrar_propiedad();
     
    function mostrar_propiedad(){
        var parametros = {
            "id"       : $("#id_propiedad").val(),
            "llamador" : "mostrar_propiedad"
        };
        $.ajax({
            url:   "../backend/controlador.php",
            type: 'POST',
            dataType: 'json',
            data: parametros,
            error: function(e) {    
                mostrar_msg("Ocurrio un error al consultar la Propiedad.<br> \n\
                    Lo sentimos, revisaremos que esta sucediendo. " + e);
            },
            success: function(result){
                datos = result;              
                /*&nbsp;*/
                $("#titulo").html("&nbsp;"+datos[0].Tipo_Propiedad.toString().toUpperCase()+" EN "+datos[0].Nbre_Municipio.toUpperCase());
                $("#valor").html("Valor por noche: $ " + datos[0].Valor);
                if(datos[0].Sala==="1"){
                    $("#sala").html(" Sala");
                    $("#sala").prop("hidden",false);
                }
                if(datos[0].Comedor==="1"){
                    $("#comedor").html(" Comedor");
                    $("#comedor").prop("hidden",false);
                }
                if(datos[0].Cocina==="1"){
                    $("#cocina").html(" Cocina");
                    $("#cocina").prop("hidden",false);
                }
                if(datos[0].Hab_Ppal_Banio==="1"){
                    $("#hab_ppal_banio").html(" La habitación principal tiene baño interno");
                    $("#hab_ppal_banio").prop("hidden",false);
                }
                if(datos[0].Hab_Ppal_Aire==="1"){
                    $("#hab_ppal_aire").html(" La habitación principal tiene aire acondicionado");
                    $("#hab_ppal_aire").prop("hidden",false);
                }
                if(datos[0].Patio==="1"){
                    $("#patio").html(" Tiene Patio");
                    $("#patio").prop("hidden",false);
                }
                if(datos[0].garage==="1"){
                    $("#garage").html(" Tiene Garage");
                    $("#garage").prop("hidden",false);
                }
                if(datos[0].Conjunto_Cerrado==="1"){
                    $("#conjunto_cerrado").html(" Se encuentra en un conjunto cerrado");
                    $("#conjunto_cerrado").prop("hidden",false);
                }
                if(datos[0].Conjunto_Abierto==="1"){
                    $("#conjunto_abierto").html(" Se encuentra en un conjunto abierto");
                    $("#conjunto_abierto").prop("hidden",false);
                }
                if(datos[0].Piscina==="1"){
                    $("#piscina").html(" Tiene Piscina");
                    $("#piscina").prop("hidden",false);
                }
                if(datos[0].Turco==="1"){
                    $("#turco").html(" Tiene baño turco");
                    $("#turco").prop("hidden",false);
                }
                if(datos[0].Sauna==="1"){
                    $("#sauna").html(" Tiene Sauna");
                    $("#sauna").prop("hidden",false);
                }
                if(datos[0].Balcon==="1"){
                    $("#balcon").html(" Tiene Balcon");
                    $("#balcon").prop("hidden",false);
                }
                if(datos[0].Amoblada==="1"){
                    $("#amoblada").html(" Se encuentra amoblada");
                    $("#amoblada").prop("hidden",false);
                }
                if(datos[0].Kiosko==="1"){
                    $("#kiosko").html(" Tiene Kiosco");
                    $("#kiosko").prop("hidden",false);
                }
                if(datos[0].Bar==="1"){
                    $("#bar").html(" Tiene bar");
                    $("#bar").prop("hidden",false);
                }
                if(datos[0].Aire==="1"){
                    $("#aire").html(" Toda la casa tiene Aire acondicionado");
                    $("#aire").prop("hidden",false);
                }
                if(datos[0].Calefaccion==="1"){
                    $("#calefaccion").html(" Toda la casa tiene Calefacción");
                    $("#calefaccion").prop("hidden",false);
                }
                if(datos[0].Sotano==="1"){
                    $("#sotano").html(" Tiene Sótano");
                    $("#sotano").prop("hidden",false);
                }
                if(datos[0].Atico==="1"){
                    $("#atico").html(" Tiene Atico");
                    $("#atico").prop("hidden",false);
                }
                if(datos[0].Caja_Fuerte==="1"){
                    $("#caja_fuerte").html(" Tiene Caja Fuerte");
                    $("#caja_fuerte").prop("hidden",false);
                }
                if(datos[0].Cuarto_Labores==="1"){
                    $("#cuarto_labores").html(" Tiene Cuarto de labores");
                    $("#cuarto_labores").prop("hidden",false);
                }
                if(datos[0].Wifi==="1"){
                    $("#wifi").html(" Tiene Wifi");
                    $("#wifi").prop("hidden",false);
                }
                transporte = 0;
                if(datos[0].Taxi==="1"){
                    $("#taxi").html(" Presta servicio de Taxi");
                    $("#taxi").prop("hidden",false);
                    transporte=1;
                }else{
                    $("#taxi").prop("hidden",true);
                }
                if(datos[0].Auto_Particular==="1"){
                    $("#auto").html(" Presta servicio de Auto Particular");
                    $("#auto").prop("hidden",false);
                    transporte=1;
                }else{
                    $("#auto").prop("hidden",true);
                }
                if(datos[0].Moto==="1"){
                    $("#moto").html(" Presta servicio de Moto");
                    $("#moto").prop("hidden",false);
                    transporte=1;
                }else{
                    $("#moto").prop("hidden",true);
                }
                if(transporte===0){
                    $("#div_transp").prop("hidden",true);
                }
                       
                $("#no_banios").html(" Número de Baños: " + datos[0].No_Banios);
                $("#no_habitaciones").html(" Número de Habitaciones: " + datos[0].No_Habitaciones);
                $("#no_pisos").html(" Número de pisos: " + datos[0].No_Pisos);
                $("#no_piso").html(" Se encuentra en el piso número: " + datos[0].No_Piso);
                        
                $("#buenas").html("Calificaciones Buenas: " + datos[0].Calificacion3);
                $("#neutras").html("Calificaciones Neutras: " + datos[0].Calificacion2);
                $("#malas").html("Calificaciones Bajas: " + datos[0].Calificacion1);
                $("#observacion").append(datos[0].Observacion);
                        
                mostrarFotos();
                        
                coord1=parseFloat (datos[0].Geo1);
                coord2=parseFloat (datos[0].Geo2);
                mymap = L.map('mapid').setView([coord1, coord2], 15);
                marker = L.marker([coord1, coord2]).addTo(mymap);
                //marker.bindPopup("<b>Hola!</b><br>Aquí.").openPopup();
                mostrar_mapa();
            }
        })
    }
    
    function mostrarFotos(){
            var carpetaF =$("#id_propiedad").val();
            var parametros = {
                "carpetaF" : "../img/prop/"+carpetaF
            };
            $.ajax({
                 url:   "../backend/cargarFotos.php",
                 type: 'POST',
                 dataType : 'json',
                 data: parametros,
                 error : function(r) {
                    mostrar_msg("No se pudieron cargar las fotos");
                 },
                 success: function(listaFotos){
                     var k=0;   //Indice para el $ 
                     $.each(listaFotos, function (p){
                         if(k===0){ //coloco la primera opcion activa
                            $("#listaOL").append("<li data-target='#listaOL' data-slide-to='"+k+"' class='active'></li>");
                            $('#div_fotos').append('<div class="carousel-item active">'+
                                '<img class="img-fluid galeria_img" src="../img/prop/'+carpetaF+'/'+listaFotos[p]+'" alt="foto" style="width: 100%; max-height:300px;">'+
                            '</div>');
                         }else{
                             $("#listaOL").append("<li data-target='#listaOL' data-slide-to='"+k+"'></li>");
                             $('#div_fotos').append('<div class="carousel-item">'+
                                '<img class="img-fluid galeria_img" src="../img/prop/'+carpetaF+'/'+listaFotos[p]+'" alt="foto" style="width: 100%; max-height:300px;">'+
                            '</div>');
                    

                         }
                         
                         k++;
                     });
                     $("#carrusel").append("<a class='carousel-control-prev' href='#carrusel' data-slide='prev'>"+
                        "<span class='carousel-control-prev-icon'></span>"+
                      "</a>"+
                      "<a class='carousel-control-next' href='#carrusel' data-slide='next'>"+
                        "<span class='carousel-control-next-icon'></span>"+
                      "</a>");

                }
            });
        
    }
    
    $("#div_fotos").on('click','img.img-fluid', function() {
        var nbre=(this).src;
        mostrar_foto(nbre);
    });
 
    
    /********************* Ventanas Modales *************************/
     
   function mostrar_msg(cuerpo){        
        $('#div_foto').hide();
        $('#div_autenticacion').hide();
        $('#div_registrarse').hide();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').hide();
        $('#div_cuerpo').html(cuerpo);
        $('#div_cuerpo').show();
        $("#btn_modal").click();
    }
     
    function mostrar_foto(url){        
        $('#div_autenticacion').hide();
        $('#div_registrarse').hide();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').hide();
        $('#div_cuerpo').hide();
        $('#div_foto').show();
        $('#foto1').prop("src",url);
        $('#foto1').show();
        $("#btn_modal").click();
    }
     
    function mostrar_reserva(cuerpo){        
        $('#div_foto').hide();
        $('#div_autenticacion').hide();
        $('#div_registrarse').hide();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').hide();
        $('#div_cuerpo').html(cuerpo);
        $('#div_cuerpo').show();
        $("#btn_modal").click();
    }
     

     
    /********** RESERVAS **********/
    $(".reservar").click(function(evento){   //Presiono un boton de reserva
        evento.preventDefault();
        reservar();
    });
    function reservar(){
        if($("#id_usuario").val()===undefined || $("#id_usuario").val()==="" || $("#id_usuario").val()==="0"){
            mostrar_ventana_autenticacion();
            $("#btn_modal").click();

        }else{
            mostrar_ventana_reserva();
            $("#btn_modal").click();
        }
        
    }
    $(".terminos").click(function(event){
        event.preventDefault();
        window.open("../politicas.pdf");
    });
    $("#btn_modal_autenticarse").click(function(){
        if($("#email").val()===""){
            $("#div_comentarios").html("Por favor digite su cuenta de correo");
            $("#email").focus();
            
        }else if ($("#clave").val()===""){
            $("#div_comentarios").html("Por favor digite su Clave de acceso");
             $("#clave").focus();
             
        }else{
            validar_acceso();
        }
    });
    function validar_acceso(){
        
        var parametros = {
             "correo"   : $("#email").val(),
             "clave"    : $("#clave").val(),
             "llamador" : "validar_acceso"
         };
         
         $.ajax({
             url: "../backend/controlador.php",
             data: parametros,            
             dataType: "json",
             type: "POST",
             error : function(e) {
                 $("#div_comentarios").html("Ocurrio un error al autenticar su cuenta de accesos ");
             },

             success: function (data) {
                
                if(data.length===0){
                    $("#div_comentarios").html("Por favor revise los datos de acceso");
                }else{
                    $("#div_comentarios").html("Bienvenido " + data[0].Nbres);
                     $("#id_usuario").val(data[0].Id);
                     $("#nbre_usuario").val(data[0].Nbres);
                     //habilito el div de reserva con los datos
                     mostrar_ventana_reserva();
                }
             }
         });
    }
    $("#btn_modal_registrarse").click(function(){ 
        mostrar_ventana_registrese();
    });
    function mostrar_ventana_registrese(){
        $('#div_cuerpo').hide();
        $('#div_foto').hide();
        $('#div_autenticacion').hide();
        $('#div_registrarse').show();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').hide();
        //$("#btn_modal").click();
    }
    $("#btn_registrarse").click(function(event){
        event.preventDefault();
        if($("#txt_nbres_reg").val()===null || $("#txt_nbres_reg").val()===""){
            $("#div_error").html("Por favor digite sus Nombres");
            $("#txt_nbres_reg").focus();
            
        }else if($("#txt_apellidos_reg").val()===null || $("#txt_apellidos_reg").val()===""){
            $("#div_error").html("Por favor digite sus Apellidos");
            $("#txt_apellidos_reg").focus();
            
        }else if($("#txt_id_municipio").val()===null || $("#txt_id_municipio").val()===""){
            $("#div_error").html("Por favor digite el Municipio donde vive");
            $("#txt_nbre_municipio_res").focus();
            
        }else if($("#txt_correo_reg").val()===null || $("#txt_correo_reg").val()===""){
            $("#div_error").html("Por favor digite su cuenta de Correo");
            $("#txt_correo_reg").focus();
            
        }else if ($("#txt_clave_reg").val()===null || $("#txt_clave_reg").val()===""){
            $("#div_error").html("Por favor digite su Clave de acceso");
            $("#txt_clave_reg").focus();
            
        }else{
            verificar_correo();
        }
   });
   function verificar_correo(){
    var parametros = {
        "correo"    : $("#txt_correo_reg").val(),
        "llamador"  : "verificar_correo"
    };

    $.ajax({
        url: "../backend/controlador.php",
        data: parametros,
        type: "POST",
        error : function(e) {
            mostrar_msg("Ocurrio un error al verificar la existencia de la cuenta de correo");
        },
        success: function (data) {
           if(data.length===2){
             grabar_usuario();
           }else{
             alert("La cuenta de correo ya se encuentra registrada!");
           }
           
        }
    });
}
function grabar_usuario(){
    var parametros = {
         "nbres"     : $("#txt_nbres").val(),
         "apellidos" : $("#txt_apellidos").val(),
         "municipio" : $("#txt_id_municipio").val(),
         "correo"    : $("#txt_correo").val(),
         "clave"     : $("#txt_clave").val(),
         "llamador"  : "grabar_usuario"
     };

     $.ajax({
         url: "../backend/controlador.php",
         data: parametros,
         type: "POST",
         error : function(e) {
             mostrar_ventana_msg("Ocurrio un error al grabar al Usuario ");
         },
         success: function (data) {
             $("#id_usuario").val(data);
             $("#nbre_usuario").val($("#txt_nbres").val());
             mostrar_ventana_reserva();
         }
        });
    };

    /*Busca los municipios por cada tecla que se digite*/
    $('#txt_nbre_municipio_res').typeahead({
   
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
                    mostrar_ventana_msg("Ocurrio un error " + e);
                    
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

    $("#txt_nbre_municipio_res").blur(function(){   //perdió el foco
        $.each(list_municipios, function (i){
            if($.trim(list_municipios[i].Municipio)===$.trim($("#txt_nbre_municipio_res").val())){
                $("#txt_id_municipio").val(list_municipios[i]["Id"]);
                $("#nbre_municipio").val(list_municipios[i]["Nbre"]);
            }
        });
    });

    $("#realizar_reserva").click(function(){
        realizar_reserva();
    });

    function realizar_reserva(){
        /* Valido que los datos esten llenos todos */
        if($("#id_propiedad").val()===null || $("#id_propiedad").val()==="" || $("#id_propiedad").val()==="0"){
            alert("Por favor seleccione una Propiedad.");
        }else if($("#fecha_ini").val()===null || $("#fecha_ini").val()===""){
            alert("Por favor seleccione la fecha desde la cual desea tomar la Propiedad.");
        }else if($("#id_usaurio").val()===null || $("#id_usaurio").val()===""){
            alert("Por favor inicie sesión o regístrese para realizar su reserva.")
        }else{
        
            var parametros = {
                "id_propiedad": $("#id_propiedad").val(),
                "fecha_ini"   : $("#fecha_ini").val(),
                "fecha_fin"   : $("#fecha_fin").val(),
                "id_cliente"  : $("#id_usuario").val(),
                "valor"       : $("#valor").val(),
                "req_aut"     : $("#req_aut").val(),
                "llamador"    : "realizar_reserva"
            };

            
            $.ajax({
                url: "../backend/controlador.php",
                data: parametros,            
                dataType: "json",
                type: "POST",
                error : function(e) {
                    alert("Ocurrio un error al solicitar La Reserva");
                },

                success: function (data) {
                    $("#div_reserva").hide();
                    $("#div_cuerpo").html("Solicitud exitosa!!<br><br>" +
                    "Se realizó la solicitud de reserva No: <strong>" + data);
                    $("#div_cuerpo").show();
                }
            });
        }
    }

    
    function mostrar_ventana_autenticacion(){
        $('#div_cuerpo').hide();
        $('#div_foto').hide();
        $('#div_autenticacion').show();
        $('#div_registrarse').hide();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').hide();
    }
    
    function mostrar_ventana_reserva(){
        $('#div_cuerpo').hide();
        $('#div_foto').hide();
        $('#div_autenticacion').hide();
        $('#div_registrarse').hide();
        $('#div_reserva').show();
        $('#div_recuperar_clave').hide();

        /*Coloco los datos de la reserva */
         $("#res_propiedad").html("ID Propiedad: " + $("#id_propiedad").val() + " en " + $("#nbre_municipio").val() );
         $("#res_propietario").html("ID Propietario: " + $("#id_propietario").val() + " - " + $("#nbre_propietario").val());
         $("#res_valor").html("Valor " + $("#cod_moneda").val() + " " + $("#valor").val());
         $("#datepickerRI").val($("#fecha_ini").val());
         $("#datepickerRF").val($("#fecha_fin").val());
    }

    $("#btn_recuperar_clave").click(function(){
        $('#div_cuerpo').hide();
        $('#div_foto').hide();
        $('#div_autenticacion').hide();
        $('#div_registrarse').hide();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').show();
    });





    /**Configuración de los calendarios **/
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $(function () {
       $.datepicker.setDefaults($.datepicker.regional["es"]);
       $("#datepicker1").datepicker({
           firstDay: 1,
           minDate: 0,
           showButtonPanel: true,
           format: 'yyyy-mm-dd',
           autoclose: true,
           onSelect: function (date) {
            $("#fecha_ini").val(formatear_fecha(date));
            $("#fecha_fin").val(formatear_fecha(date));
            $("#datepicker2").val(date);
            $("#datepicker2").datepicker({
                    minDate: date
            });
           }
       }).datepicker("setDate", new Date());

       $("#datepicker2").datepicker({
           firstDay: 1,
           minDate: 0,
           showButtonPanel: true,
           format: 'yyyy-mm-dd',
           autoclose: true,
           onSelect: function (date) {
            $("#fecha_fin").val(formatear_fecha(date));
           }
       }).datepicker("setDate", new Date());
       
    });


});

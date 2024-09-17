$(document).ready(function(){ 
   
    $("#div_cabecera").load("cabecera.html");
    $("#fecha_ini").val(formatear_fecha(new Date()));
    $("#fecha_fin").val(formatear_fecha(new Date()));

    /****** Variables de inicio de sesión *****/

    /* En este json incluyo la información de los 3 destacados */
    var destacados  = null;              //Array con los 3 destacados que se muestran
   
    var lista_propiedades;                  //Listado de todas las propiedades encontradas en la busqueda
    var cant_max=3;                         //Número máximo de registros encntrados a mostrar por página
    var list_municipios;                    //maneja el array de municipios seleccionados
    var servicio_buscado = "";              //Contiene el servicio que desea buscar (arriendo, compra, alojamiento o subasta)

    marcar_busqueda();
    
     
    function marcar_busqueda(){
        servicio_buscado = $("#servicio").val();

        if(servicio_buscado==="ARRIENDO"){
            $("#flexArriendo").prop("checked",true);
            cargar_destacados();
            
        }else if(servicio_buscado==="COMPRA"){
            $("#flexCompra").prop("checked",true);
            cargar_destacados();
        
        }else if(servicio_buscado==="ALOJAMIENTO"){
            $("#flexAlojamiento").prop("checked",true);
            cargar_destacados();
         
        }else if(servicio_buscado==="SUBASTA"){
           $("#flexSubasta").prop("checked",true);
            cargar_destacados();
             
        }
    }   
    
    function cargar_destacados(){
        var parametros = {
            "servicio_buscado" : servicio_buscado,
            "llamador" : "cargar_destacados"
        };
        
        $.ajax({
            url:   "../backend/controlador.php",
            type: 'POST',
            dataType : 'json',
            data: parametros,
            error : function(e) {
                mostrar_ventana_msg("Ocurrio un error al consultar las propiedades destacadas " + e);
            },
            success: function(result){
                destacados = result;
                var html="";
                var pos=1;
                $.each(destacados, function (i){
                       $("#card"+pos+"_titulo").html("<strong>&nbsp;&nbsp;"+result[i].Nbre_Municipio+"</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>"+result[i].Tipo_Propiedad+"</p>");
                       $("#card"+pos+"_img").prop("class","img-fluid galeria_img");
                       $("#card"+pos+"_img").prop("src","../img/prop/"+result[i].Id+"/"+result[i].Foto);
                       $("#card"+pos+"_valor").html("Valor $ " + result[i].Cod_Moneda + " " + result[i].Simbolo + " <strong>" + result[i].Valor + "</strong>");
                       $("#id_propiedad_card"+pos).val(result[i].Id);
                       $("#nbre_propiedad_card"+pos).val(result[i].Tipo_Propiedad);
                       $("#id_propietario_card"+pos).val(result[i].Id_Propietario);
                       $("#nbre_propietario_card"+pos).val(result[i].Nbre_Propietario);
                       $("#correo_propietario_card"+pos).val(result[i].Correo);
                       $("#id_municipio_card"+pos).val(result[i].Id_Municipio);
                       $("#nbre_municipio_card"+pos).val(result[i].Nbre_Municipio);
                       $("#simbolo_card"+pos).val(result[i].Simbolo);
                       $("#cod_moneda_card"+pos).val(result[i].Cod_Moneda);
                       $("#valor_card"+pos).val(result[i].Valor);
                       $("#req_aut_card"+pos).val(result[i].Requiere_Autorizacion);
                       
                       if(pos===1){
                           pintar_mapa("card1_mapa",result[i].Geo1,result[i].Geo2, result[i].Tipo_Propiedad);
                       }else if(pos===2){
                           pintar_mapa("card2_mapa",result[i].Geo1,result[i].Geo2, result[i].Tipo_Propiedad);
                       }else if(pos===3){
                           pintar_mapa("card3_mapa",result[i].Geo1,result[i].Geo2, result[i].Tipo_Propiedad);
                       }
                       
                       /*Activo los botones*/
                       $("#btn_ver_card"+pos).prop("disabled", false);
                       $("#btn_reservar_card"+pos).prop("disabled", false);
                       
                      
                       if(result[i].Taxi==="1" || result[i].Auto_Particular==="1" || result[i].Moto_Taxi==="1"){
                            if(result[i].Taxi==="1"){
                                $("#card"+pos+"_taxi").prop("hidden",false);
                            }
                            if(result[i].Auto_Particular==="1"){
                                $("#card"+pos+"_particular").prop("hidden",false);
                            }
                            if(result[i].Moto_Taxi==="1"){
                                $("#card"+pos+"_mototaxi").prop("hidden",false);
                            }
                        }
                        pos++;
                    });
               
            }
         });
    }
    
     
    $(".terminos").click(function(event){
        event.preventDefault();
        window.open("../politicas.pdf");
    });
    
    $("#flexArriendo").change(function(){
        if($('#flexArriendo').prop("checked") == true) {
            arriendo="1";
        }else{
            arriendo="0";
        }
    });
    
    $("#flexCompra").change(function(){
        if($('#flexCompra').prop("checked") == true) {
            compra="1";
        }else{
            compra="0";
        }
    });
    
    $("#flexAlojamiento").change(function(){
        if($('#flexAlojamiento').prop("checked") == true) {
            alojamiento="1";
        }else{
            alojamiento="0";
        }
    });
    
    $("#flexSubasta").change(function(){
        if($('#flexSubasta').prop("checked") == true) {
            subasta="1";
        }else{
            subasta="0";
        }
    });
    
    /*Busca los municipios por cada tecla que se digite*/
   $('#nbre_municipio_buscar').typeahead({
       
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
    
     $("#nbre_municipio_buscar").blur(function(){   //perdió el foco

        $.each(list_municipios, function (i){
            if($.trim(list_municipios[i].Municipio)===$.trim($("#nbre_municipio_buscar").val())){
                $("#id_municipio").val(list_municipios[i]["Id"]);
                $("#nbre_municipio").val(list_municipios[i]["Nbre"]);
                $("#simbolo").val(list_municipios[i]["Simbolo"]);
                $("#cod_moneda").val(list_municipios[i]["Cod_Moneda"]);
            }
        });
    });

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
    
    /*Busca las Propiedades*/
    $("#btn_buscar_propiedad_fecha").click(function(evento){   //Btn buscar arriendos
        evento.preventDefault();
        if($("#id_municipio").val()===null || $("#id_municipio").val()==="" || $("#id_municipio").val()==="0"){
            mostrar_ventana_msg("Por favor seleccione el municipio donde desea buscar propiedades!");
        }else{
            $.each(list_municipios, function (i){
                if(list_municipios[i].Municipio===$("#nbre_municipio_buscar").val()){
                    $("#id_municipio").val(list_municipios[i]["Id"]);
                    $("#nbre_municipio").val(list_municipios[i]["Nbre"]);
                    $("#nbre_municipio_buscar").val(list_municipios[i]["Nbre"]);
                    $("#cod_moneda").val(list_municipios[i]["Cod_Moneda"]);
                    $("#simbolo").val(list_municipios[i]["Simbolo"]);
                }
            });
            buscar_propiedades_fecha();
        }
        
    });
    
    
    function buscar_propiedades_fecha(){
        var html='<div class="spinner-grow bg-info"></div>';
        $("#div_mvto").html(html);
        var fecha_ini =$("#fecha_ini").val();
        var fecha_fin =$("#fecha_fin").val();
        /*var fecha_ini ="2020-09-19";
        var fecha_fin ="2020-09-19";*/
        var id_municipio =$("#id_municipio").val();
        var llamador = "buscar_propiedades_fecha";
    
        var parametros = {
            "servicio_buscado"  : servicio_buscado,
            "fecha_ini"         : fecha_ini,
            "fecha_fin"         : fecha_fin,
            "id_municipio"      : id_municipio,
            "llamador"          : llamador
        };
        
        html='';
        $("#div_mvto").html(html);
        if($("#id_municipio").val()===""){
            mostrar_ventana_msg("Por favor seleccione el Municipio donde buscará");
            
        }else if(fecha_ini===""){
            mostrar_ventana_msg("Por favor digite la Fecha desde la cual necesita buscar arriendos disponibles");
        
        }else if(fecha_fin===""){
            mostrar_ventana_msg("Por favor digite la Fecha hasta la cual necesita buscar arriendos disponibles");
        }else{
            
            $.ajax({
             url:   "../backend/controlador.php",
             type: 'POST',
             dataType : 'json',
             data: parametros,
             error : function(e) {
                 
                 mostrar_ventana_msg("Ocurrio un error al consultar las Propiedades <br> Póngase en contacto con el administrador ");
                 
             },
             success: function(result){
                 if(result.toString()===""){
                    html='<p>Lo sentimos, no se encontraron resultados!</p>';
                    $("#div_mvto").html(html);
                     mostrar_ventana_msg("Lo sentimos!!! No se obtuvo resultado");
                     
                }else{
                    lista_propiedades=result;
                    btn_ultimo_presionado=1;
                    mostrarPropiedades(0,cant_max);
                    
                }
             }

         });
        }
    }
    
    function mostrarPropiedades(ini, fin){

        var ruta=null;
        var html="<br>"+
            "<div class='container'>";
        
        $.each(lista_propiedades, function (i){
            if(i>=ini && i<fin){
                /*Creo los botones que pondré*/
                ruta=lista_propiedades[i].Carpeta;
                
                var btnReservar  = 
                    "<a class='btn btn-success form-control mb-3 mt-3' href='#" + 
                    "' data-id='" + lista_propiedades[i].Id +                  //Id de la propiedad
                    "' data-cos='" + lista_propiedades[i].Valor +            //Costo o valor de la propiedad
                    "' data-cdm='" + lista_propiedades[i].Cod_Moneda +        //Código de la moneda del país
                    "' data-tip='" + lista_propiedades[i].Tipo+              //Id del tipo de propiedad
                    "' data-nbr='" + lista_propiedades[i].Tipo_Propiedad+     //Nbre del tipo de propiedad
                    "' data-mun='" + lista_propiedades[i].Nbre_Municipio+    //Nbre del municipio donde esta la propiedad
                    "' data-idp='" + lista_propiedades[i].Id_Propietario+   //Id del propietario
                    "' data-nbrp='" + lista_propiedades[i].Nbre_Propietario+   //Nbre del propietario
                    "' data-cor='" + lista_propiedades[i].Correo+            //Correo del arrendador
                    "' data-aut='" + lista_propiedades[i].Requiere_Autorizacion+ //Requiere autorización por el arrendador
                    "' data-val='Reservar'> Realizar Reserva </a>";

                    
                var btnAmpliar  = 
                    "<a class='btn btn-primary form-control mb-3 mt-3' href='#" + 
                    "' data-id='" + lista_propiedades[i].Id +                  //Id de la propiedad
                    "' data-cos='" + lista_propiedades[i].Valor +            //Costo o valor de la propiedad
                    "' data-cdm='" + lista_propiedades[i].Cod_Moneda +        //Código de la moneda del país
                    "' data-tip='" + lista_propiedades[i].Tipo+              //Id del tipo de propiedad
                    "' data-nbr='" + lista_propiedades[i].Tipo_Propiedad+     //Nbre del tipo de propiedad
                    "' data-idm='" + lista_propiedades[i].Id_Municipio+      //ID del municipio donde esta la propiedad
                    "' data-mun='" + lista_propiedades[i].Nbre_Municipio+    //Nbre del municipio donde esta la propiedad
                    "' data-idp='" + lista_propiedades[i].Id_Propietario+     //Id del propietario
                    "' data-arr='" + lista_propiedades[i].Nbre_Propietario+   //Nbre del propietario
                    "' data-cor='" + lista_propiedades[i].Correo+            //Correo del propietario
                    "' data-aut='" + lista_propiedades[i].Requiere_Autorizacion+ //Requiere autorización por el propietario
                    "' data-val='Ampliar'> Ampliar Información </a>";
                    
            html+=" <div class='row  mt-3 mb-3'>" +
                
                            /*Primera columna*/
                           "<div class='card mb-3 shadow'>" +
                               "<div class='row g-0 mb-3 mt-3'>" +
                                   "<div class='col-md-5'>" +       //Primera columna
                                        /**** Acá se coloca el slide para mostrar las fotos****/
                                        "<div id='div_carrusel"+i+"'>" +
                                            "<div id='carouselExampleControls"+i+"' class='carousel slide' data-bs-ride='carousel'>"+
                                                "<div class='carousel-inner' id='div_fotos"+i+"' style='max-height:320px'>"+
                                                    /*Aca van las fotos */
                                                "</div>" +
                                                    /*Botones de control */
                                                   "<button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleControls"+i+"' data-bs-slide='prev'>"+
                                                       "<span class='carousel-control-prev-icon' aria-hidden='true'></span>"+
                                                        "<span class='visually-hidden'>Previous</span>"+
                                                    "</button>"+
                                                    "<button class='carousel-control-next' type='button' data-bs-target='#carouselExampleControls"+i+"' data-bs-slide='next'>"+
                                                        "<span class='carousel-control-next-icon' aria-hidden='true'></span>"+
                                                        "<span class='visually-hidden'>Next</span>"+
                                                    "</button>"+

                                            "</div>" +
                                        "</div>" +      //final del div carrusel
                                    "</div>" +      //final de la columna
                                    
                                    
                                /*Segunda columna*/
                                "<div class='col-md-3'>" +
                                  "<div class='card-body'>" +
                                    "<h5 class='card-title'>ID: "+lista_propiedades[i].Id+" "+lista_propiedades[i].Tipo_Propiedad+" en <b>"+lista_propiedades[i].Nbre_Municipio+"</h5>" +
                                    "<hr><p class='card-text'>" + $("#cod_moneda").val() + " " + $("#simbolo").val() + " " + lista_propiedades[i].Valor + "</p>" +
                                    "<p class='card-text'>" +
                                        "<small class='text-muted'>" +
                                            "<ul class='list-unstyled mt-3 mb-4'>"+
                                                "<i class='fa fa-bath'>&nbsp;&nbsp;" + lista_propiedades[i].No_Banios + "&nbsp;&nbsp;</i>" +
                                                "<i class='fa fa-bed'>&nbsp;&nbsp;" + lista_propiedades[i].No_Habitaciones + "</i>" +
                                                "<li>";
                                                    if(lista_propiedades[i].Cocina==="1"){
                                                        html+=" <i class='fa fa-coffee'> Cocina</i>";
                                                    }
                                                    if(lista_propiedades[i].Bar==="1"){
                                                       html+=" <i class='fa fa-beer'> Bar </i>";
                                                    }
                                                    if(lista_propiedades[i].Wifi==="1"){
                                                        html+=" <i class='fa fa-wifi'> Wifi</i>";
                                                    }
                                        html+="</li>" +
                                           "</ul>" +
                                        "</small>" +
                                    "</p>"+
                                   
                                     btnReservar +"<br><br>"+
                                     btnAmpliar +
                                  "</div>" +
                                "</div>" +
                                
                                
                                /*Tercera columna*/
                                "<div class='col-md-4'>" +
                                  "<div class='card-body'>" +
                                    "<p class='card-text mb-2 text-muted'>"+lista_propiedades[i].Observacion+"</p>"+
                                  "</div>" +
                                "</div>" +
                        
                              "</div>" +
                            "</div>" +
                        "</div>";
            }
        });
         $("#div_mvto").html(html);
         mostrarFotos();
    }

    function mostrarFotos(){
        $.each(lista_propiedades, function (i){
            var carpetaF ="../img/prop/"+lista_propiedades[i].Id;
            var parametros = {
                "carpetaF" : carpetaF
            };
            
            var html="";
            $.ajax({
                 url:   "../backend/cargarFotos.php",
                 type: 'POST',
                 dataType : 'json',
                 data: parametros,
                 error : function(r) {
                    mostrar_ventana_msg("Error!<br>Al cargar las fotos ocurrió un error");
                 },
                success: function(listaFotos){
                    var cont=0;
                    $.each(listaFotos, function (p){
                        if(cont===0){
                            $("#div_fotos"+i).append(
                                "<div class='carousel-item active'>" +
                                   "<img src='"+carpetaF+"/"+listaFotos[p]+"' class='img-fluid'  style='width:100%; max-height:300px'>"+
                                "</div>");
                        }else{
                            $("#div_fotos"+i).append(
                                "<div class='carousel-item'>" +
                                   "<img src='"+carpetaF+"/"+listaFotos[p]+"' class='img-fluid'  style='width:100%; max-height:300px'>"+
                                "</div>");
                        }
                           cont++;
                    });
                } 
            });
        });
    }
   
    
   
    $("#div_mvto").on('click','a.btn', function() {

        if($(this).data('val')==="Ampliar"){
            window.open('../frontend/ampliar_info.php?'+
            'id_propiedad=' + $(this).data('id')+
            '&id_usuario='+$("#id_usuario").val() +
            '&nbre_usuario='+$("#nbre_usuario").val() +
            '&correo_usuario='+$("#correo_usuario").val() +
            '&id_propietario='+$(this).data('idp')+
            '&nbre_propietario='+$(this).data('arr')+
            '&id_municipio='+$(this).data('idm')+
            '&nbre_municipio='+$(this).data('mun')+
            '&cod_moneda='+$(this).data('cdm')+
            '&valor='+$(this).data('cos')+
            '&req_aut='+$(this).data('aut'));

        }else if($(this).data('val')==="Reservar"){
            $("#id_propiedad").val($(this).data('id'));
            $("#id_propietario").val($(this).data('idp'));
            $("#nbre_propietario").val($(this).data('nbrp'));
            $("#correo_propietario").val($(this).data('cor'));
            $("#id_municipio").val($(this).data('idm'));
            $("#nbre_municipio").val($(this).data('mun'));
            $("#cod_moneda").val($(this).data('cdm'));
            $("#valor").val($(this).data('cos'));
            $("#req_aut").val($(this).data('aut'));
            $("#btn_modal").click();

            if($("#id_usuario").val()===undefined || $("#id_usuario").val()==="" || $("#id_usuario").val()==="0"){
                mostrar_ventana_autenticacion();
    
            }else{
                mostrar_ventana_reserva();
            }
            
        }
    });

    $("#div_mvto").on('click','img.img-fluid', function() {
        mostrar_ventana_foto($(this).prop('src').toString());
    });
    
    function reservar(){
        if($("#id_usuario").val()===undefined || $("#id_usuario").val()==="" || $("#id_usuario").val()==="0"){
            mostrar_ventana_autenticacion();

        }else{
            /*lleno los datos */
            mostrar_ventana_reserva();
        }
    }
    
   
        function mover_al_div(){
            $('html,body').animate({
                scrollTop: $("#div_mvto").offset().top
            }, 1000);
        }
    
        function formatear_fecha(fecha){
            var fh = moment(fecha,'DD/MM/YYYY').format('YYYY/MM/DD');
            return fh;
        }
    
    /************************* Botones de la ventana Modal ****************************/
    
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

    $("#realizar_reserva").click(function(){
        realizar_reserva();
    });


    $("#btn_recuperar_clave").click(function(){
        $('#div_cuerpo').hide();
        $('#div_foto').hide();
        $('#div_autenticacion').hide();
        $('#div_registrarse').hide();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').show();
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

                success: function (id) {
                    //alert("enviara correo al propietario " + $("#correo_propietario").val() + " y al usuario " + $("#correo_usuario").val());
                    /** Envío correo al propietario de la propiedad 
                     * nbre: del propietario
                     * municipio: municipio donde está la propiedad
                     * correo : del proveedor                   
                     * clave: acá utilizo esta variable para enviar el nombre de la propiedad
                     * id: número de reserva
                    **/
                    enviar_correo(
                        $("#nbre_propietario").val(),
                        $("#nbre_municipio").val(),
                        $("#correo_propietario").val(),
                        $("#nbre_propiedad").val(), //la variable clave la utilizo para mandar el nombre de la propiedad
                        id,
                        "Reserva_Propietario");

                    /** Envío correo al usuario*/
                    enviar_correo(
                        $("#nbre_usuario").val(),
                        $("#nbre_municipio").val(), 
                        $("#correo_usuario").val(),
                        $("#nbre_propiedad").val(), //la variable clave la utilizo para mandar el nombre de la propiedad
                        id,
                        "Reserva_Usuario");

                    $("#div_reserva").hide();
                    $("#div_cuerpo").html("Solicitud exitosa!!<br><br>" +
                    "Se realizó la solicitud de reserva No: <strong>" + id);
                    $("#div_cuerpo").show();
                }
            });
        }
    }

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
                    $("#correo_usuario").val($("#email").val());
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
         "nbres"     : $("#txt_nbres_reg").val(),
         "apellidos" : $("#txt_apellidos_reg").val(),
         "municipio" : $("#txt_id_municipio").val(),
         "correo"    : $("#txt_correo_reg").val(),
         "clave"     : $("#txt_clave_reg").val(),
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
             $("#correo_usuario").val($("#txt_correo_reg").val());
             $("#id_usuario").val(data);
             $("#nbre_usuario").val($("#txt_nbres").val());
             mostrar_ventana_reserva();
             
         }
     });
     
}

    /*****Botones para ver los destacados*****/
    $("#btn_ver_card1").click(function(evento){   //presiono click
        evento.preventDefault();
        window.open('../frontend/ampliar_info.php?'+
                'id_propiedad=' + destacados[0].Id+
                '&id_usuario='+$("#id_usuario").val() +
                '&id_propietario='+$("#id_propietario_card1").val() +
                '&nbre_propietario='+$("#nbre_propietario_card1").val() +
                '&id_municipio='+$("#id_municipio_card1").val() +
                '&nbre_municipio='+$("#nbre_municipio_card1").val() +
                '&cod_moneda='+$("#cod_moneda").val() +
                '&valor='+$("#valor_card1").val() +
                '&req_aut='+$("#req_aut_card1").val());
    });
    $("#btn_ver_card2").click(function(evento){   //presiono click
        evento.preventDefault();
        window.open('../frontend/ampliar_info.php?'+
                'id_propiedad=' + destacados[1].Id+
                '&id_usuario='+$("#id_usuario").val() +
                '&id_propietario='+$("#id_propietario_card2").val() +
                '&nbre_propietario='+$("#nbre_propietario_card2").val() +
                '&id_municipio='+$("#id_municipio_card2").val() +
                '&nbre_municipio='+$("#nbre_municipio_card2").val() +
                '&cod_moneda='+$("#cod_moneda").val() +
                '&valor='+$("#valor_card2").val() +
                '&req_aut='+$("#req_aut_card2").val());

    
    });
    $("#btn_ver_card3").click(function(evento){   //presiono click
        evento.preventDefault();
        window.open('../frontend/ampliar_info.php?'+
                'id_propiedad=' + destacados[2].Id+
                '&id_usuario='+$("#id_usuario").val() +
                '&id_propietario='+$("#id_propietario_card3").val() +
                '&nbre_propietario='+$("#nbre_propietario_card3").val() +
                '&id_municipio='+$("#id_municipio_card3").val() +
                '&nbre_municipio='+$("#nbre_municipio_card3").val() +
                '&cod_moneda='+$("#cod_moneda").val() +
                '&valor='+$("#valor_card3").val() +
                '&req_aut='+$("#req_aut_card3").val());

     
    });
    
    $("#btn_reservar_card1").click(function(evento){   //presiono click
        evento.preventDefault();
        llenar_reserva_destacados(1);
        $("#btn_modal").click();
    });
    $("#btn_reservar_card2").click(function(evento){   //presiono click
        evento.preventDefault();
        llenar_reserva_destacados(2);
        $("#btn_modal").click();
    });
    $("#btn_reservar_card3").click(function(evento){   //presiono click
        evento.preventDefault();
        llenar_reserva_destacados(3);
        $("#btn_modal").click();
    });

    /**este boton esta en la página de ampliar información*/
    $(".reservar").click(function(evento){   //presiono click
        evento.preventDefault();
        /*llenar_reserva_destacados(3);
        $("#btn_modal").click();*/
    });

    function llenar_reserva_destacados(num){
        $("#id_propiedad").val($("#id_propiedad_card"+num).val());
        $("#nbre_propiedad").val($("#nbre_propiedad_card"+num).val());
        $("#id_propietario").val($("#id_propietario_card"+num).val());
        $("#nbre_propietario").val($("#nbre_propietario_card"+num).val());
        $("#correo_propietario").val($("#correo_propietario_card"+num).val());
        $("#id_municipio").val($("#id_municipio_card"+num).val());
        $("#nbre_municipio").val($("#nbre_municipio_card"+num).val());
        $("#simbolo").val($("#simbolo_card"+num).val());
        $("#cod_moneda").val($("#cod_moneda_card"+num).val());
        $("#fecha_ini").val(formatear_fecha(new Date()));
        $("#fecha_fin").val(formatear_fecha(new Date()));
        $("#valor").val($("#valor_card"+num).val());
        $("#medio_pago").val($("#medio_pago_card"+num).html());
        $("#req_aut").val($("#req_aut_card"+num).val());
        reservar();

    }

    $("#card1_img").click(function(evento){   //presiono click
        evento.preventDefault();
        mostrar_ventana_foto($("#card1_img").prop("src").toString());
    });    
    $("#card2_img").click(function(evento){   //presiono click
        evento.preventDefault();
        mostrar_ventana_foto($("#card2_img").prop("src").toString());
    });
    
    $("#card3_img").click(function(evento){   //presiono click
        evento.preventDefault();
        mostrar_ventana_foto($("#card3_img").prop("src").toString());
    });
    
    
    
    
    
    /*****Boton para ver los términos y condiciones*****/
    $(".btn_ver_doc").click(function(evento){   //presiono click
        evento.preventDefault();
        window.open('../politicas.pdf');
    });
    
    function mostrar_ventana_msg(cuerpo){
        $('#div_cuerpo').show();
        $('#div_foto').hide();
        $('#div_autenticacion').hide();
        $('#div_registrarse').hide();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').hide();
        $('#div_cuerpo').html(cuerpo);
        $("#btn_modal").click();
    }

    function mostrar_ventana_foto(url){
        $('#div_cuerpo').hide();
        $('#div_foto').show();
        $('#div_autenticacion').hide();
        $('#div_registrarse').hide();
        $('#div_recuperar_clave').hide();
        $('#div_reserva').hide();

        $("#foto1").show();
        $("#foto1").attr("src",url);
        $("#btn_modal").click();
    }

    function mostrar_ventana_autenticacion(){
        $('#div_cuerpo').hide();
        $('#div_foto').hide();
        $('#div_autenticacion').show();
        $('#div_registrarse').hide();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').hide();
        //$("#btn_modal").click();
    }

    function mostrar_ventana_registrese(){
        $('#div_cuerpo').hide();
        $('#div_foto').hide();
        $('#div_autenticacion').hide();
        $('#div_registrarse').show();
        $('#div_reserva').hide();
        $('#div_recuperar_clave').hide();
        //$("#btn_modal").click();
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
    
    
    /********** Función para el envío de correo **********/
    function enviar_correo(nbres,municipio,correo,clave,id,destino){
        var url="";
        var parametros = {
            "nbres" : nbres,
            "municipio"     : municipio,
            "correo"        : correo,
            "clave"         : clave,
            "id"            : id,
            "destino"       : destino
        };

        /*alert("Enviara Nbres " + nbres +
        "- Municipio: " + municipio + 
        "- Correo: " +  correo +
        "- Clave: " + clave +
        "- id: " + id +
        "- destino: " + destino);*/

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
                alert("Ocurrió un error al enviar el correo." +
                    "\\n\\n<em>Equipo de qartos!</em>");
            },
            success: function (data) {
                alert("Se ha enviado un correo electrónico a la cuenta " + correo +
                    "\\n\\nEquipo de qartos!");
            }
        });
    }
    
    


     /**** Geolocalización*****/
    function pintar_mapa(tarjeta, lat, long, tipo_Propiedad){
        var mymap = L.map(tarjeta).setView([lat, long], 13);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
        }).addTo(mymap);

        L.marker([lat, long]).addTo(mymap)
                .bindPopup("<b>"+tipo_Propiedad+"!</b>").openPopup();

    }



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
            $("#datepickerRI").val(date);
            $("#datepickerRF").val(date);
            $("#datepicker2").datepicker({
                    minDate: date
            });
            $("#datepickerRI").datepicker({
                    minDate: date
            });
            $("#datepickerRF").datepicker({
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

       $("#datepickerRI").datepicker({
           firstDay: 1,
           minDate: 0,
           showButtonPanel: true,
           format: 'yyyy-mm-dd',
           autoclose: true,
           onSelect: function (date) {
            $("#fecha_ini").val(formatear_fecha(date));
            $("#fecha_fin").val(formatear_fecha(date));
            $("#datepicker2").val(date);
            $("#datepicker1").val(date);
            $("#datepickerRF").val(date);
            reservarray.fecha_ini=date;
            $("#datepicker2").datepicker({
                    minDate: date
            });
            $("#datepicker1").datepicker({
                    minDate: date
            });
            $("#datepickerRF").datepicker({
                    minDate: date
            });
           }
       }).datepicker("setDate", new Date());

       $("#datepickerRF").datepicker({
           firstDay: 1,
           minDate: 0,
           showButtonPanel: true,
           format: 'yyyy-mm-dd',
           autoclose: true,
           onSelect: function (date) {
            $("#fecha_fin").val(date);
            reservarray.fecha_fin=date;
           }
           
       }).datepicker("setDate", new Date());
    });


 
    
    

});

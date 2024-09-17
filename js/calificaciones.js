$(document).ready(function(){ 
    var id_reserva=0;

    /* Para el manejo de las estrellas de calificaciones */
      var $s2input = $('#star2_input');
      $('#star2').starrr({
        max: 5,
        rating: $s2input.val(),
        change: function(e, value){
          $s2input.val(value).trigger('input');
        }
      });
      /* final del manejo de las estrellas */


    $("#div_cabecera").load("../frontend/cabecera.html");

    /* Calificaciones dadas como usuario */
    listar_calificaciones_realizadas_como_usuario();
    function listar_calificaciones_realizadas_como_usuario(){
        var parametros = {
            "id_usuario": $("#id_usuario").val(),
            "llamador"  : "listar_calificaciones_realizadas_como_usuario"
        };
    
        $.ajax({
            url: "../backend/controlador.php",
            data: parametros,
            type: "POST",
            dataType: 'json',
            error : function(e) {
                mostrar_msg("Ocurrio un error al cargar las calificaciones como Usuario");
            },
            success: function (result) {
               var bajas=0, medias=0, altas=0;
                var html="";
                $.each(result, function (i){
                    var btn_cal = "<a class='btn btn-light form-control"+
                    "' href='#" + 
                    "' data-id='"+result[i].Id+
                    "' data-val='Calificar'> Calificar Servicio </a>";

                    html+="<tr>"+
                        "<td>"+result[i].Id+"</td>"+
                        "<td>"+result[i].Fecha+"</td>"+
                        "<td>"+result[i].Propiedad+"</td>"+
                        "<td>"+result[i].Municipio+"</td>";

                        if(result[i].Cal_Del_Usuario==="0"){
                            html+="<td>"+btn_cal+"</td>";
                        
                        }else if(result[i].Cal_Del_Usuario==="1" || result[i].Cal_Del_Usuario==="2"){
                            html+="<td><p class='bg-danger form-control text-white text-center'> " +
                              "<i class='fa fa-star'></i><i class='fa fa-star'></i> Muy baja"+
                            "</p></td>";
                            bajas++;
                        
                        }else if(result[i].Cal_Del_Usuario==="3" || result[i].Cal_Del_Usuario==="4"){
                            html+="<td><p class='bg-success form-control text-white text-center'> " +
                            "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> Media"+
                          "</p></td>";
                          medias++;

                        }else if(result[i].Cal_Del_Usuario==="5"){
                            html+="<td><p class='bg-primary form-control text-white text-center'> " +
                            "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> Alta"+
                          "</p></td>";
                          altas++;
                        
                        }
                        
                        html+="<tr>";
                });
                $("#tabla_cal_usuario").html(html);
                $("#cal_bajas").val(bajas);
                $("#cal_medias").val(medias);
                $("#cal_altas").val(altas);
            }
        })
    }

    $("#tabla_cal_usuario").on('click','a.btn', function() {
        if($(this).data('val')==="Calificar"){
            id_reserva = $(this).data('id');
            $("#div_cuerpo").html("");
            $("#star2").val(0);
            $("#star2_input").val(0);
            $("#btn_ventana_modal").click();
        }
    });

    $("#star2").click(function(){
		calificar("Cal_Del_Usuario");
	});

    function calificar(campo){
        var parametros = {
            "reserva"   : id_reserva,
            "cal"       : $("#star2_input").val(),
            "campo"     : campo,
            "llamador"  : "calificar"
        };

        $.ajax({
            url: "../backend/controlador.php",
            data: parametros,
            type: "POST",
            error : function(e) {
                mostrar_msg("Ocurrio un error al grabar la Calificación como Propietario");
            },
            success: function (result) {
                $("#div_cuerpo").html("<br><p>Calificación realizada, muchas gracias!</p><br>");
                if(campo==="Cal_Del_Usuario"){
                    $("#tabla_cal_usuario").append("");
                    listar_calificaciones_realizadas_como_usuario();
                }else{
                    $("#tabla_cal_propietario").append("");
                    listar_calificaciones_realizadas_como_propietario();
                }
                
                
            }
        });
    }



    /* Calificaciones dadas como propietario */
    listar_calificaciones_realizadas_como_propietario();
    function listar_calificaciones_realizadas_como_propietario(){
        var parametros = {
            "id_usuario": $("#id_usuario").val(),
            "llamador"  : "listar_calificaciones_realizadas_como_propietario"
        };
    
        $.ajax({
            url: "../backend/controlador.php",
            data: parametros,
            type: "POST",
            dataType: 'json',
            error : function(e) {
                mostrar_msg("Ocurrio un error al cargar las calificaciones como Propietario");
            },
            success: function (result) {
               var bajas=0, medias=0, altas=0;
                var html="";
                $.each(result, function (i){
                    var btn_cal = "<a class='btn btn-light form-control"+
                    "' href='#" + 
                    "' data-id='"+result[i].Id+
                    "' data-val='Calificar'> Calificar Servicio </a>";

                    html+="<tr>"+
                        "<td>"+result[i].Id+"</td>"+
                        "<td>"+result[i].Fecha+"</td>"+
                        "<td>"+result[i].Propiedad+"</td>"+
                        "<td>"+result[i].Municipio+"</td>";

                        if(result[i].Cal_Del_Propietario==="0"){
                            html+="<td>"+btn_cal+"</td>";
                        
                        }else if(result[i].Cal_Del_Propietario==="1" || result[i].Cal_Del_Propietario==="2"){
                            html+="<td><p class='bg-danger form-control text-white text-center'> " +
                              "<i class='fa fa-star'></i><i class='fa fa-star'></i> Muy baja"+
                            "</p></td>";
                            bajas++;
                        
                        }else if(result[i].Cal_Del_Propietario==="3" || result[i].Cal_Del_Propietario==="4"){
                            html+="<td><p class='bg-success form-control text-white text-center'> " +
                            "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> Media"+
                          "</p></td>";
                          medias++;

                        }else if(result[i].Cal_Del_Propietario==="5"){
                            html+="<td><p class='bg-primary form-control text-white text-center'> " +
                            "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> Alta"+
                          "</p></td>";
                          altas++;
                        
                        }
                        
                        html+="<tr>";
                });
                $("#tabla_cal_propietario").html(html);
                $("#cal_bajas").val(bajas);
                $("#cal_medias").val(medias);
                $("#cal_altas").val(altas);
            }
        })
    }

    $("#tabla_cal_propietario").on('click','a.btn', function() {
        if($(this).data('val')==="Calificar"){
            id_reserva = $(this).data('id');
            $("#div_cuerpo").html("");
            $("#star2").val(0);
            $("#star2_input").val(0);
            $("#btn_ventana_modal").click();
        }
    });

    $("#star2").click(function(){
		calificar("Cal_Del_Propietario");
	});


});
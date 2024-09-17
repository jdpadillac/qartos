$(document).ready(function(){ 
    var campo="Fecha_Reg";
    var orden=" DESC ";
    cargar_mensajes();
    
    function cargar_mensajes(){
        var campO = campo;
        var ordeN = orden;
        var llamador = "cargar_mensajes";
        
        var parametros = {
            "campo"    : campO,
            "orden"    : ordeN,
            "llamador" : llamador
        };
        $.ajax({
            url:   "backend/controlador_admin.php",
            type: 'POST',
            dataType : 'json',
            data: parametros,
            error : function(a) {
                alert(a);
                mostrar_ventana_modal("Ocurrio un error al consultar los mensajes");
            },
            success: function(result){
                if(result.toString()===""){
                    return false;
               }else{
                   var html="<table class='table table-bordered'>"+
                        "<thead>" +
                          "<tr>" +
                              "<th>Id</th>"+
                              "<th>Nombres</th>"+
                              "<th>Correo</th>"+
                              "<th>Asunto</th>"+
                              "<th>Fecha de Registro</th>"+
                              "<th>Contestadación</th>"+
                              "<th>Fecha Contestado</th>"+
                            "</tr>" +
                        "</thead>";        //Termina la cabecera
                   $.each(result, function (i){
                        html+="<body><tr'>"+
                                "<td>" +result[i].Id + "</td>" +
                                "<td>" +result[i].Nbre + "</td>" +
                                "<td>" +result[i].Correo + "</td>" +
                                "<td>" +result[i].Asunto + "</td>" +
                                "<td>" +result[i].Fecha_Reg + "</td>" +
                                "<td>" +result[i].Contestado + "</td>" +
                                "<td>" +result[i].Fecha_Contestado + "</td>" +
                              "</tr></body>";

                    });
                    html+="</table>";
                   $("#tabla").html(html);
                }
            }
        });
    }
    
     function asignar_campo(campO){
        campo=campO;
    }
    
    function asignar_orden(ordeN){
        orden=ordeN;
    }
    
    
    $("#btn_ordenar").click(function(evento){
        evento.preventDefault();
        if($('#chk_item').prop('checked')===true){
            asignar_campo("Id");
        }else if($('#chk_nbres').prop('checked')===true){
            asignar_campo("Nbre");
        }else if($('#chk_correo').prop('checked')===true){
            asignar_campo("Correo");
        }else if($('#chk_fecha_reg').prop('checked')===true){
            asignar_campo("Fecha_Reg");
        }else if($('#chk_con').prop('checked')===true){
            asignar_campo("Fecha_Reg");
        }else if($('#chk_fecha_con').prop('checked')===true){
            asignar_campo("Fecha_Reg");
        }
        
        if($('#chk_asc').prop('checked')===true){
            asignar_orden(" ASC ");
        }else if($('#chk_des').prop('checked')===true){
            asignar_orden(" DESC ");
        }    
        cargar_mensajes();
    });
    
    
    
    function mostrar_ventana_modal(mensaje){
        $('#cuerpo').html("<p>"+mensaje+"</p>");
        $("#btn_modal").click();
    }
    
    
});

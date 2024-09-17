$(document).ready(function(){ 
    var campo="reservas.Fecha_Reg";
    var orden=" DESC ";
    listado_reservas();
    
    function listado_reservas(){
        var campO = campo;
        var ordeN = orden;
        var llamador = "listado_reservas";
        
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
            error : function(q) {
                alert(q);
                mostrar_msg("Ocurrio un error al consultar el listado de Reservas");
            },
            success: function(result){
                if(result.toString()===""){
                    return false;
               }else{
                   var html="<table class='table table-bordered'>"+
                        "<thead>" +
                          "<tr>" +
                              "<th>Id</th>"+
                              "<th>Fecha Inicial</th>"+
                              "<th>Fecha Final</th>"+
                              "<th>Usuario</th>"+
                              "<th>Propiedad</th>"+
                              "<th>Valor</th>"+
                              "<th>Ref. Pago</th>"+
                              "<th>Cal del Propietario</th>"+
                              "<th>Cal del Usuario</th>"+
                              "<th>Fecha_Autorizado</th>"+
                              "<th>Fecha_Cancelacion</th>"+
                              "</tr></thead>";        //Termina la cabecera
                              
                              
                            "</tr>";        //Termina la cabecera
                   $.each(result, function (i){
                         html+="<body><tr'>"+
                                "<td>" +result[i].Id + "</td>" +
                                "<td>" +result[i].Fecha_Ini + "</td>" +
                                "<td>" +result[i].Fecha_Fin + "</td>" +
                                "<td>" +result[i].Usuario + "</td>" +
                                "<td>" +result[i].Propiedad + "</td>" +
                                "<td>" +result[i].Valor + "</td>" +
                                "<td>" +result[i].Referencia_Pago + "</td>" +
                                "<td>" +result[i].Fecha_Pago + "</td>" +
                                "<td>" +result[i].Cal_Del_Propietario + "</td>" +
                                "<td>" +result[i].Cal_Del_Usuario + "</td>" +
                                "<td>" +result[i].Fecha_Autorizado + "</td>" +
                                "<td>" +result[i].Fecha_Cancelacion + "</td>" +
                                "<td>" +result[i].Fecha_Reg + "</td>" +
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
        if($('#chk_ini').prop('checked')===true){
            asignar_campo("reservas.Fecha_Ini");
        }else if($('#chk_fin').prop('checked')===true){
            asignar_campo("reservas.Fecha_Fin");
        }else if($('#chk_reg').prop('checked')===true){
            asignar_campo("reservas.Fecha_Reg");
        }
        
        if($('#chk_asc').prop('checked')===true){
            asignar_orden(" ASC ");
        }else if($('#chk_des').prop('checked')===true){
            asignar_orden(" DESC ");
        }    
        listado_reservas();
    });
    
    
    function mostrar_msg(cuerpo){
        $('#cuerpo').html("<p>"+cuerpo+"</p>");
        $("#btn_ventana_modal").click();
    }
    
});

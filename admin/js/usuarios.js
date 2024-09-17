$(document).ready(function(){ 
    var campo="usuarios.Fecha_Reg";
    var orden=" DESC ";
    listado_usuarios();
    
    function listado_usuarios(){
        var campO = campo;
        var ordeN = orden;
        var llamador = "listado_usuarios";
        
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
                mostrar_msg("Ocurrio un error al consultar el listado de Arrendadores");
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
                              "<th>Municipio</th>"+
                              "<th>Teléfono</th>"+
                              "<th>Correos</th>"+
                              "<th>Activo</th>"+
                              "<th>Califica Buenas</th>"+
                              "<th>Califica Neutras</th>"+
                              "<th>Califica Buenas</th>"+
                              "<th>Fecha Reg</th>"+
                            "</tr></thead>";        //Termina la cabecera
                   $.each(result, function (i){
                         html+="<body><tr'>"+
                                "<td>" +result[i].Id + "</td>" +
                                "<td>" +result[i].Nbres + "</td>" +
                                "<td>" +result[i].Municipio + "</td>" +
                                "<td>" +result[i].Telefono + "</td>" +
                                "<td>" +result[i].Correo + "</td>" +
                                "<td>" +result[i].Activo + "</td>" +
                                "<td>" +result[i].Calificacion1 + "</td>" +
                                "<td>" +result[i].Calificacion2 + "</td>" +
                                "<td>" +result[i].Calificacion3 + "</td>" +
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
        if($('#chk_nbres').prop('checked')===true){
            asignar_campo("huespedes.Nbres");
        }else if($('#chk_municipio').prop('checked')===true){
            asignar_campo("municipios.Nbre");
        }else if($('#chk_activo').prop('checked')===true){
            asignar_campo("huespedes.Activo");
        }else if($('#chk_cal1').prop('checked')===true){
            asignar_campo("huespedes.Calificacion1");
        }else if($('#chk_cal2').prop('checked')===true){
            asignar_campo("huespedes.Calificacion2");
        }else if($('#chk_cal3').prop('checked')===true){
            asignar_campo("huespedes.Calificacion3");
        }else if($('#chk_reg').prop('checked')===true){
            asignar_campo("huespedes.Fecha_Reg");
        }
        
        if($('#chk_asc').prop('checked')===true){
            asignar_orden(" ASC ");
        }else if($('#chk_des').prop('checked')===true){
            asignar_orden(" DESC ");
        }    
        listado_usuarios();
    });
    
    
    function mostrar_msg(cuerpo){
        $('#cuerpo').html("<p>"+cuerpo+"</p>");
        $("#btn_ventana_modal").click();
    }
    
    
});

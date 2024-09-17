$(document).ready(function(){ 
    var campo="propiedades.Fecha_Reg";
    var orden=" DESC ";
    listado_propiedades();
    
    
    function listado_propiedades(){
        var campO = campo;
        var ordeN = orden;
        var llamador = "listado_propiedades";
        
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
                mostrar_msg("Ocurrio un error al consultar el listado de Propiedades");
            },
            success: function(result){
                if(result.toString()===""){
                    return false;
               }else{
                   var html="<table class='table table-bordered'>"+
                        "<thead>" +
                          "<tr>" +
                              "<th>Id</th>"+
                              "<th>Propietario</th>"+
                              "<th>Municipio</th>"+
                              "<th>Dirección</th>"+
                              "<th>Teléfono</th>"+
                              "<th>Fecha Inicio</th>"+
                              "<th>Fecha Final</th>"+
                              "<th>Valor</th>"+
                              "<th>Propiedad No.</th>"+
                              "<th>Activo</th>"+
                              "<th>Fecha Reg</th>"+
                            "</tr></thead>";        //Termina la cabecera
                   $.each(result, function (i){
                        html+="<body><tr'>"+
                                "<td>" +result[i].Id + "</td>" +
                                "<td>" +result[i].Propietario + "</td>" +
                                "<td>" +result[i].Municipio + "</td>" +
                                "<td>" +result[i].Direccion + "</td>" +
                                "<td>" +result[i].Telefono + "</td>" +
                                "<td>" +result[i].Fecha_Ini_Disp + "</td>" +
                                "<td>" +result[i].Fecha_Fin_Disp + "</td>" +
                                "<td>" +result[i].Valor + "</td>" +
                                "<td>" +result[i].Tipo_Propiedad + "</td>" +
                                "<td>" +result[i].Activo + "</td>" +
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
            asignar_campo("soluciones.Municipio");
        }else if($('#chk_reg').prop('checked')===true){
            asignar_campo("soluciones.Fecha_Reg");
        }
        
        if($('#chk_asc').prop('checked')===true){
            asignar_orden(" ASC ");
        }else if($('#chk_des').prop('checked')===true){
            asignar_orden(" DESC ");
        }    
        listado_propiedades();
    });
    
    
    function mostrar_msg(cuerpo){
        $('#cuerpo').html("<p>"+cuerpo+"</p>");
        $("#btn_ventana_modal").click();
    }
    
    
});

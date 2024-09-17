$(document).ready(function(){ 
    
    var d = new Date();
    var month = d.getMonth()+1; 
    var day = d.getDate();
    var year = d.getFullYear();
    //var output = d.getFullYear() + '/' + (month<10 ? '0' : '') + month + '/' + (day<10 ? '0' : '') + day;


    /* Solicito el total de registros */
    load_dash("contactenos","","","contac_all","0");            //contact all
    load_dash("usuarios","","","propietario_all","2");      //propietarios all
    load_dash("usuarios","","","usuarios_all","1");           //huespedes all
    load_dash("propiedades","","","propiedades_all","0");        //propiedades all
    load_dash("reservas","","","reservas_all","0");             //reservas all
    
    load_dash("contactenos",month, year, "contac_mes","0");      // contac whith month
    load_dash("usuarios",month, year, "propietario_mes","2");      // contac whith month
    load_dash("usuarios",month, year, "usuarios_mes","1");      // contac whith month
    load_dash("propiedades",month, year, "propiedades_mes","0");      // contac whith month
    load_dash("reservas",month, year, "reservas_mes","0");      // contac whith month
    
    $("#btn_contactos").click(function(evento){
        evento.preventDefault();
        $("#div_mvto").load("contactenos.php");
    });
    
    $("#btn_list_propietarios").click(function(evento){
        evento.preventDefault();
        $("#div_mvto").load("propietarios.php");
    });
    
    $("#btn_list_propiedades").click(function(evento){
        evento.preventDefault();
        $("#div_mvto").load("propiedades.php");
    });
    
    $("#btn_list_usuarios").click(function(evento){
        evento.preventDefault();
        $("#div_mvto").load("usuarios.php");
    });
    
    $("#btn_list_reservas").click(function(evento){
        evento.preventDefault();
        $("#div_mvto").load("reservas.php");
    });
    

    /* Función que carga los totales de mes y general de cada card */
    function load_dash(table, month, year, element, user){
        /*user: 0: No hay consulta de usuarios
        * user: 1: Consulta los usuarios
        * user: 2: Consulta los propietarios
        * */

        var llamador = "load_dash";
        if(user==="1" || user==="2"){
            llamador = "load_dash_user";
        }
        var params = {
            "table"    : table,
            "month"    : month,
            "year"     : year,
            "user"     : user,
            "llamador" : llamador
        };

        $.ajax({
           url: "backend/controlador_admin.php",
           type: "POST",
           dataType: "json",
           data: params,
           error: function(){
               mostrar_msg("Hubo un error al consultas los datos");
           },
           success: function(result){
               if(month!==null && month!==""){
                   $("#"+element).html("Mes: " + result[0].Cant);
               }else{
                   $("#"+element).html("Total: " + result[0].Cant);
               }
           }
        });
    }
    
   function mostrar_msg(cuerpo){
        $('#cuerpo').html("<p>"+cuerpo+"</p>");
        $("#btn_modal").click();
    }
    
    
    
});

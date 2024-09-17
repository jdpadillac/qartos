$(document).ready(function(){ 
    
    mostrarFotos();
     
    
    function mostrarFotos(){
            var carpetaF =$("#id_solucion_info").val();
            var parametros = {
                "carpetaF" : "../img/solu/"+carpetaF
            };
            $.ajax({
                 url:   "../backend/cargarFotos.php",
                 type: 'POST',
                 dataType : 'json',
                 data: parametros,
                 error : function(r) {
                    mostrar_ventana_msg("No se pudieron cargar las fotos");
                 },
                 success: function(listaFotos){
                     var k=0;   //Indice para el $ 
                     $.each(listaFotos, function (p){
                         if(k===0){ //coloco la primera opcion activa
                            $("#listaOL").append("<li data-target='#listaOL' data-slide-to='"+k+"' class='active'></li>");
                            $('#div_fotos').append('<div class="carousel-item active">'+
                                '<img class="img-fluid galeria_img" src="../img/solu/'+carpetaF+'/'+listaFotos[p]+'" alt="foto" style="width: 98%; max-height:300px;">'+
                            '</div>');
                         }else{
                             $("#listaOL").append("<li data-target='#listaOL' data-slide-to='"+k+"'></li>");
                             $('#div_fotos').append('<div class="carousel-item">'+
                                '<img class="img-fluid galeria_img" src="../img/solu/'+carpetaF+'/'+listaFotos[p]+'" alt="foto" style="width: 98%; max-height:300px;">'+
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
        mostrar_ventana_foto(nbre);
    });
 
    
    /********************* Ventanas Modales *************************/
    function mostrar_ventana_foto(url){
        $("#cuerpo_info").hide();
        $("#div_aut_info").hide();
        $("#div_reg_info").hide();
        $('#div_recuperar_clave').hide();
        $("#btn_mod_aut_info").hide();
        $("#btn_mod_reg_info").hide();
        
        $("#div_foto_info").sow();
        $("#foto_info").attr("src",url);
    }
     
   function mostrar_ventana_msg(cuerpO){
        $("#div_foto_info").hide();
        $('#div_aut_info').hide();
        $('#div_reg_info').hide();
        $('#div_recuperar_clave').hide();
        $("#btn_mod_aut_info").hide();
        $("#btn_mod_reg_info").hide();
        
        $('#cuerpo_info').show();
        $('#cuerpo_info').html("<p>"+cuerpO+"</p>");
    }
    
});

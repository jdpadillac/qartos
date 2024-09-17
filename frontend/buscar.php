<!DOCTYPE html>
<html lang="en">
    <head>
      <title>qartos</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link  rel="icon"   href="../favicon.ico" type="image/png" />
      
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
         
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
         <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
         <script src="../js/buscar.js"></script>
         <script src="../js/generar_clave.js"></script>
         
         <!-- librerias para la busqueda -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        
         <!--Para el manejo de los calendarios-->
          <link rel="stylesheet" href="../css/jquery-ui.min.css" />
          <script src="../js/jquery-ui.min.js"></script>
      
        <!-- libreria para los mapas -->
        <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
        
        <!-- librerias para pantallas modales -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
         <!-- libreria para pasar el formato de fecha y hora -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
         
      
    </head>
    <body>
        
    
      <!--Campos de variables de huespedes y arrendadores-->
      <input type="hidden" id="id_usuario"   value="<?php echo $_REQUEST["id_usuario"]?>">
      <input type="hidden" id="nbre_usuario" value="<?php echo $_REQUEST["nbre_usuario"]?>">
      <input type="hidden" id="correo_usuario" value="<?php echo $_REQUEST["correo_usuario"]?>">
      <input type="hidden" id="id_propiedad">
      <input type="hidden" id="nbre_propiedad">
      <input type="hidden" id="id_propietario">
      <input type="hidden" id="nbre_propietario">
      <input type="hidden" id="correo_propietario">
      <input type="hidden" id="id_municipio">
      <input type="hidden" id="nbre_municipio">
      <input type="hidden" id="simbolo">
      <input type="hidden" id="cod_moneda">
      <input type="hidden" id="fecha_ini">
      <input type="hidden" id="fecha_fin">
      <input type="hidden" id="valor">
      <input type="hidden" id="medio_pago">
      <input type="hidden" id="req_aut">

      <div class="container-fluid">   
        <!-- Aca coloco la cabecera-->        
        <div class="row" id="div_cabecera"></div> 

        <div class="row">
          <form class="container">
            <div class="row mt-5" id="fila">
              <input id="servicio" value="<?php echo $_REQUEST["servicio"] ?>" hidden>
              <h3 class="text-center text-muted">¿QUE ESTAS BUSCANDO?</h3> 
            </div>    
            <div class="row mb-5 mt-3">
              <div class="col-sm-3">            
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexArriendo">
                  <label class="form-check-label" for="flexArriendo">Arriendos</label>
                </div>
              </div>
              <div class="col-sm-3">  
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexCompra">
                  <label class="form-check-label" for="flexCompra">Comprar propiedad</label>
                </div>
              </div>
              <div class="col-sm-3">  
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexAlojamiento">
                  <label class="form-check-label" for="flexAlojamiento">Alojamiento</label>
                </div>
              </div>
              <div class="col-sm-3">  
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSubasta">
                  <label class="form-check-label" for="flexSubasta">Subasta</label>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <input type="search" name="nbre_municipio_buscar" id="nbre_municipio_buscar" class="form-control" placeholder="Municipio"/>
              
            </div>
            <div class="col-sm-3">
              <input size="14" class="form-control bg-white" id="datepicker1" placeholder="A partir de que fecha?" readonly>
            </div>
            <div class="col-sm-3">
              <input size="14" class="form-control bg-white" id="datepicker2" placeholder="Fecha de regreso" readonly>
            </div>
            <div class="col-sm-2">
              <button type="submit" id="btn_buscar_propiedad_fecha" class="btn btn-primary rounded-pill form-control"> <i class="fa fa-search" aria-hidden="true"></i> Buscar </button>
            </div>
          </form>
        </div>
         
        
           
        </div> <!-- final del contenedor -->
        <br><br>

        <!-- div de movimiento -->
        <div class="row pt-5 mt-5" id="div_mvto"></div>
        <hr><br>
        
        <div class="jumbotron text-center" id="titulo_destacados">
          <h1>DESTACADOS</h1>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-4">      <!-- Columna No 1 -->
                <div class="card destacados">
                    <div class="row">
                        <div class="col-sm-12"> 
                            <div class="card shadow-lg">
                                <div class="card-title ms-3 titulo_tarjeta">
                                    <br><i class="card-title fa fa-map-marker" id="card1_titulo" aria-hidden="true" > No disponible</i>
                                </div>
                                 <div class="card-subtitle"  style="max-height:200px">
                                    <a href="#"><img src="../img/sin_imagen.jpg" id="card1_img" class="img-fluid d-block galeria_img"  style="width:100%; max-height:200px"  ></a>    
                                </div>
                                
                                <div class="card-body">
                                <span id="card1_valor" class="card-subtitle mt-3"></span>
                                   <!-- información para cuando hagan reserva-->
                                   <input type="hidden" id="id_propiedad_card1" >
                                   <input type="hidden" id="nbre_propiedad_card1" >
                                   <input type="hidden" id="id_propietario_card1" >
                                   <input type="hidden" id="nbre_propietario_card1">
                                   <input type="hidden" id="correo_propietario_card1">
                                   <input type="hidden" id="id_municipio_card1" >
                                   <input type="hidden" id="nbre_municipio_card1" >
                                   <input type="hidden" id="simbolo_card1" > 
                                   <input type="hidden" id="cod_moneda_card1" >
                                   <input type="hidden" id="valor_card1">
                                   <input type="hidden" id="medio_pago_card1" >
                                   <input type="hidden" id="req_aut_card1" >
                                   

                                    <br>
                                    <button disabled type="submit" class="btn btn-primary mt-3 mb-3"  id="btn_ver_card1"> <i class="fa fa-see" aria-hidden="true"></i> Ampliar Información </button>
                                    <button disabled type="submit" class="btn btn-primary" id="btn_reservar_card1" > <i class="fa fa-see" aria-hidden="true"></i> Realizar Reserva </button>
                                    
                                    <!--<div id="card1_mapa" class="tabcontent form-control" style="width: 90%; height: 250px;"></div>-->
                                    <div id="card1_mapa" class="tabcontent form-control" style="width: 100%; height: 300px;">
                                        <div id="card1_mapa" class="img-fluid"></div>
                                    </div>
        
                                    
                                    <div class="center-text mt-3 mb-3">
                                        <b class="mb-3">SERVICIO DE TRANSPORTE</b>
                                        <p hidden="hidden" class='card-footer fa fa-taxi' id='card1_taxi'> Taxi</p>
                                        <p hidden="hidden" class='card-footer fa fa-car' id='card1_particular'> Auto Particular </p>
                                        <p hidden="hidden" class='card-footer fa fa-motorcycle' id='card1_mototaxi'> Mototaxi </p>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>
                   
                </div>
            </div>


            <div class="col-sm-4">      <!-- Columna No 2 -->
                <div class="card destacados">
                    <div class="row">
                        <div class="col-sm-12"> 
                            <div class="card shadow-lg">
                                <div class="card-title ms-3 titulo_tarjeta">
                                    <br><i class="card-title fa fa-map-marker" id="card2_titulo" aria-hidden="true" > No disponible </i>
                                </div>
                                 <div class="card-subtitle" style="max-height:200px">
                                    <a href="#"><img src="../img/sin_imagen.jpg" id="card2_img" class="img-fluid d-block galeria_img"  style="width:100%; max-height:200px"  ></a>    
                                </div>
                                
                                
                                <div class="card-body">
                                <span id="card2_valor" class="card-subtitle mt-3"></span>
                                   <!-- información para cuando hagan reserva-->
                                   <input type="hidden" id="id_propiedad_card2" >
                                   <input type="hidden" id="nbre_propiedad_card2" >
                                   <input type="hidden" id="id_propietario_card2" >
                                   <input type="hidden" id="nbre_propietario_card2" >
                                   <input type="hidden" id="correo_propietario_card2">
                                   <input type="hidden" id="id_municipio_card2" >
                                   <input type="hidden" id="nbre_municipio_card2" >
                                   <input type="hidden" id="simbolo_card2" >
                                   <input type="hidden" id="cod_moneda_card2" >
                                   <input type="hidden" id="valor_card2">
                                   <input type="hidden" id="medio_pago_card2" >
                                   <input type="hidden" id="req_aut_card2" >

                                    <br>
                                    <button disabled type="submit" class="btn btn-primary mt-3 mb-3"  id="btn_ver_card2"> <i class="fa fa-see" aria-hidden="true"></i> Ampliar Información </button>
                                    <button disabled type="submit" class="btn btn-primary" id="btn_reservar_card2" > <i class="fa fa-see" aria-hidden="true"></i> Realizar Reserva </button>
                                    
                                    <div id="card2_mapa" class="tabcontent form-control" style="width: 100%; height: 300px;">
                                        <div id="card2_mapa" class="img-fluid"></div>
                                    </div>
        
                                    <div class="center-text mt-3">
                                        <b class="mb-3">SERVICIO DE TRANSPORTE</b>
                                        <p hidden="hidden" class='card-footer fa fa-taxi' id='card2_taxi'> Taxi</p>
                                        <p hidden="hidden" class='card-footer fa fa-car' id='card2_particular'> Auto Particular </p>
                                        <p hidden="hidden" class='card-footer fa fa-motorcycle' id='card2_mototaxi'> Mototaxi </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div> <!-- final de la 2da columna -->
            
            
            <div class="col-sm-4">      <!-- Columna No 3 -->
                <div class="card destacados">
                    <div class="row">
                        <div class="col-sm-12"> 
                            <div class="card shadow-lg">
                                <div class="card-title ms-3 titulo_tarjeta">
                                    <br><i class="card-title fa fa-map-marker" id="card3_titulo" aria-hidden="true" > No disponible </i>
                                </div>
                                <div class="card-subtitle" style="max-height:200px">
                                    <a href="#"><img src="../img/sin_imagen.jpg" id="card3_img" class="img-fluid d-block galeria_img"  style="width:100%; max-height:200px"  ></a>    
                                </div>
                                
                                
                                
                                 <div class="card-body">
                                 <span id="card3_valor" class="card-subtitle mt-3"></span>
                                   <!-- información para cuando hagan reserva-->
                                   <input type="hidden" id="id_propiedad_card3" > 
                                   <input type="hidden" id="nbre_propiedad_card3" >
                                   <input type="hidden" id="id_propietario_card3" >
                                   <input type="hidden" id="nbre_propietario_card3" >
                                   <input type="hidden" id="correo_propietario_card3">
                                   <input type="hidden" id="id_municipio_card3" >
                                   <input type="hidden" id="nbre_municipio_card3" >
                                   <input type="hidden" id="simbolo_card3" > 
                                   <input type="hidden" id="cod_moneda_card3" > 
                                   <input type="hidden" id="valor_card3">
                                   <input type="hidden" id="medio_pago_card3" >
                                   <input type="hidden" id="req_aut_card3" >
        
                                    <br>
                                    <button disabled type="submit" class="btn btn-primary mt-3 mb-3"  id="btn_ver_card3"> <i class="fa fa-see" aria-hidden="true"></i> Ampliar Información </button>
                                    <button disabled type="submit" class="btn btn-primary "id="btn_reservar_card3"> <i class="fa fa-see" aria-hidden="true"></i> Realizar Reserva </button>
                                    
                                    <!--<div id="card3_mapa" class="tabcontent form-control" style="width: 90%; height: 250px;"></div>-->
                                     <div id="card3_mapa" class="tabcontent form-control" style="width: 100%; height: 300px;">
                                        <div id="card3_mapa" class="img-fluid"></div>
                                    </div>
        
        
                                    <div class="center-text mt-3">
                                        <b class="mb-3">SERVICIO DE TRANSPORTE</b>
                                        <p hidden="hidden" class='card-footer fa fa-taxi' id='card3_taxi'> Taxi</p>
                                        <p hidden="hidden" class='card-footer fa fa-car' id='card3_particular'> Auto Particular </p>
                                        <p hidden="hidden" class='card-footer fa fa-motorcycle' id='card3_mototaxi'> Mototaxi </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div> <!-- final de la 3ra columna -->
          </div>    <!--fonal de la fila -->
        </div>    <!--fonal del contenedor de destacados-->
        
        




        <!-- Ventana Modal -->
        <div id="ventana_modal">
            <button type="button" data-toggle="modal" data-target="#ventanaModal" id="btn_modal"></button>

            <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
               <div class="modal-content">
                   <!--Cabecera -->
                   <div class="modal-header bg-primary">
                       <h5 class="modal-title" id="titulo">
                           <img src="../img/logo_invers-01-01-01.png" width="20%" class="img-fluid" alt="logo" >
                       </h5>
                    <button type="button" class="close alert-dark" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                   <!--Cuerpo-->
                   <div class="modal-body" id="div_cuerpo"></div>
                   <div class="modal-body" id="div_foto"><img id="foto1" width="100%" height="100%"></div>
                   
                   <!-- div de autenticación -->
                   <div class="modal-body" id="div_autenticacion">
                      <div class="container">
                        <div class="row">
                          <div class="col-sm-4">
                            <img class="img-fluid img-rounded" src="../img/clave.jpg" style="width:100%">
                          </div>
                          <div class="col-sm-4 mt-3 mb-3 card shadow">
                            <div class="card-body">
                                <p class="mt-3" for="email">Usuario</p>
                                <input class="form-control me-1" type="email" placeholder="correo" id="email" name="email" value="jdpadillac@gmail.com">
                                <p class="mt-3" for="clave">Clave</p>
                                <input class="form-control me-1 mb-3" type="password" placeholder="clave" id="clave" value="123">
                                
                                  <div class="card-header mt-3 mb-3">
                                    <p class="text-danger" id="div_comentarios"></p>
                                  </div>
                                  <a href="#" class="link-secondary terminos mt-3 mb-3"> Ver términos, políticas y condiciones</a>
                                
                            </div>
                                <div class="card-footer text-center mb-3">
                                  <button class="btn btn-primary" type="submit" id="btn_modal_autenticarse"> Ingresar </button>
                                  <button class="btn btn-primary" type="submit" id="btn_modal_registrarse"> Registrarse </button>
                                  <small class="text-muted mt-3"><a href="#" id="btn_recuperar_clave" class="card-link">Olvido su clave?</a></small>
                                </div>                            
                          </div>
                        </div>
                      </div>
                   </div>
                    <!-- fin del div de autenticación -->

                    <!-- Pantalla para registrarse -->
                    <div class="modal-body" id="div_registrarse" class="container mb-3 mt-3">
                      <div class="row">
                        
                          <div class="modal-title">
                              <h5>REGISTRARSE</h5>
                          </div>
                          <div class="card-body">
                            <form>
                              <div class="mx-3">
                                <label class="col-form-label" for="txt_nbres_reg">Nombres</label>
                                <input class="form-control" id="txt_nbres_reg" type="text" />
                              </div>
                              <div class="mx-3">
                                <label class="col-form-label" for="txt_apellidos_reg">Apellidos</label>
                                <input class="form-control" id="txt_apellidos_reg" type="text" />
                              </div>
                              <div class="mx-3">
                                <label class="col-form-label" for="txt_nbre_municipio_res">Municipio</label>
                                <input id="txt_id_municipio" type="text" hidden="hidden"/>
                                <input class="form-control" id="txt_nbre_municipio_res" type="text" />
                              </div>
                              <div class="mx-3">
                                <label class="col-form-label" for="txt_correo_reg">Correo</label>
                                <input class="form-control" id="txt_correo_reg" name="email" type="email" />
                              </div>
                              <div class="mx-3">
                                <label class="col-form-label" for="txt_clave_reg">Clave</label>
                                <input type="password" class="form-control" id="txt_clave_reg">
                              </div>
                              <div class="mx-3">
                                 <a href="#" class="link-secondary terminos mt-3 mb-3"> Ver términos, políticas y condiciones</a>
                              </div>
                              <div class="mx-3">
                                <div id="div_error" class="p-3 mb-2 bg-danger text-white"></div>
                              </div>
                              <div class="mx-3 mt-3 mb-3">
                                <button class="btn btn-primary" id="btn_registrarse"> Registrarme </button>
                              </div>
                              
                            </form>
                          </div>
                        
                      </div>
                    </div>
                        

                   <!-- pantalla de reserva -->
                   <div class="modal-body" id="div_reserva" class="mb-3 mt-3">
                      <div class="card shadow mx-auto" style="width: 36rem;">
                        <div class="card-header">
                        <strong>RESERVA</strong>
                          <p>Se realizará una reserva con los siguientes datos:</p>
                        </div>
                        <div class="card-body">
                            <p id="res_propiedad"></p>
                            <p id="res_propietario"></p>
                            <p id="res_valor">Valor</p>
                            <p class="mt-3">Fecha de Inicio:</p>
                            <input class="form-control bg-white" id="datepickerRI" placeholder="A partir de que fecha?" readonly>
                            <p class="mt-3">Fecha Final:</p>
                            <input class="form-control bg-white" id="datepickerRF" placeholder="Hasta que fecha?" readonly>
                          <div class="card_footer mt-3">
                            <button class="btn btn-primary" id="realizar_reserva"> Realizar Reserva </buttom>
                          </div>
                        </div> 
                      </div>
                    </div> 
                   
                    <!--Pantalla para recuperar la clave-->
                    <div class="modal-body" id="div_recuperar_clave" class="mb-3 mt-3">
                      <div class="card shadow mx-auto" style="width: 36rem;">
                        <div class="card-header">
                          RECUPERAR CLAVE
                        </div>
                        <div class="card-body">
                          <p>Por favor digite su dirección de correo electrónico:</p>
                            <input class="form-control bg-white" type="email" name="email" id="txt_recuperar_clave_buscar" placeholder="Cuenta de correo registrada">
                          <div class="card_footer mb-3 mt-3">
                            <button class="btn btn-primary mt-3" id="btn_recuperar_clave_buscar"> Recuperar Clave </buttom>
                          </div>
                        </div> 
                      </div>
                    </div> 


                   <!--Pie de página-->
                   <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_mod_cerrar"> Cerrar </button>
                 </div>
               </div>
             </div>
           </div>
        </div>                <!--Aqui termina la ventana para los mensajes modales-->
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
      <title>qartos</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link  rel="icon"   href="../favicon.ico" type="image/png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="../js/ampliar_info.js" type="text/javascript"></script>
      <script src="../js/generar_clave.js"></script>
      
      <!-- librerias para la busqueda -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
      
      <!--Para el manejo de los calendarios-->
      <link rel="stylesheet" href="../css/jquery-ui.min.css" />
      <script src="../js/jquery-ui.min.js"></script>
      
      
      <!-- Geo localización -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
      <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
      <!-- enlaces para ventanas modales -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


     
    </head>
    
    <body>
        <input type="hidden" id="id_usuario"  value="<?php echo $_REQUEST["id_usuario"]?>" >
        <input type="hidden" id="nbre_usuario" value="<?php echo $_REQUEST["nbre_usuario"]?>">
        <input type="hidden" id="correo_usuario" value="<?php echo $_REQUEST["correo_usuario"]?>">
        <input type="hidden" id="id_propiedad" value="<?php echo $_REQUEST["id_propiedad"]?>" >
        <input type="hidden" id="id_propietario"  value="<?php echo $_REQUEST["id_propietario"]?>" >
        <input type="hidden" id="nbre_propietario"  value="<?php echo $_REQUEST["nbre_propietario"]?>" >
        <input type="hidden" id="id_municipio"  value="<?php echo $_REQUEST["id_municipio"]?>" >
        <input type="hidden" id="nbre_municipio"  value="<?php echo $_REQUEST["nbre_municipio"]?>" >
        <input type="hidden" id="cod_moneda"  value="<?php echo $_REQUEST["cod_moneda"]?>" >
        <input type="hidden" id="valor"  value="<?php echo $_REQUEST["valor"]?>" >
        <input type="hidden" id="req_aut"  value="<?php echo $_REQUEST["req_aut"]?>" >
        <input type="hidden" id="fecha_ini" value="<?php echo $_REQUEST["fecha_ini"]?>" >
        <input type="hidden" id="fecha_fin" value="<?php echo $_REQUEST["fecha_fin"]?>" >
        
        
        <div id="div_cabecera"></div>
        <h1 class=" text-center"><i class="card-title fa fa-map-marker text-muted" id="titulo" aria-hidden="true" > </i> </h1>
        <h3 class="text-center">Información detallada de la propiedad</h3>

        <div class="container">
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <div class="row">
                    <!--Primera columna para los datos -->
                    <div class="col-sm-4">
                        <div id='carrusel' class='carousel slide' data-ride='carousel'>
                            <ol class='carousel-indicators' id='listaOL'></ol>
                           <div class='carousel-inner' id='div_fotos'></div>
                        </div>



                        <div class="card-header" id="cabecera">
                            <span id="valor"></span>
                        </div>
                        <div class="card-body">
                            <ul class='list-unstyled mt-3 mb-4  text-center'>
                                    <i class='fa fa-sign-in' id="sala" hidden="hidden"></i>
                                    <i class='fa fa-cutlery' id="comedor" hidden="hidden"></i>
                                    <i class='fa fa-coffee'id="cocina" hidden="hidden"></i>
                                    
                                    <i class='fa fa-futbol-o'id="patio" hidden="hidden"></i>
                                    
                                    <i class='fa fa-university'id="conjunto_cerrado" hidden="hidden"></i>
                                    <i class='fa fa-university-0'id="conjunto_abierto" hidden="hidden"></i>
                                    <i class='fa fa-support'id="piscina" hidden="hidden"></i>
                                    <i class='fa fa-sun-o'id="turco" hidden="hidden"></i>
                                    <i class='fa fa-thermometer'id="sauna" hidden="hidden"></i>
                                    <i class='fa fa-square-o'id="balcon" hidden="hidden"></i>
                                    <i class='fa fa-laptop'id="amoblada" hidden="hidden"></i>
                                    <i class='fa fa-institution'id="kiosko" hidden="hidden"></i>
                                    <i class='fa fa-beer' id="bar" hidden="hidden"></i>
                                    <i class='fa fa-thermometer-0' id="aire" hidden="hidden"></i>
                                    <i class='fa fa-thermometer' id="calefaccion" hidden="hidden"></i>
                                    <i class='fa fa-times-rectangle-o' id="sotano" hidden="hidden"></i>
                                    <i class='fa fa-toggle-up' id="atico" hidden="hidden"></i>
                                    <i class='fa fa-key' id="caja_fuerte" hidden="hidden"></i>
                                    <i class='fa fa-trash-o' id="cuarto_labores" hidden="hidden"></i>
                                    <i class='fa fa-wifi' id="wifi" hidden="hidden"></i>
    
                                  <br>
                                  <li>
                                      <div class='container'>
    
                                          <hr>
                                          <div class='card-footer'><b>HABITACIONES</b></div><hr><br>
                                          <i class='fa fa-shower' hidden="hidden"  id="no_banios"></i>&nbsp;&nbsp;
                                          <i class='fa fa-bed' hidden="hidden"  id="no_habitaciones"></i>&nbsp;&nbsp;
                                          <i class='fa fa-shower' hidden="hidden" id="hab_ppal_banio"></i>&nbsp;&nbsp;
                                          <i class='fa fa-deaf' hidden="hidden" id="hab_ppal_aire" aria-hidden='true'></i>&nbsp;&nbsp;
                                          
                                          <div class='card-footer'><b>PISOS</b></div><hr><br>
                                          <i class='fa fa-institution' id="no_pisos"></i>&nbsp;&nbsp;
                                          <i class='fa fa-institution' id="no_piso"></i>&nbsp;&nbsp;
                                          <i class='fa fa-taxi' hidden="hidden" id="garage"></i>&nbsp;&nbsp;
                                          
                                          <br><br>
                                          <div class='card-footer' id="div_transp"><b>SERVICIOS DE TRANSPORTE</b></div><hr>
                                          <p class='card-footer fa fa-taxi' id='taxi'> Taxi</p><br>
                                          <p class='card-footer fa fa-car' id='auto'> Auto Particular </p><br>
                                          <p class='card-footer fa fa-motorcycle' id='moto'> Mototaxi </p><br>
                                    
                                          <div class='card-footer'><b>CALIFICACIONES</b><br>
                                              <i class='fa fa-heart'></i>&nbsp;&nbsp;<span id="buenas"></span><br>
                                              <i class='fa fa-heartbeat'></i>&nbsp;&nbsp;<span id="neutras"> </span><br>
                                              <i class='fa fa-heart-o' aria-hidden='true'></i>&nbsp;&nbsp;<span id="malas"></span>
                                          </div>
                                      </div>
                                  </li>
                            </ul>
                        
                            <div class='card-footer'><b>Observaciones</b>
                                <p id="observacion"></p>
                            </div>
                            <button type="submit" class="btn btn-primary reservar mt-3 mb-3"> <i class="fa fa-ticket" aria-hidden="true"></i> Realizar Reserva </button>
                        </div>
                    </div>
                    
                    <!--Segunda columna para el mapa -->
                    <div class="col-sm-8">
                        <div id="mapid" class="tabcontent form-control" style="width: 100%; height: 800px;">
                           <div id="mapid" style="width: 1200px; height: 800px;"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-3 mb-3 reservar" id="btn_realizar_reserva_info"> <i class="fa fa-ticket" aria-hidden="true"  ></i> Realizar Reserva </button>
                    </div>
                </div>
            </div>
        
                
        
        
             <!-- Ventana Modal -->
        <div id="ventana_modal">
            <button type="button" data-toggle="modal" data-target="#ventanaModal" id="btn_modal" hidden="hidden"></button>

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
                          <div class="col-sm-2"></div>
                          <div class="col-sm-8 mt-3 mb-3 card shadow">
                            <div class="card-body mt-3">
                                <img class="img-fluid img-rounded" src="../img/clave.jpg" style="width:100%">
                                <p class="mt-3" for="email">Usuario</p>
                                <input class="form-control me-1" type="email" placeholder="correo" id="email" name="email" value="jdpadillac@gmail.com">
                                <p class="mt-3" for="clave">Clave</p>
                                <input class="form-control me-1 mb-3" type="password" placeholder="clave" id="clave" value="LozEf0bb">
                                
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
                          <div class="col-sm-2"></div>
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
                                <input id="txt_id_municipio" type="text" hidden="hidden"/>
                                <label class="col-form-label" for="txt_nbre_municipio_res">Municipio</label>
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
                            <input class="form-control bg-white" id="datepicker1" placeholder="A partir de que fecha?" readonly>
                            <p class="mt-3">Fecha Final:</p>
                            <input class="form-control bg-white" id="datepicker2" placeholder="Hasta que fecha?" readonly>
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
        </div>  

       </div> <!-- final del div contenedor -->
        
    </body>
</html>
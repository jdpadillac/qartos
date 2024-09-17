<!DOCTYPE HTML>
<html lang="es">
     <head>
       <link  rel="icon"   href="../favicon.ico" type="image/png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    	<link crossorigin="anonymous" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" rel="stylesheet" />
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    	
    	<!-- manejo del mapa -->
    	<link crossorigin="" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" rel="stylesheet" /><script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    	
    	<!--librerias para busqueda-->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        
        
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
        <script type="text/javascript" src="../js/propiedad.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
        <!--<script type="text/javascript" src="../js/utilidades.js"></script>-->
     </head>
   
    <body>
        <!-- campos que utilizo cono variables -->
        <input type="text" id="id_usuario"       value="<?php echo $_REQUEST["id_usuario"] ?>">
        <input type="text" id="nbre_usuario"     value="<?php echo $_REQUEST["nbre_usuario"] ?>" >
        <input type="text" id="id_propietario"   value='<?php echo $_REQUEST["id_usuario"];?>'/>
        <input type="text" id="nbre_propietario" value='<?php echo $_REQUEST["nbre_usuario"];?>'/>
        <input type="text" id="id_propiedad"/>
        <input type="text" id="id_municipio">

        <nav class="navbar navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand">
                    <img src="../img/logo.jpg" class="img-fluid mx-auto" width="30%" height="30%">
                    <p><?php echo $_REQUEST["nbre_usuario"] ?> que deseas hacer con la propiedad:</p>
                          
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="rdo_servicio" id="rdo_arrendar" value="arriendo">
                      <label class="form-check-label" for="rdo_arrendar">Arrendar</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="rdo_servicio" id="rdo_vender" value="venta">
                      <label class="form-check-label" for="rdo_vender">Vender</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="rdo_servicio" id="rdo_alojar" value="alojamiento" >
                      <label class="form-check-label" for="rdo_alojar">Ofrecer alojamiento</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="rdo_servicio" id="rdo_subastar" value="subasta" >
                      <label class="form-check-label" for="rdo_subastar">Subastarla</label>
                    </div>
                </a>
            </div>
        </nav>
        
        <!--Div para los datos de la propiedad-->
        <br><br><br><br><br>
       
        <div class="container mt-3 pt-3"><br>
            <div class="card shadow mt-3 pt-3">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="my-5"><b>Información de la propiedad</b></h3>
                        
        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nbre_municipioN">Municipio donde se encuentra la propiedad</label>
                            <input type="hidden" id="id_municipio">
                            <input type="search" id="nbre_municipioN" class="form-control" placeholder="Digite las primeras letras del municipio donde tiene la propiedad">
                            <ul id="listaN"></ul>
                            
                                <label for="tipo_propiedad">Tipo de propiedad</label>
                                <select class="form-control" id="tipo_propiedad">
                                    <option value="0">Seleccione el tipo de propiedad...</option>
                                </select>
                                <label for="valor">Valor $</label>
                                <input type="text" id="valor" class="form-control text-right form_num"  required/>
                                
                                <label for="direccion">Dirección / Barrio </label>
                                <input type="text" id="direccion" class="form-control"/>
                                
                                <label for="telefono">Celular de contacto </label>
                                <input type="text" id="telefono" required class="form-control text-right"/>
                        </div>
                        <div class="form-group col-md-6">
                            <h3 id="ubicacion">Ubicación</h3>
                            <p>Por favor seleccione la localización de la propiedad</p>
                            <div id="mapid" class="tabcontent form-control" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                    
                    
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="no_pisos">Cuantos pisos hay?</label>
                            <input type="number" id="no_pisos" required class="form-control"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="no_piso">¿En que piso se encuentra?</label>
                            <input type="number" id="no_piso" required class="form-control"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="no_habitaciones">Número de habitaciones</label>
                            <input type="number" id="no_habitaciones" class="form-control"/>
                        </div>
                       
                        <div class="form-group col-md-3">
                            <label for="no_banios">Número de Baños</label>
                            <input type="number" id="no_banios" class="form-control"/></label>
                        </div>
                    </div>
                    
                        <div class="w3-container">
                            <div class="jumbotron bg-info">
                                <b>PERIODOS DE DISPONIBILIDAD DE LA PROPIEDAD</b><br><br>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="chk_fecha_cierre">
                                    <label class="custom-control-label" for="chk_fecha_cierre">
                                        Active esta casilla si la disponibilidad es por periodos, de lo contrario, la disponibilidad empieza en 
                                        el momento que termine de grabar y suba las fotos</label><br><br>
                                </div>
        
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fechaIni">Fecha de inicio de disponibilidad</label>
                                        <input type="date" id="fechaIni" class="form-control" disabled="disabled"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fechaFin">Fecha final de disponibilidad</label>
                                        <input type="date" id="fechaFin" class="form-control" disabled="disabed"/>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    <div class="w3-container">
                            <div class="jumbotron">
                                <b>¡REQUIERE AUTORIZACION DEL PROPIETARIO!</b><br><br>
                                <p>Si activa esta opción, requerirá de su aprobación para las solicitudes que hagan los clientes<br>
                                    Si la deja desactivada no será necesario que usted responda y acepte las solicitudes<br>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="chk_autorizacion">
                                    <label class="custom-control-label" for="chk_autorizacion">Requerir autorización al momento de realizar la solicitud</label>
                                </div>
                            </div>
                        </div>
                   
                    <hr>
                    <h3><b>SELECCIONE LOS BENEFICIOS QUE TIENE LA PROPIEDAD</b></h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_sala">
                                <label class="custom-control-label" for="chk_sala">Tiene sala / comedor&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_cocina">
                                <label class="custom-control-label" for="chk_cocina">Tiene cocina&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_hab_ppal_aire">
                                <label class="custom-control-label" for="chk_hab_ppal_aire">La habitación principal tiene aire acondicionado?&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_hab_ppal_banio">
                                <label class="custom-control-label" for="chk_hab_ppal_banio">La habitación principal tiene Baño?&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_patio">
                                <label class="custom-control-label" for="chk_patio">Tiene patio&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_garage">
                                <label class="custom-control-label" for="chk_garage">Tiene garage&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_conjunto_cerrado">
                                <label class="custom-control-label" for="chk_conjunto_cerrado">Se encuentra en conjunto cerrado&nbsp;</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_conjunto_abierto">
                                <label class="custom-control-label" for="chk_conjunto_abierto">Se encuentra en un conjunto abierto&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_piscina">
                                <label class="custom-control-label" for="chk_piscina">Tiene piscina&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_turco">
                                <label class="custom-control-label" for="chk_turco">Tiene baño turco&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_sauna">
                                <label class="custom-control-label" for="chk_sauna">Tiene sauna&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_balcon">
                                <label class="custom-control-label" for="chk_balcon">Tiene balcon&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_amoblada">
                                <label class="custom-control-label" for="chk_amoblada">Se encuentra amoblada&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_kiosko">
                                <label class="custom-control-label" for="chk_kiosko">Tiene kiosko&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_bar">
                                <label class="custom-control-label" for="chk_bar">Tiene bar&nbsp;</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_aire">
                                <label class="custom-control-label" for="chk_aire">Tiene aire acondicionado en la sala / comedor&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_calefaccion">
                                <label class="custom-control-label" for="chk_calefaccion">Tiene calefacción&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_sotano">
                                <label class="custom-control-label" for="chk_sotano">Tiene sotano&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_atico">
                                <label class="custom-control-label" for="chk_atico">Tiene ático&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_caja_fuerte">
                                <label class="custom-control-label" for="chk_caja_fuerte">Tiene caja fuerte&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_cuarto_labores">
                                <label class="custom-control-label" for="chk_cuarto_labores">Tiene cuarto de labores&nbsp;</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_wifi">
                                <label class="custom-control-label" for="chk_wifi">Tiene wifi&nbsp;</label>
                            </div>
                        </div>
        
                    </div>
                    
                    <hr>
                    <h3><b>SERVICIOS DE TRANSPORTE</b></h3>
                    <div class="w3-container">
                        <div class="jumbotron">
                            <b>¡VALOR AGREGADO!</b><br><br>
                            <p>Los siguientes servicios son un plus que usted puede prestar y que no hacen parte de 
                                los servicios de la propiedad, es decir, este costo no esta incluido en el valor y corresponde
                                a un valor agregado que usted presta.<br>
                                Usted lo activará si puede prestar alguno de estos servicios, pero el pago por la
                                utilización de estos, debe cancelarlos el cliente directamente a usted, previo acuerdo de pago.<br>
                                La responsabilidad por el pago y lo que pueda ocurrir durante la prestación de estos
                                servicios, será directamente suya!.<br>
        
                            <div class="col-ml-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="chk_taxi">
                                    <label class="custom-control-label" for="chk_taxi">Presta servico de Taxi&nbsp;</label>
                                </div>
                            </div>
                            <div class="col-ml-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="chk_auto_particular">
                                    <label class="custom-control-label" for="chk_auto_particular">Presta servicio de Auto Particular&nbsp;</label>
                                </div>
                            </div>
                            <div class="col-ml-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="chk_moto">
                                    <label class="custom-control-label" for="chk_moto">Presta servicio de Moto Taxi / Moto Carro&nbsp;</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <h3><b>OBSERVACIONES</b></h3>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" id="txt_observacion" placeholder="Escriba mas detalles aquí..."></textarea><BR>
                    </div>
                    <hr>
                    <div class="w3-container">
                        <button type="button" class="btn btn-primary" id="btn_nueva_propiedad">
                            Nuevo Propiedad
                        </button>
                        
                        <button type="button" class="btn btn-primary" id="btn_grabar_propiedad">
                            Grabar 
                        </button>
                        <button type="button" class="btn btn-primary" id="btn_fotos">
                            Subir Fotos
                        </button>
                        <br><br>
                        <p class="badge-secondary">&nbsp;&nbsp; Para subir las fotos, primero debe grabar la propiedad! </p>
                    </div>
                </div>
            </div>  <!-- final de la tarjeta-->
        </div>  <!-- final del container-->
        <br><br>


        <!-- Ventana modal para mensajes emergentes -->
        <p>
            <button class="btn hidden" data-bs-target="#ventanaPropiedad" data-bs-toggle="modal" id="btn_ventana_propiedad" type="button"></button>
            <!-- Modal -->
        </p>
        <div aria-hidden="true" aria-labelledby="ventanaPropiedad" class="modal fade" id="ventanaPropiedad" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <img alt="logo" src="../img/logo.jpg" width="150" />
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <!--Aca pongo el mensaje para mostrar -->
                    <div class="modal-body" id="cuerpo_propiedad"></div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



    </body>
</html>
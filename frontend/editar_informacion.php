<!DOCTYPE html>

<html>
    <head>
        <title>qartos</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link  rel="icon"   href="../favicon.ico" type="image/png" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link crossorigin="anonymous" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        
         <!-- librerias para la busqueda -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        
        <script type="text/javascript" src="../js/editar_informacion.js"></script>
    </head>
    <body>
         <!--Campos de variables-->
        <input type="text" id="id_usuario"  value="<?php echo $_REQUEST["id_usuario"] ?>" hidden/>
        <input type="text" id="nbre_usuario" value="<?php ECHO $_REQUEST['nbre_usuario']?>" hidden/>
        
        <div id="div_cabecera"></div>
         <div class="container">
            <div class="card shadow mt-3 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class=" card-header">
                                <p class="text-center">DATOS PERSONALES</p>
                            </div>
                            <div class card-title>
                                <img src="../img/no_foto.jpg" class="img-fluid mt-3"  id="fotoA" name="foto"  width="100%">
                            </div>
                            <div class="card-body">
                                    <span>
                                        <input type="file" class="form-control-file" id="rutaFoto" name="rutaFoto" accept="image/png, .jpeg, .jpg, image/gif" hidden>
                                    </span>
                                    <label class="form-control btn btn-primary mt-3 mb-3" for="rutaFoto">
                                        Carmbiar Foto
                                    </label>
                                   
                                    <br>
                                    <hr>
                                    <h3 id="card_nombre"></h3>
                                    <h6 class="fa fa-home" id="card_municipio" ></h6><br>
                                    <h6 id="card_pais" ></h6><br>
                                    <i class="fa fa-address-card" id="card_direccion"></i><br>
                                    <i class="fa fa-phone" id="card_telefono"></i><br>
                                    <i class="fa fa-envelope" id="card_correo"></i><br><br><br>
                                    <input type="text" id="dir_correoA" hidden="hidden">

                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="id_paisA" name="id_pais1"/>
                                        <input type="hidden" id="id_dptoA" name="id_dpto1"/>
                                        <input type="hidden" id="id_municipioA" name="id_municipio1"/>
                                        <input type="hidden" id="txtFotoA" name="txtFotoA"/>
                                   </form>
                                   
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary form-control mt-3 mb-3" id="btn_grabar_foto"> Grabar Foto</button>
                                    </div>
                                
                            </div>
                        </div>
        
                         <div class="col-sm-8">
                            <div class="card border-info">
                                    <div class=" card-header">
                                        <p class="text-center"><strong>DIGITE SOLO LOS DATOS QUE DESEE CAMBIAR!<strong></p>
                                    </div>
                                    <div class="card-body">
                                        <label for="nbre_municipio1">Municipio de arrendamiento</label>
                                        <input type="text" id="nbre_municipioA" class="form-control" placeholder="Digite las primeras letras del municipio donde reside">
                                        <ul id="lista"></ul>
                                        <label for="direccion1">Dirección de Residencia</label>
                                        <input type="text" class="form-control" id="direccionA" placeholder="Dirección actual">
                                        <label for="telefono1">Teléfono de contacto</label>
                                        <input type="text" class="form-control" id="telefonoA" placeholder="Teléfono actual para contacto">
                                        <label for="correo1">Correo</label>
                                        <input type="email" class="form-control" id="correoA" placeholder="Email de contacto">
                                        <label for="clave1">Password</label>
                                        <input type="password" class="form-control" id="claveA" placeholder="Password de acceso">
                                        <hr>
                                        
                                        <h4 class="text-muted">DATOS DE LA CUENTA BANCARIA</h4>
                                        <p class="text-muted">Digite acá la información bancaria donde desee que se le consigne el valor por los arrendamientos:</p>
                                        <label for="cta_nbre">Nombre del propietario de la cuenta</label>
                                        <input type="text" class="form-control" id="cta_nbre">
                                        <label for="cta_banco">Banco</label>
                                        <select class="form-control" id="cta_banco">
                                            <option value=0>Seleccione un banco...</option>;
                                        </select>
                                        <label for="cta_tipo">Tipo de cuenta</label>
                                        <select class="form-control" id="cta_tipo">
                                            <option value="0"> Ahorros </option>
                                            <option value="1"> Corriente </option>
                                        </select>
                                        <label for="cta_numero">Número de cuenta</label>
                                        <input type="text" class="form-control" id="cta_numero">
                                    </div>
                                    
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary form-control mt-3 mb-3" id="btn_modificar_usuario"> Modificar Datos </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       <!-- Ventana modal para mensajes emergentes -->
        <button class="btn" hidden data-bs-target="#editarInfo" data-bs-toggle="modal" id="btn_editar_info" type="button"></button>
        <div aria-hidden="true" aria-labelledby="editarInfo" class="modal fade" id="editarInfo" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <img alt="logo" src="../img/logo.jpg" width="150" />
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <!--Aca pongo el mensaje para mostrar -->
                    <div class="modal-body" id="cuerpo_editar"></div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

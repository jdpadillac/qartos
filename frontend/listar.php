<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8">
    	<title>qartos</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link  rel="icon"   href="../favicon.ico" type="image/png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/listar.js"></script>
    </head>
   
    <body>
        <div class="container-fluid">
            <input type="hidden" id="id_propietario" value= '<?php echo $_REQUEST["id_propietario"];?>'/>
            <input type="hidden" id="nbre_propietario" value= '<?php echo $_REQUEST["nbre_propietario"];?>'/>
            
            <div id="div_cabecera"></div>
            <div class="container">
                <h4 class="mt-3 mb-3"><?php echo $_REQUEST["nbre_propietario"] ?>, estas son tus propiedades inscritas:</h4>
            </div>

            <!--Div para los datos de la propiedad-->
            
            <div class="mt-3 mb-3" id="div_cuadro_propiedades"></div>

        </div>


        <!-- Ventana modal para mensajes emergentes -->
        <button class="btn" hidden="hidden" data-bs-target="#ventanaListar" data-bs-toggle="modal" id="btn_ventana_listar" type="button"></button>
        <div aria-hidden="true" aria-labelledby="ventanaListar" class="modal fade" id="ventanaListar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <img alt="logo" src="../img/logo.jpg" width="150" />
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <!--Aca pongo el mensaje para mostrar -->
                    <div class="modal-body" id="cuerpo_listar"></div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" id="btn_activar">Si</button>
                        <button class="btn btn-secondary" type="button" id="btn_desactivar">No</button>
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal" >Cerrar</button>
                    </div>
                </div>
            </div>
        </div>    
    </body>
</html>

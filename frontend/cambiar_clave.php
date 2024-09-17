<!DOCTYPE html>
<html lang="en">
    <head>
      <title>qartos</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link  rel="icon"   href="favicon.ico" type="image/png" />
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script src="../js/cambiar_clave.js"></script>
      
    </head>
    <body>
        <!--Campos de variables-->
        <input type="text" id="id_usuario"   value="<?php echo $_REQUEST['id_usuario']; ?>" hidden="hidden"/>
        <input type="text" id="nbre_usuario" value="<?php echo $_REQUEST['nbre_usuario'];?>" hidden="hidden"/>

        <div id="div_cabecera"></div>

        <div class="container"> 
          <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 card shadow mt-3 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-img">
                                <img src="../img/clave.webp" class="img-fluid" style="width:100%">
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card-header">
                              <div class="card-title">
                                  <h5>CAMBIO DE CLAVE</h5>
                              </div>
                          </div>
                          <label class="label-control">Digite su nueva clave</label>
                          <input type="password" class="form-control" id="txt_clave">
                          <label class="label-control">Repita su nueva clave</label>
                          <input type="password" class="form-control" id="txt_clave1">
                          <button class="btn btn-primary mt-3 mb-3" id="btn_cambiar_clave"> Grabar </button>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-sm-4"></div>
        
           
        </div> <!-- final del contenedor -->
        
        
        <!-- Ventana Modal para mensajes simples-->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="btn_msg" hidden></button>
        </div>
        
        <!-- The Modal -->
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">qartos</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body" id="cuerpo_msg"></div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar </button>
              </div>
        
            </div>
          </div>
        </div>                <!--Aqui termina la ventana para los mensajes-->
        
    </body>
</html>
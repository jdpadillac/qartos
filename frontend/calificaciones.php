<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    	<title>qartos</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link  rel="icon"   href="../favicon.ico" type="image/png" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link href="../css/fontawesome/css/all.css" rel="stylesheet">
        <!-- libreria para las estrellas de calificaciones -->
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/starrr.css">


        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/js/star-rating.js" type="text/javascript"></script>
        <script src="../js/calificaciones.js"></script>

        

        <style type='text/css'>
            img.ribbon {
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            border: 0;
            cursor: pointer; }
        </style>
        <script src="../css/starrr.js"></script>

    </head>
    <body>
        <div id="div_cabecera"></div>
        <input type="hidden" id="id_usuario" value="<?php echo $_REQUEST['id_usuario']?>">
        <input type="hidden" id="nbre_usuario" value="<?php echo $_REQUEST['nbre_usuario']?>">
        
        <div class="container">
            <div class="row">
                <h3 class="text-mudet">Hola <?php echo $_REQUEST['nbre_usuario']?></h3>
                <p>Así esta tu sistema de calificaciones:</p>


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Calificaciones Recibidas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cal_user-tab" data-bs-toggle="tab" data-bs-target="#cal_user" type="button" role="tab" aria-controls="profile" aria-selected="false">Calificaciones Dadas como Usuario</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cal_prop-tab" data-bs-toggle="tab" data-bs-target="#cal_prop" type="button" role="tab" aria-controls="profile" aria-selected="false">Calificaciones Dadas como Propietario</button>
                    </li>
                </ul>

                <!--Primera pestaña -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="container">
                            <div class="row mt-5">
                                <div class="col-sm-4">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <p class="text-center">Calificaciones bajas</p>
                                            <p class="text-center"><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                                            <input type="text" class="text-center form-control bg-danger text-white" value="<?php echo $_REQUEST['cal1']?>">
                                        </div> 
                                    </div> 
                                </div>
                                <div class="col-sm-4">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <p class="text-center">Calificaciones medias</p>
                                            <p class="text-center"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                                            <input type="text" class="text-center form-control bg-success text-white" value="<?php echo $_REQUEST['cal2']?>">
                                        </div> 
                                    </div> 
                                </div>
                                <div class="col-sm-4">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <p class="text-center">Calificaciones altas</p>
                                            <p class="text-center"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                                            <input type="text" class="text-center form-control bg-primary text-white" value="<?php echo $_REQUEST['cal3']?>">
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--Segunda pestaña -->
                    <div class="tab-pane" id="cal_user" role="tabpanel" aria-labelledby="cal_user-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-muted mt-3">CALIFICACIONES COMO USUARIO</h4>
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Reserva #</th>
                                            <th>Fecha</th>
                                            <th>Propiedad</th>
                                            <th>Ubicación</th>
                                            <th><i class="fa-solid fa-thumbs-up"></i> Calificación</th>
                                        </tr>
                                    </thead>
                                    <tbody  id="tabla_cal_usuario">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--Tercera pestaña -->
                    <div class="tab-pane" id="cal_prop" role="tabpanel" aria-labelledby="cal_prop-tab">
                       <div class="row">
                           <div class="col-sm-12">
                               <h4 class="text-muted mt-3">CALIFICACIONES COMO PROPIETARIO</h4>
                               <table class="table table-responsive">
                                   <thead>
                                       <tr>
                                           <th>Reserva #</th>
                                           <th>Fecha</th>
                                           <th>Propiedad</th>
                                           <th>Ubicación</th>
                                           <th><i class="fa-solid fa-thumbs-up"></i> Calificación</th>
                                       </tr>
                                   </thead>
                                   <tbody  id="tabla_cal_propietario">
                                       
                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>

                </div>
            </div>
        </div>

        <!-- Ventana modal para mensajes emergentes -->
        <button data-bs-target="#exampleModal" data-bs-toggle="modal" id="btn_ventana_modal" type="button" hidden="hidden"></button>
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <img alt="logo" src="../img/logo.jpg" width="150" />
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <!--Aca pongo el mensaje para mostrar -->
                    <div class="modal-body" id="cuerpo">
                        <div class="modal-header">
                            <p>Seleccione su calificación con base a la experiencia recibida</p>
                        </div>
                        <div class="modal-body text-center">
                            <div class='starrr' id='star2'></div>
                            <br />
                            <input type='hidden' name='rating' value='0' id='star2_input' />
                            <div class="bg-primary mt-3 mb-3 text-white" id="div_cuerpo"></div>
                        </div> 

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal" type="button">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            var firstTabEl = document.querySelector('#myTab li:last-child a')
            var firstTab = new bootstrap.Tab(firstTabEl)
            firstTab.show()
        </script>
    </body>
</html>
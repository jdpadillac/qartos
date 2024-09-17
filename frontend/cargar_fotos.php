<!DOCTYPE html>
<html lang="en">
    <head>
      <title>qartos</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/png" href="../favicon.ico">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      -->
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" />
        
        <!--<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/piexif.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/sortable.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/fileinput.min.js"></script>
      
    </head>
    <body>
        
        <!--espacio para los campos con variables que utilizo -->
        <input type="hidden" id="id_propiedad" value="<?php echo $_REQUEST['id_propiedad']?>">


        <div class="jumbotron text-center bg-white">
          <img src="../img/logo.jpg" width="30%" class="img-fluid" alt="logo qartos" >
          <p>Imágenes de la propiedad!</p> 
        </div>

        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-4">
                                    <H4 class="panel-title">Propietario:<br> <?php echo $_REQUEST["nbre_propietario"]?></h4>
                                </div>
                                <div class="col-sm-4">
                                    <H4 class="panel-title">Ubicación:<br> <?php echo $_REQUEST["municipio"];?></h4>
                                </div>
                                <div class="col-sm-4">
                                    <p for="file-es" role="button">Imagenes preeseleccionadas de la propiedad No.:<br> <?php echo $_REQUEST["id_propiedad"];?></p>
                                </div>
                            </div>
                            <input id="archivos" name="imagenes[]" type="file" multiple=true class="file-loading img-fluid">
                            <input type='text' id='id_propiedad'  name='id_propiedad' value="<?php echo $_REQUEST["id_propiedad"];?>" hidden="hidden"/>
                            <SMALL class="form-text text-muted">Seleccione solo fotos de tipo *.jpg y *.png</SMALL>
                        </form>
                        <p>&nbsp;</p>
                        
                        <div class="alert alert-success" role="alert"></div>
                        <button type="submit" id="btn_cerrar_ventana" class="btn btn-primary right"> Cerrar Ventana </button>
                        
                    </div>
                </div>
            </div>
          </div>
        </div>

        <?php 	
            $directory = "../img/prop/".$_REQUEST["id_propiedad"]."/";
            $images = glob($directory . "*.*");
	?>
	
	<script>
            $("#btn_cerrar_ventana").click(function(evento){   //presiono click
                window.close();
            });
            
            $("#archivos").fileinput({
                language: 'es',
                uploadUrl: "../backend/upload_foto.php?id_propiedad=" + <?php echo $_REQUEST["id_propiedad"];?>, 
                uploadAsync: false,
                minFileCount: 1,
                maxFileCount: 20,
                showUpload: false, 
                //showRemove: true,
                removeFromPreviewOnError: true,
                initialPreview: [
                <?php foreach($images as $image){?>
                        "<img src='<?php echo $image; ?>' height='150px' class='file-preview-image img-fluid'>",
                <?php } ?>],
                    initialPreviewConfig: [<?php foreach($images as $image){ $infoImagenes=explode("/",$image);?>
                    {caption: "<?php echo $infoImagenes[4];?>",  height: "150px", url: "borrar_foto.php?id_propiedad="+ <?php echo $_REQUEST["id_propiedad"];?>, key:"<?php echo $image;?>"},
                    //{caption: "<?php echo $infoImagenes[1];?>",  height: "200px", url: "borrar.php", key:"<?php echo $infoImagenes[1];?>"},
                <?php } ?>]
            }).on("filebatchselected", function(event, files) {
                alert("Foro subida al servidor!");
                $("#archivos").fileinput("upload");
            });
	
	</script>
        
        
    </body>
</html>

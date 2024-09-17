<!DOCTYPE html>
<html lang="en">
    <head>
      <title>qartos.com.co</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link  rel="icon"   href="favicon.ico" type="image/png" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="../js/ampliar_info.js"></script>
      <script type="text/javascript" src="../js/typeahead.js"></script>
      
      <!-- Geo localización -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
      <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    
    <body>
        <input type="text" hidden id="id_arrendador_info" value="<?php echo $_REQUEST["id_arrendador"] ?>" >
      
        <div class="container">
          <div class="row">
              <div class="col-sm-4" id="columna"><br>
                    <div id='carrusel' class='carousel slide' data-ride='carousel'>
                        <ol class='carousel-indicators' id='listaOL'></ol>
                        <div class='carousel-inner' id='div_fotos'></div>
                    </div>
             </div>
           </div>
        </div>
    </body>
</html>
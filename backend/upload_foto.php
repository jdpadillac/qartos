<?php 
    require_once 'modelo.php';
    header("Content-Type: text/html;charset=utf-8");
    
    //$carpetaAdjunta="../img/solu/9/"; 
    $ruta = "../img/prop/".$_REQUEST['id_propiedad']."/";
    
    if(!file_exists($ruta)){
        @chdir("../img/prop/");
        @mkdir($_REQUEST['id_propiedad']);
        @chdir($_REQUEST['id_propiedad']);
        @chdir("..");
        @chdir("..");

        // Contar envían por el plugin
        $Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
        $infoImagenesSubidas = array();
        for($i = 0; $i < $Imagenes; $i++) {

            // El nombre y nombre temporal del archivo que vamos para adjuntar
            $nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
            $nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;

            $rutaArchivo=$ruta.$nombreArchivo;

            move_uploaded_file($nombreTemporal,$rutaArchivo);

            $infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"150px","url"=>"borrar_foto.php?id_propiedad=".$rutaArchivo,"key"=>$rutaArchivo);
            //$infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>"borrar.php?id_solucion=".$_REQUEST['id_solucion'],"key"=>$nombreArchivo);
            $ImagenesSubidas[$i]="<img  height='150px'  src='$rutaArchivo' class='file-preview-image'>";

            /*Actualizo el nombre de la foto*/
            $sql = "UPDATE propiedades SET Foto='".$nombreArchivo."' WHERE Id='".$_REQUEST['id_propiedad']."'";
            $resp  = grabar::grabar_registro($sql);
        }

        $arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
                                 "initialPreview"=>$ImagenesSubidas);
        echo json_encode($arr);
    
        
    }  else{
         // Contar envían por el plugin
           $Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
           $infoImagenesSubidas = array();
           for($i = 0; $i < $Imagenes; $i++) {

               // El nombre y nombre temporal del archivo que vamos para adjuntar
               $nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
               $nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;

               $rutaArchivo=$ruta.$nombreArchivo;

               move_uploaded_file($nombreTemporal,$rutaArchivo);

               $infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"150px","url"=>"borrar_foto.php?id_propiedad=".$rutaArchivo,"key"=>$rutaArchivo);
               //$infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>"borrar.php?id_solucion=".$_REQUEST['id_solucion'],"key"=>$nombreArchivo);
               $ImagenesSubidas[$i]="<img  height='150px'  src='$rutaArchivo' class='file-preview-image'>";


               /*Actualizo el nombre de la foto*/
               $sql = "UPDATE propiedades SET Foto='".$nombreArchivo."' WHERE Id='".$_REQUEST['id_propiedad']."'";
               $resp  = grabar::grabar_registro($sql);

            }

           $arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
                                    "initialPreview"=>$ImagenesSubidas);
           echo json_encode($arr);
    }
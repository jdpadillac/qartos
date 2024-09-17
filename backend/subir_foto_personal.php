<?php

    $id_perfil = $_POST['id'];
    $tipo      = "users";
    $respuestas="";
    $carpeta="..".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR.$tipo.DIRECTORY_SEPARATOR.$id_perfil;
    define('DIR_DESCARGAS',$carpeta);
    
    /*Se crea la carpeta de destino si no existe */
    if(!file_exists(DIR_DESCARGAS)){
        @chdir("..".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR.$tipo);
        if(!file_exists($id_perfil)){
            @mkdir($id_perfil);
            //@chdir($id_perfil);
            @chdir("..");
            @chdir("..");
            /*Coloco esto aqui por el tiempo que demora creando la carpeta*/
            if(!empty($_FILES['rutaFoto']['name'])){
                if(move_uploaded_file($_FILES['rutaFoto']['tmp_name'],$carpeta.DIRECTORY_SEPARATOR.$_FILES['rutaFoto']['name'])){
                    $respuestas='ok';
                }else{
                    $respuestas='No se pudo subir la imagen al servidor';
                }
            }else{
                $respuestas="No hay foto para subir";
            }
        }
        
    }else{
    
        if(!empty($_FILES['rutaFoto']['name'])){
            if(move_uploaded_file($_FILES['rutaFoto']['tmp_name'],$carpeta.DIRECTORY_SEPARATOR.$_FILES['rutaFoto']['name'])){
                $respuestas='ok';
            }else{
                $respuestas='Ocurrió un problemas';
            }
        }else{
            $respuestas="No hay nombre de foto para subir al servidor";
        }
    }

    

    // RESPUESTA DEVUELTA POR EL SCRIPT EN FORMATO JSON
    // **********************************************************************

    // Devolvemos el array asociativo en formato JSON como respuesta
    return json_encode($respuestas);
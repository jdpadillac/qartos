<?php 
    $ruta = "../img/prop/".$_REQUEST['id_propiedad']."/";
    //$carpeta="../img/solu/9/"; 

    //if($_SERVER['REQUEST_METHOD']==="DELETE"){
    if($_SERVER['REQUEST_METHOD']==="POST"){

        parse_str(file_get_contents("php://input"),$datosDELETE);

        $key= $datosDELETE['key'];

        if(unlink($key)===FALSE){
            unlink($ruta.$key);
        }
        echo 0;

    }

<?php
    header("Content-Type: text/html;charset=utf-8");
    
class consultas{
    
    public static function traer_json($sql){
        $host = "localhost"; $nbre_DB = "qartosco_db"; $usuario= "qartosco_root"; $password = "JdQa1972!2022";
        try{
            $dsn = "mysql:host=".$host.";dbname=".$nbre_DB;
            $pdo = new PDO($dsn, $usuario, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->query("SET NAMES 'utf8';");
            $rows = array(); $stmt = $pdo->prepare($sql);
            $stmt->execute(); $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){ echo "Ocurrio un ERROR al consultar: " . $e->getMessage();}  
        
        return json_encode($rows);
    }
    
    public static function actualizar_codigo_payu($solucion, $valor, $tabla){
        /*Busco si existe el valor asociado a un código*/
       $host = "localhost"; $nbre_DB = "qartosco_db"; $usuario= "qartosco_root"; $password = "JdQa1972!2022";
        try{
            $sql="SELECT Codigo FROM payu WHERE Valor ='".$valor."'";
            $dsn = "mysql:host=".$host.";dbname=".$nbre_DB; $pdo = new PDO($dsn, $usuario, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->query("SET NAMES 'utf8';");
            $rows = array(); $stmt = $pdo->prepare($sql);
            $stmt->execute(); $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $cant=sizeof($rows);
            if($cant>0 && ($res=$rows[0]['Codigo'])!==null){
                /*Actualizo el código en la habitación*/
                $sql="UPDATE ".$tabla." SET Ref_Payu='".$res."' WHERE Id='".$solucion."'";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
            }
        }catch(PDOException $e){ echo "Ocurrio un en buscas_reservas_huesped: " . $e->getMessage();}  
        return $res;
    }
   
}


class modificar{
    public static function modificar_datos($sql){
        $host = "localhost"; $nbre_DB = "qartosco_db"; $usuario= "qartosco_root"; $password = "JdQa1972!2022";
        $resp="Datos actualizados";
        try{
            $dsn = "mysql:host=".$host.";dbname=".$nbre_DB;
            $pdo = new PDO($dsn, $usuario, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->query("SET NAMES 'utf8';");
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){ $resp="Ocurrio un ERROR: " . $e->getMessage(); }   
        return $resp;
        
        
    }
    
}




class grabar{    
       
    public static function grabar_registro($sql){
        $host = "localhost"; $nbre_DB = "qartosco_db"; $usuario= "qartosco_root"; $password = "JdQa1972!2022";
        $last_id="0";   //Id del último registro grabado
        try{
            $dsn = "mysql:host=".$host.";dbname=".$nbre_DB;
            $pdo = new PDO($dsn, $usuario, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $last_id = $pdo->lastInsertId();
        }catch(PDOException $e){ $last_id="Ocurrio un ERROR: " . $e->getMessage(); }  
        return $last_id;
    }
    
}

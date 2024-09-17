<?php
    
    require_once 'modelo.php';
    header("Content-Type: text/html;charset=utf-8");
    $llamador= $_POST['llamador'];      //Contiene la pantalla que llama
    $resp="No se pudo realizar la conexión a la DB";
    
   if($llamador=="autenticar"){
        $usuario= $_POST['usuario'];
        $clave = $_POST['clave'];
        $sql="SELECT Id, CONCAT(Nbres, ' ', Apellidos) AS Nbre FROM user_system ".
             " WHERE Correo='".$usuario."' AND AES_DECRYPT(Clave,'JdQa1972!2022')='".$clave."' AND Activo=1 LIMIT 1";
        $resp= consultas::traer_json($sql);
    
    }else if($llamador=="cargar_mensajes"){
        $campo= $_POST['campo']; 
        $orden= $_POST['orden']; 
        $sql ="SELECT Id, Nbre, Correo, Asunto, Contestado, Fecha_Reg, Fecha_Contestado
                FROM contactenos ORDER BY ".$campo.$orden;
        $resp = consultas::traer_json($sql);
          
    }else if($llamador=="load_dash"){
        $table = $_POST['table']; 
        $month = $_POST['month']; 
        $year  = $_POST['year']; 
        $hoy   = getdate();
        $sql   ="SELECT COUNT(Id) AS Cant
                FROM ".$table;
        if($month!==null && $month!==""){
            $sql=$sql." WHERE MONTH(Fecha_Reg) =".$month.
                " AND YEAR(Fecha_Reg) = ".$year;
        }
        $resp = consultas::traer_json($sql);

    }else if($llamador=="load_dash_user"){
        $usuario =$_POST['user'];
        $month = $_POST['month']; 
        $year  = $_POST['year']; 
        $hoy   = getdate();
        $sql   ="SELECT COUNT(Id) AS Cant
                FROM usuarios  WHERE ";
        if($usuario==="1"){         //Consulta de usuarios
            $sql=$sql." Usuario = 1 ";
        }else{                      //Consulta de propietarios
            $sql=$sql." Propietario = 1 ";
        }
        
        if($month!==null && $month!==""){
            $sql=$sql." AND MONTH(Fecha_Reg) =".$month.
                " AND YEAR(Fecha_Reg) = ".$year;
        }
        $resp = consultas::traer_json($sql);
          
   }else if($llamador=="listado_propietarios"){
       $campo= $_POST['campo']; 
       $orden= $_POST['orden']; 
        $sql ="SELECT
            usuarios.Id
            , CONCAT(usuarios.Nbres, ' ', usuarios.Apellidos) AS Nbres
            , CONCAT(paises.Nbre, ' ', dptos.Nbre, ' ', municipios.Nbre) AS Municipio
            , usuarios.Direccion
            , usuarios.Telefono
            , usuarios.Correo
            , usuarios.Activo
            , usuarios.Calificacion1
            , usuarios.Calificacion2
            , usuarios.Calificacion3
            , usuarios.Fecha_Reg
        FROM usuarios
            INNER JOIN municipios ON (usuarios.Municipio = municipios.Id)
            INNER JOIN dptos ON (dptos.Id = municipios.Dpto)
            INNER JOIN paises ON (dptos.Pais = paises.Id)
            ORDER BY ".$campo.$orden;
        $resp = consultas::traer_json($sql);
          
   }else if($llamador=="listado_usuarios"){
       $campo= $_POST['campo']; 
       $orden= $_POST['orden']; 
        $sql ="SELECT
            usuarios.Id
            , CONCAT(usuarios.Nbres, ' ', usuarios.Apellidos) AS Nbres
            , CONCAT(municipios.Nbre, ' ', dptos.Nbre, ' ', paises.Nbre) AS Municipio
            , usuarios.Telefono
            , usuarios.Correo
            , usuarios.Activo
            , usuarios.Calificacion1
            , usuarios.Calificacion2
            , usuarios.Calificacion3
            , usuarios.Fecha_Reg
        FROM usuarios
            INNER JOIN municipios ON (usuarios.Municipio = municipios.Id)
            INNER JOIN dptos ON (municipios.Dpto = dptos.Id)
            INNER JOIN paises ON (dptos.Pais = paises.Id)
            ORDER BY ".$campo.$orden;
        $resp = consultas::traer_json($sql);
          
   }else if($llamador=="listado_propiedades"){
       $campo= $_POST['campo']; 
       $orden= $_POST['orden']; 
        $sql ="SELECT
            propiedades.Id
            , CONCAT(usuarios.Nbres, ' ', usuarios.Apellidos) AS Propietario
            , CONCAT(municipios.Nbre, ' ', dptos.Nbre, ' ', paises.Nbre) AS Municipio
            , propiedades.Direccion
            , propiedades.Telefono
            , propiedades.Fecha_Ini_Disp
            , propiedades.Fecha_Fin_Disp
            , propiedades.Valor
            , tipo_propiedad.Nbre AS Tipo_Propiedad
            , propiedades.Activo
            , propiedades.Fecha_Reg
        FROM propiedades
            INNER JOIN usuarios ON (propiedades.Propietario = usuarios.Id)
            INNER JOIN tipo_propiedad ON (propiedades.Tipo = tipo_propiedad.Id)
            INNER JOIN municipios ON (usuarios.Municipio = municipios.Id)
            INNER JOIN dptos ON (municipios.Dpto = dptos.Id)
            INNER JOIN paises ON (dptos.Pais = paises.Id)
            ORDER BY ".$campo.$orden;
        $resp = consultas::traer_json($sql);
          
   }else if($llamador=="listado_reservas"){
       $campo= $_POST['campo']; 
       $orden= $_POST['orden']; 
        $sql ="SELECT
            reservas.Id
            , reservas.Fecha_Ini
            , reservas.Fecha_Fin
            , CONCAT(usuarios.Nbres, ' ', usuarios.Apellidos) AS Usuario
            , CONCAT(tipo_propiedad.Nbre, ' ', reservas.Id_Propiedad) AS Propiedad
            , reservas.Valor
            , reservas.Referencia_Pago
            , reservas.Fecha_Pago
            , reservas.Cal_Del_Propietario
            , reservas.Cal_Del_Usuario
            , reservas.Fecha_Autorizado
            , reservas.Fecha_Cancelacion
            , reservas.Fecha_Reg
        FROM reservas
            INNER JOIN usuarios ON (reservas.Id_Cliente = usuarios.Id)
            INNER JOIN propiedades ON (reservas.Id_Propiedad = propiedades.Id)
            INNER JOIN tipo_propiedad ON (propiedades.Tipo_Propiedad = tipo_propiedad.Id)
            ORDER BY ".$campo.$orden;
        $resp = consultas::traer_json($sql);
          
    }
    echo $resp;
    return $resp;
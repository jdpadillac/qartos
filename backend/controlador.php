<?php
    
    require_once 'modelo.php';
    header("Content-Type: text/html;charset=utf-8");
    $llamador= $_POST['llamador'];      //Contiene la pantalla que llama
    $resp="No se pudo realizar la conexión a la DB";
    
    /***** FUNCIONES VALIDADAS PARA LA VERSION 2*****/
    if($llamador=="actualizar_nbre_foto1"){        //actualizo el nombre de la primera foto
        $id   = $_POST['id'];
        $foto = $_POST['foto'];
        $sql = "UPDATE soluciones SET Foto='".$foto 
                ."' WHERE Id='".$id."'";
        $resp  = grabar::grabar_registro($sql);
    
    }else if($llamador=="actualizar_foto_usuario"){
        $id   = $_POST['id_usuario'];
        $foto = $_POST['foto'];
        $sql="UPDATE usuarios SET Foto='".$foto."' WHERE Id=".$id;
        $resp = modificar::modificar_datos($sql);
        
    }else if($llamador=="buscar_miembro"){
        $cedula = $_POST['cedula'];
        $sql ="SELECT Id, CONCAT(Nbre1, ' ', Nbre2, ' ', Apellido1, ' ', Apellido2) AS Nbre
                FROM miembros
                WHERE Documento='".$cedula."'";
             
        $resp = consultas::traer_json($sql);
        
    }else if($llamador=="buscar_propiedades_fecha"){
        echo(" entro a consultar: buscar_propiedades_fecha");
        /*Pantalla de consulta de habitaciones segun fecha*/
        $servicio_buscado    = $_POST['servicio_buscado'];
        $fecha_ini= $_POST['fecha_ini'];
        $fecha_fin= $_POST['fecha_fin'];
        $municipio= $_POST['id_municipio'];
        $sql="SELECT propiedades.Id, 
            tipo_propiedad.Nbre AS Tipo_Propiedad, 
            propiedades.Tipo, 
            propiedades.Foto, 
            propiedades.Ref_Payu, 
            FORMAT(propiedades.Valor,0) AS Valor, 
            propiedades.Observacion, 
            propiedades.Activo, 
            paises.Id AS Id_Pais, 
            paises.Cod_Moneda,
            dptos.Id AS Id_Dpto, 
            municipios.Id As Id_Municipio, 
            municipios.Nbre AS Nbre_Municipio, 
            CONCAT(usuarios.Nbres, ' ', usuarios.Apellidos) AS Nbre_Propietario, 
            usuarios.Id As Id_Propietario,
            usuarios.Correo, 
            propiedades.Sala, 
            propiedades.Comedor, 
            propiedades.Cocina,
            propiedades.No_Banios, propiedades.No_Habitaciones, propiedades.Hab_Ppal_Banio, propiedades.Hab_Ppal_Aire,
            propiedades.Patio, propiedades.No_Pisos, propiedades.No_Piso, propiedades.Garage, propiedades.Conjunto_Cerrado,
            propiedades.Conjunto_Abierto, propiedades.Piscina, propiedades.Turco, propiedades.Sauna, propiedades.Balcon,
            propiedades.Amoblada, propiedades.Kiosko, propiedades.Bar, propiedades.Aire, propiedades.Calefaccion, 
            propiedades.Sotano, propiedades.Atico, propiedades.Caja_Fuerte, propiedades.Cuarto_Labores, propiedades.Wifi,
            propiedades.Taxi, propiedades.Auto_Particular, propiedades.Moto_Taxi, propiedades.Calificacion1, 
            propiedades.Calificacion2, propiedades.Calificacion3, propiedades.Ref_Payu, propiedades.Requiere_Autorizacion
            FROM propiedades
                INNER JOIN municipios  ON (propiedades.Municipio = municipios.Id)
                INNER JOIN dptos  ON (municipios.Dpto = dptos.Id)
                INNER JOIN paises  ON (dptos.Pais = paises.Id)
                INNER JOIN usuarios ON (propiedades.Propietario = usuarios.Id)
                INNER JOIN tipo_propiedad ON (propiedades.Tipo = tipo_propiedad.Id)
            WHERE (propiedades.Activo =1 
                 AND propiedades.Activo =1 ";
                 
                 if($servicio_buscado=="ARRIENDO"){
                     $sql=$sql." AND (propiedades.Arrendar = 1 ";
                  
                     if($servicio_buscado=="COMPRA"){
                        $sql=$sql." OR propiedades.Vender = 1 ";
                     }
                    if($servicio_buscado=="ALOJAMIENTO"){
                        $sql=$sql." OR propiedades.Alojar = 1 ";
                    }
                    if($servicio_buscado=="SUBASTA"){
                        $sql=$sql." OR propiedades.Subastar = 1 ";
                    }
                    
                 }else  if($servicio_buscado=="COMPRA"){
                     $sql=$sql." AND (propiedades.Vender = 1 ";
                     
                    if($servicio_buscado=="ALOJAMIENTO"){
                        $sql=$sql." OR propiedades.Alojar = 1 ";
                    }
                    if($servicio_buscado=="SUBASTA"){
                        $sql=$sql." OR propiedades.Subastar = 1 ";
                    }
                    
                 }else  if($servicio_buscado=="ALOJAMIENTO"){
                     $sql=$sql." AND (propiedades.Alojar = 1 ";
                     
                    if($servicio_buscado=="SUBASTA"){
                        $sql=$sql." OR propiedades.Subastar = 1 ";
                    }
                    
                 }else  if($servicio_buscado=="SUBASTA"){
                     $sql=$sql." AND (propiedades.Subastar = 1 ";
                 }
                 
                 $sql=$sql.") AND (((propiedades.Fecha_Ini_Disp)='0000-00-00'
                 OR    (propiedades.Fecha_Ini_Disp) <='".$fecha_ini."')
                 AND ( (propiedades.Fecha_Fin_Disp)='0000-00-00'
                 OR    (propiedades.Fecha_Fin_Disp) >='".$fecha_fin."')
                 AND propiedades.Municipio='".$municipio."')) ORDER BY propiedades.Id DESC";
             
        echo $sql;
        $resp = consultas::traer_json($sql);
        
   
    }else if($llamador=="calificar"){
        $reserva = $_POST['reserva'];
        $campo   = $_POST['campo'];
        $cal     = $_POST['cal'];
        $sql     ="UPDATE reservas SET ".$campo."=".$cal.
                  " WHERE Id=".$reserva;
        $resp = modificar::modificar_datos($sql);
        
    }else if($llamador=="cargar_combo"){
        $tabla = $_POST['tabla'];
        $sql="SELECT Id, Nbre FROM ".$tabla." WHERE Activo=1 ORDER BY Nbre ASC";
        $resp = consultas::traer_json($sql);
           
    }else if($llamador=="cargar_destacados"){
        $servicio_buscado = $_POST['servicio_buscado'];
        $hoy              = date('y/m/d g:ia'); 
        
        $sql="SELECT propiedades.Id, 
            tipo_propiedad.Nbre AS Tipo_Propiedad,
            tipo_propiedad.Id AS Id_Tipo_propiedad,
            propiedades.Foto, 
            FORMAT(propiedades.Valor,0) AS Valor,
            municipios.Nbre AS Nbre_Municipio, 
            propiedades.Taxi, 
            propiedades.Auto_Particular, 
            propiedades.Moto_Taxi, 
            propiedades.Calificacion1, 
            propiedades.Calificacion2, 
            propiedades.Calificacion3,
            propiedades.Geo1,
            propiedades.Geo2,
            propiedades.Ref_Payu,
            propiedades.Requiere_Autorizacion,
            paises.Cod_Moneda, 
            paises.Simbolo,
            paises.Id AS Id_Pais,
            dptos.Id AS Id_Dpto,
            municipios.Id AS Id_Municipio,
            usuarios.Id AS Id_Propietario,
            usuarios.Correo,
            CONCAT(usuarios.Nbres, ' ', usuarios.Apellidos) AS Nbre_Propietario
            FROM propiedades
                INNER JOIN municipios  ON (propiedades.Municipio = municipios.Id)
                INNER JOIN dptos  ON (municipios.Dpto = dptos.Id)
                INNER JOIN paises  ON (dptos.Pais = paises.Id)
                INNER JOIN usuarios ON (propiedades.Propietario = usuarios.Id)
                INNER JOIN tipo_propiedad ON (propiedades.Tipo = tipo_propiedad.Id)
            WHERE propiedades.Activo =1 
                 AND propiedades.Disponible =1 ";
                 
                 if($servicio_buscado==="ARRIENDO"){
                     $sql=$sql." AND (propiedades.Arrendar = 1 ";
                  
                     if($servicio_buscado==="COMPRA"){
                        $sql=$sql." OR propiedades.Vender = 1 ";
                     }
                    if($servicio_buscado==="ALOJAMIENTO"){
                        $sql=$sql." OR propiedades.Alojar = 1 ";
                    }
                    if($servicio_buscado==="SUBASTA"){
                        $sql=$sql." OR propiedades.Subastar = 1 ";
                    }
                    
                 }else  if($servicio_buscado==="COMPRA"){
                     $sql=$sql." AND (propiedades.Vender = 1 ";
                     
                    if($servicio_buscado==="ALOJAMIENTO"){
                        $sql=$sql." OR propiedades.Alojar = 1 ";
                    }
                    if($servicio_buscado==="SUBASTA"){
                        $sql=$sql." OR propiedades.Subastar = 1 ";
                    }
                    
                 }else  if($servicio_buscado==="ALOJAMIENTO"){
                     $sql=$sql." AND (propiedades.Alojar = 1 ";
                     
                    if($servicio_buscado==="SUBASTA"){
                        $sql=$sql." OR propiedades.Subastar = 1 ";
                    }
                    
                 }else  if($servicio_buscado==="SUBASTA"){
                     $sql=$sql." AND (propiedades.Subastar = 1 ";
                 }
                 
                 $sql=$sql.") AND (((propiedades.Fecha_Ini_Disp)='0000-00-00'
                 OR    (propiedades.Fecha_Ini_Disp) <='". $hoy ."')
                 AND ( (propiedades.Fecha_Fin_Disp)='0000-00-00'
                 OR    (propiedades.Fecha_Fin_Disp) >='".$hoy."'))
                 ORDER BY propiedades.Id DESC LIMIT 3";
             
        $resp = consultas::traer_json($sql);
        

    }else if($llamador=="cargar_nuevas_soluciones"){
         $hoy = date('y/m/d g:ia'); 
        $sql="SELECT soluciones.Id, tipo_solucion.Nbre AS Tipo_Solucion, soluciones.Arrendador, 
            soluciones.Tipo, soluciones.Carpeta, soluciones.Foto, 
            soluciones.Ref_Payu, FORMAT(soluciones.Valor,0) AS Valor, soluciones.Observacion, 
            soluciones.Activo, paises.Id AS Id_Pais, dptos.Id AS Id_Dpto, 
            municipios.Id As Id_Municipio, municipios.Nbre AS Nbre_Municipio, 
            CONCAT(arrendadores.Nbres, ' ', arrendadores.Apellidos) AS Nbre_Arrendador,
            arrendadores.Correo, soluciones.Sala, soluciones.Comedor, soluciones.Cocina,
            soluciones.No_Banios, soluciones.No_Habitaciones, soluciones.Hab_Ppal_Banio, soluciones.Hab_Ppal_Aire,
            soluciones.Patio, soluciones.No_Pisos, soluciones.No_Piso, soluciones.Garage, soluciones.Conjunto_Cerrado,
            soluciones.Conjunto_Abierto, soluciones.Piscina, soluciones.Turco, soluciones.Sauna, soluciones.Balcon,
            soluciones.Amoblada, soluciones.Kiosko, soluciones.Bar, soluciones.Aire, soluciones.Calefaccion, 
            soluciones.Sotano, soluciones.Atico, soluciones.Caja_Fuerte, soluciones.Cuarto_Labores, soluciones.Wifi,
            soluciones.Taxi, soluciones.Auto_Particular, soluciones.Moto_Taxi, soluciones.Calificacion1, 
            soluciones.Calificacion2, soluciones.Calificacion3, soluciones.Ref_Payu, soluciones.Requiere_Autorizacion,
            paises.Cod_Moneda, paises.Simbolo
            FROM soluciones
                INNER JOIN municipios  ON (soluciones.Municipio = municipios.Id)
                INNER JOIN dptos  ON (municipios.Dpto = dptos.Id)
                INNER JOIN paises  ON (dptos.Pais = paises.Id)
                INNER JOIN arrendadores ON (soluciones.Arrendador = arrendadores.Id)
                INNER JOIN tipo_solucion ON (soluciones.Tipo = tipo_solucion.Id)
            WHERE (soluciones.Activo =1 
                 AND soluciones.Disponible =1
                 AND ((DATE(soluciones.Fecha_Ini_Disp)='0000-00-00'
                 OR    DATE(soluciones.Fecha_Ini_Disp) <='". $hoy ."')
                 AND ( DATE(soluciones.Fecha_Fin_Disp)='0000-00-00'
                 OR    DATE(soluciones.Fecha_Fin_Disp) >='".$hoy."')))
                 LIMIT 3";
             
        $resp = consultas::traer_json($sql);
    

    }else if($llamador=="consultar_existencia_correo"){         /*Pantalla de consulta si existe un cliente o arrendador con el correo*/
        $correo = $_POST['correo'];
        $sql="SELECT Id FROM usuarios WHERE Correo ='".$correo."' LIMIT 1";
    
        $resp = consultas::traer_json($sql);
     
    
    }else if($llamador=="consultar_propiedades"){
        /*Pantalla de consulta de soluciones de un arrendador*/
        $id_propietario= $_POST['id_propietario'];
        $sql="SELECT propiedades.Id, tipo_propiedad.Id AS Id_Tipo_Propiedad, tipo_propiedad.Nbre AS Tipo_Propiedad,
                paises.Nbre AS Pais, dptos.Nbre AS Dpto, municipios.Nbre AS Municipio, propiedades.Direccion,
                propiedades.Fecha_Ini_Disp, propiedades.Fecha_Fin_Disp, FORMAT(propiedades.Valor,0) AS Valor, 
                propiedades.Observacion, propiedades.Activo, paises.Id AS Id_Pais, 
                dptos.Id AS Id_Dpto, municipios.Id As Id_Municipio, propiedades.Sala,
                propiedades.No_Banios, propiedades.No_Habitaciones, propiedades.No_Pisos, propiedades.No_Piso, 
                propiedades.Cocina, propiedades.Hab_Ppal_Banio, 
                propiedades.Hab_Ppal_Aire, propiedades.Patio, propiedades.Garage, 
                propiedades.Conjunto_Cerrado, propiedades.Conjunto_Abierto, 
                propiedades.Piscina, propiedades.Turco, propiedades.Sauna, propiedades.Balcon,
                propiedades.Amoblada, propiedades.Kiosko, propiedades.Bar, propiedades.Aire,
                propiedades.Calefaccion, propiedades.Sotano, propiedades.Atico, propiedades.Caja_Fuerte, 
                propiedades.Wifi, propiedades.Taxi, propiedades.Auto_Particular, propiedades.Moto_Taxi,
                propiedades.Requiere_Autorizacion, propiedades.Observacion, propiedades.Foto,
                propiedades.Activo
            FROM propiedades 
                INNER JOIN municipios  ON (propiedades.Municipio = municipios.Id)
                INNER JOIN dptos  ON (municipios.Dpto = dptos.Id)
                INNER JOIN paises  ON (dptos.Pais = paises.Id)
                INNER JOIN tipo_propiedad  ON (propiedades.Tipo = tipo_propiedad.Id)
            WHERE (propiedades.Propietario =".$id_propietario.") ORDER BY propiedades.Id DESC";
        $resp = consultas::traer_json($sql);

       
   
    }else if($llamador=="cargar_medios_pago"){
        $id_pais= $_POST['id_pais'];
        $sql="SELECT Id, Nbre, Activo FROM medios_pago WHERE Pais ='".$id_pais."'";
        $resp = consultas::traer_json($sql);

   
    }else if($llamador=="consultar_datos_usuario"){
        $id_usuario= $_POST['id_usuario'];
        $sql="SELECT CONCAT(usuarios.Nbres, ' ', usuarios.Apellidos) AS Nbre
            , paises.Id AS Id_Pais
            , paises.Nbre AS Pais
            , dptos.Id AS Id_Dpto
            , dptos.Nbre AS Dpto
            , municipios.Id AS Id_Municipio
            , municipios.Nbre AS Municipio
            , usuarios.Direccion
            , usuarios.Telefono
            , usuarios.Correo
            , usuarios.Cta_Nbre
            , usuarios.Cta_Tipo
            , usuarios.Cta_Numero
            , usuarios.Cta_Banco
            , usuarios.Foto
        FROM usuarios
	        INNER JOIN municipios ON (usuarios.Municipio = municipios.Id)
	        INNER JOIN dptos ON (municipios.Dpto = dptos.Id)
            INNER JOIN paises ON (dptos.Pais = paises.Id)
        WHERE usuarios.Id ='".$id_usuario."'";
        $resp = consultas::traer_json($sql);

   
   
     
    }else if($llamador=="grabar_contactenos"){
        /*Pantalla para grabar contactenos*/
        $nbre   = $_POST['nbre'];
        $celular= $_POST['celular'];
        $correo = $_POST['correo'];
        $asunto = $_POST['msg'];
        $hoy    = date('y/m/d g:ia'); 
        $sql    = "INSERT INTO contactenos(Nbre, Celular, Correo, Asunto, Fecha_Reg) VALUES('"
                .$nbre."','"
                .$celular."','"
                .$correo."','"
                .$asunto."','"
                .$hoy."')";
        $resp  = grabar::grabar_registro($sql);
     
    }else if($llamador=="grabar_propiedad"){
        date_default_timezone_set('America/Bogota'); 
        $hoy = date('y/m/d g:ia'); 
        $id_propietario= $_POST['id_propietario'];
        $tipo_propiedad= $_POST['tipo_propiedad'];
        $municipio= $_POST['municipio'];
        $direccion= $_POST['direccion'];
        $geo1= $_POST['geo1'];
        $geo2= $_POST['geo2'];
        $arrendar=$_POST['arrendar'];
        $vender=$_POST['vender'];
        $alojar=$_POST['alojar'];
        $subastar=$_POST['subastar'];
        $telefono= $_POST['telefono'];
        $fechaIni= $_POST['fechaIni'];
        $fechaFin= $_POST['fechaFin'];
        $valor= $_POST['valor'];
        $autorizacion= $_POST['autorizacion'];
        $no_banios= $_POST['no_banios'];
        $no_habitaciones= $_POST['no_habitaciones'];
        $no_pisos= $_POST['no_pisos'];
        $no_piso= $_POST['no_piso'];
        $observacion= $_POST['observacion'];
        $sala= $_POST['sala'];
        $cocina= $_POST['cocina'];
        $hab_ppal_aire= $_POST['hab_ppal_aire'];
        $hab_ppal_banio= $_POST['hab_ppal_banio'];
        $amoblada= $_POST['amoblada'];
        $kiosko= $_POST['kiosko'];
        $bar=$_POST["bar"];
        $aire=$_POST["aire"];
        $patio=$_POST["patio"];
        $garage=$_POST["garage"];
        $conjunto_cerrado=$_POST["conjunto_cerrado"];
        $conjunto_abierto=$_POST["conjunto_abierto"];
        $calefaccion=$_POST["calefaccion"];
        $sotano=$_POST["sotano"];
        $atico=$_POST["atico"];
        $caja_fuerte=$_POST["caja_fuerte"];
        $piscina=$_POST["piscina"];
        $turco=$_POST["turco"];
        $sauna=$_POST["sauna"];
        $balcon=$_POST["balcon"];
        $cuarto_labores=$_POST["cuarto_labores"];
        $wifi=$_POST["wifi"];
        $taxi=$_POST["taxi"];
        $auto_particular=$_POST["auto_particular"];
        $moto_taxi=$_POST["moto_taxi"];
        $sql="INSERT INTO propiedades(Propietario, Tipo_Propiedad, Municipio, Direccion, Telefono, Geo1, Geo2, "
                ."Arrendar, Vender, Alojar, Subastar, Fecha_Ini_Disp, "
                ."Fecha_Fin_Disp,Valor,Tipo,Sala,Cocina,No_Banios,No_Habitaciones,Hab_Ppal_Banio,"
                ."Hab_Ppal_Aire,Patio,No_Pisos,No_Piso, Garage, Conjunto_Cerrado, Conjunto_Abierto, Piscina, "
                ."Turco, Sauna, Balcon,Amoblada,Kiosko, Bar, Aire,Calefaccion, Sotano, Atico, Caja_Fuerte, "
                ."Cuarto_Labores, Wifi,Taxi,Auto_Particular,Moto_Taxi,Observacion,Requiere_Autorizacion, "
                ."Fecha_Reg) VALUES('"
                .$id_propietario."','"
                .$tipo_propiedad."','"
                .$municipio."','".$direccion."','".$telefono."','".$geo1."','".$geo2."',"
                .$arrendar.",".$vender.",".$alojar.",".$subastar.",'"
                .$fechaIni."','".$fechaFin."','".$valor."',".$tipo_propiedad.",".$sala.","
                .$cocina.",".$no_banios.",".$no_habitaciones.",".$hab_ppal_banio.",".$hab_ppal_aire.","
                .$patio.",".$no_pisos.",".$no_piso.",".$garage.",".$conjunto_cerrado.","
                .$conjunto_abierto.",".$piscina.",".$turco.",".$sauna.",".$balcon.","
                .$amoblada.",".$kiosko.",".$bar.",".$aire.",".$calefaccion.","
                .$sotano.",".$atico.",".$caja_fuerte.",".$cuarto_labores.","
                .$wifi.",".$taxi.",".$auto_particular.",".$moto_taxi.",'".$observacion."','"
                .$autorizacion."','".$hoy."')";
        $resp=grabar::grabar_registro($sql);
    

     }else if($llamador=="grabar_usuario"){
        $nbres     = $_POST['nbres'];
        $apellidos = $_POST['apellidos'];
        $municipio = $_POST['municipio'];
        $correo    = $_POST['correo'];
        $clave     = $_POST['clave'];
        $hoy    = date('y/m/d g:ia'); 
        $sql    = "INSERT INTO usuarios(Nbres, Apellidos, Municipio, Correo, Clave, Fecha_Reg) VALUES('"
                .$nbres."','"
                .$apellidos."','"
                .$municipio."','"
                .$correo."',"
                ."AES_ENCRYPT('".$clave."','JdQa1972!'),'"
                .$hoy."')";
        $resp  = grabar::grabar_registro($sql);
        
    
    }else if($llamador=="listar_calificaciones_realizadas_como_usuario"){
        $id_usuario= $_POST['id_usuario'];
        $sql="SELECT
                reservas.Id,
                reservas.Fecha_ini AS Fecha
                , tipo_propiedad.Nbre AS Propiedad
                , municipios.Nbre   AS Municipio
                , reservas.Cal_Del_Usuario
            FROM reservas
                INNER JOIN propiedades  ON (reservas.Id_Propiedad = propiedades.Id)
                INNER JOIN tipo_propiedad  ON (propiedades.Tipo = tipo_propiedad.Id)
                INNER JOIN municipios  ON (propiedades.Municipio = municipios.Id)
            WHERE reservas.Id_Cliente ='".$id_usuario."' ORDER BY reservas.Fecha_ini DESC";
        $resp = consultas::traer_json($sql);

    }else if($llamador=="listar_calificaciones_realizadas_como_propietario"){
        $id_usuario= $_POST['id_usuario'];
        $sql="SELECT
                reservas.Id,
                reservas.Fecha_ini AS Fecha
                , tipo_propiedad.Nbre AS Propiedad
                , municipios.Nbre   AS Municipio
                , reservas.Cal_Del_Propietario
            FROM reservas
                INNER JOIN propiedades  ON (reservas.Id_Propiedad = propiedades.Id)
                INNER JOIN tipo_propiedad  ON (propiedades.Tipo = tipo_propiedad.Id)
                INNER JOIN municipios  ON (propiedades.Municipio = municipios.Id)
            WHERE propiedades.Propietario ='".$id_usuario."' ORDER BY reservas.Fecha_ini DESC";
        $resp = consultas::traer_json($sql);

    }else if($llamador=="listar_acumulado_calificaciones"){
        $id_usuario= $_POST['id_usuario'];
        $sql="SELECT Calificacion1, Calificacion2, Calificacion3
            FROM usuarios
        WHERE Id ='".$id_usuario."'";
        $resp = consultas::traer_json($sql);

     
        
     }else if($llamador=="modificar_clave"){
        $id     = $_POST['id_usuario'];
        $clave  = $_POST['clave'];
        $sql    ="UPDATE usuarios SET Activo = 1,
                    Clave =AES_ENCRYPT('".$clave."','JdQa1972!')
                    WHERE Id='".$id."'";
        $resp = modificar::modificar_datos($sql);
       

    }else if($llamador=="modificar_clave_recuperar"){
        $correo = $_POST['correo'];
        $clave  = $_POST['clave'];
        $sql    ="UPDATE usuarios SET Activo = 1,
                    Clave =AES_ENCRYPT('".$clave."','JdQa1972!')
                    WHERE Correo='".$correo."'";
        $resp = modificar::modificar_datos($sql);
       

    }else if($llamador=="modificar_usuario"){
        /*Modifica datos de contacto del arrendador*/
        $id         = $_POST['id_usuario'];
        $municipio  = $_POST['municipio'];
        $direccion  = $_POST['direccion'];
        $telefono   = $_POST['telefono'];
        $correo     = $_POST['correo'];
        $clave      = $_POST['clave'];
        $cta_nbre   = $_POST['cta_nbre'];
        $cta_tipo   = $_POST['cta_tipo'];
        $cta_numero = $_POST['cta_numero'];
        $cta_banco  = $_POST['cta_banco'];
        
        if($municipio!==null or $direccion!==null or $telefono!==null or $correo!==null or $clave!==null){
            $sql="UPDATE usuarios SET Activo = 1 ";
            if($municipio!=="" && $municipio!==null){
                $sql=$sql.", Municipio='".$municipio."'";
            }
            if($direccion!=="" && $direccion!==null){
                $sql=$sql.", Direccion ='".$direccion."'";
            }
            if($telefono!=="" && $telefono!==null){
                $sql=$sql.", Telefono='".$telefono."'";
            }
            if($correo!=="" && $correo!==null){
                $sql=$sql.", Correo='".$correo."'";
            }
            if($clave!=="" && $clave!==null){
                $sql=$sql.", Clave =AES_ENCRYPT('".$clave."','JdQa1972!')";
            }
            if($cta_nbre!=="" && $cta_nbre!==null){
                $sql=$sql.", Cta_Nbre='".$cta_nbre."'";
            }
            if($cta_tipo!=="" && $cta_tipo!==null){
                $sql=$sql.", Cta_Tipo='".$cta_tipo."'";
            }
            if($cta_numero!=="" && $cta_numero!==null){
                $sql=$sql.", Cta_Numero='".$cta_numero."'";
            }
            if($cta_banco!=="" && $cta_banco!==null){
                $sql=$sql.", Cta_Banco=".$cta_banco;
            }
            $sql=$sql." WHERE Id=".$id;
            $resp = modificar::modificar_datos($sql);
        }
        
         
     }else if($llamador=="mostrar_propiedad"){
        $id= $_POST['id'];
        $sql="SELECT propiedades.Id, tipo_propiedad.Nbre AS Tipo_Propiedad, propiedades.Propietario, 
            propiedades.Tipo, propiedades.Foto, propiedades.Geo1, propiedades.Geo2,
            propiedades.Ref_Payu, FORMAT(propiedades.Valor,0) AS Valor, propiedades.Observacion, 
            propiedades.Activo, paises.Id AS Id_Pais, dptos.Id AS Id_Dpto, 
            municipios.Id As Id_Municipio, municipios.Nbre AS Nbre_Municipio, 
            CONCAT(usuarios.Nbres, ' ', usuarios.Apellidos) AS Nbre_Propietario, usuarios.Id As Id_Propietario,
            usuarios.Correo, propiedades.Sala, propiedades.Comedor, propiedades.Cocina,
            propiedades.No_Banios, propiedades.No_Habitaciones, propiedades.Hab_Ppal_Banio, propiedades.Hab_Ppal_Aire,
            propiedades.Patio, propiedades.No_Pisos, propiedades.No_Piso, propiedades.Garage, propiedades.Conjunto_Cerrado,
            propiedades.Conjunto_Abierto, propiedades.Piscina, propiedades.Turco, propiedades.Sauna, propiedades.Balcon,
            propiedades.Amoblada, propiedades.Kiosko, propiedades.Bar, propiedades.Aire, propiedades.Calefaccion, 
            propiedades.Sotano, propiedades.Atico, propiedades.Caja_Fuerte, propiedades.Cuarto_Labores, propiedades.Wifi,
            propiedades.Taxi, propiedades.Auto_Particular, propiedades.Moto_Taxi, propiedades.Calificacion1, 
            propiedades.Calificacion2, propiedades.Calificacion3, propiedades.Ref_Payu, propiedades.Requiere_Autorizacion
            FROM propiedades
                INNER JOIN municipios ON (propiedades.Municipio = municipios.Id)
                INNER JOIN dptos ON (municipios.Dpto = dptos.Id)
                INNER JOIN paises ON (dptos.Pais = paises.Id)
                INNER JOIN usuarios ON (propiedades.Propietario = usuarios.Id)
                INNER JOIN tipo_propiedad ON (propiedades.Tipo = tipo_propiedad.Id)
            WHERE propiedades.Id =".$id;
             
        $resp = consultas::traer_json($sql);    
    
    }else if($llamador=="modificar_propiedad"){
        $id_propiedad = $_POST['id_propiedad'];
        $fechaIni= $_POST['fechaIni'];
        $fechaFin= $_POST['fechaFin'];
        $valor= $_POST['valor'];
        $valor= str_replace(',', '', $valor);
        $autorizacion= $_POST['autorizacion'];
        $observacion= $_POST['observacion'];
        $sala= $_POST['sala'];
        $cocina= $_POST['cocina'];
        $hab_ppal_aire= $_POST['hab_ppal_aire'];
        $hab_ppal_banio= $_POST['hab_ppal_banio'];
        $amoblada= $_POST['amoblada'];
        $kiosko= $_POST['kiosko'];
        $bar= $_POST['bar'];
        $patio= $_POST['patio'];
        $calefaccion= $_POST['calefaccion'];
        $garage= $_POST['garage'];
        $conjunto_cerrado= $_POST['conjunto_cerrado'];
        $conjunto_abierto= $_POST['conjunto_abierto'];
        $sotano= $_POST['sotano'];
        $atico= $_POST['atico'];
        $caja_fuerte= $_POST['caja_fuerte'];
        $piscina= $_POST['piscina'];
        $turco= $_POST['turco'];
        $sauna= $_POST['sauna'];
        $balcon= $_POST['balcon'];
        $wifi= $_POST['wifi'];
        $taxi= $_POST['taxi'];
        $moto_taxi= $_POST['moto_taxi'];
        $auto_particular= $_POST['auto_particular'];
        $estado= $_POST['estado'];
               
        
        $sql="UPDATE propiedades SET ".
             "Fecha_Ini_Disp='".$fechaIni."', Fecha_Fin_Disp='".$fechaFin.
             "', Valor=".$valor.", Sala=".$sala.
             ", Cocina=".$cocina.
             ", Hab_Ppal_Banio=".$hab_ppal_banio.", Hab_Ppal_Aire=".$hab_ppal_aire.
             ", Patio=".$patio.", Garage=".$garage.
             ", Conjunto_Cerrado=".$conjunto_cerrado.", Conjunto_Abierto=".$conjunto_abierto.
             ", Piscina=".$piscina.", Turco=".$turco.
             ", Sauna=".$sauna.", Balcon=".$balcon.
             ", Amoblada=".$amoblada.", Kiosko=".$kiosko.
             ", Bar=".$bar.", Calefaccion=".$calefaccion.
             ", Sotano=".$sotano.", Atico=".$atico.
             ", Caja_Fuerte=".$caja_fuerte.", Wifi=".$wifi.
             ", Taxi=".$taxi.", Auto_Particular=".$auto_particular.
             ", Moto_Taxi=".$moto_taxi.
             ", Requiere_Autorizacion=".$autorizacion.
             ", Observacion='".$observacion.
             "', Activo=".$estado.
             "  WHERE Id='".$id_propiedad."'";
            $resp = modificar::modificar_datos($sql);

            
     }else if($llamador=="nbre_municipio"){
        $tecla = $_POST['tecla'];
        $sql ="SELECT municipios.Id, CONCAT(municipios.Nbre, ' ', dptos.Nbre, ' - ', paises.Nbre) AS Municipio,
                paises.Cod_Moneda, paises.Simbolo, dptos.Id AS Id_Dpto, paises.Id AS Id_Pais
                FROM municipios
                    INNER JOIN dptos ON (municipios.Dpto = dptos.Id)
                    INNER JOIN paises ON (dptos.Pais = paises.Id)
                WHERE municipios.Nbre LIKE '%".$tecla."%'";
             
        $resp = consultas::traer_json($sql);
    
    }else if($llamador==="realizar_reserva"){
        $id_propiedad = $_POST['id_propiedad'];
        $fecha_ini     = $_POST['fecha_ini'];
        $fecha_fin     = $_POST['fecha_fin'];
        $id_cliente    = $_POST['id_cliente'];
        $valor         = $_POST['valor'];
        $req_aut       = $_POST['req_aut'];
        $hoy = date('y/m/d g:ia'); 
        $sql="INSERT INTO reservas(Id_Propiedad, Fecha_Ini, Fecha_Fin, Id_Cliente, Valor, "
            . " Fecha_Autorizado, Fecha_Reg) "
            . "VALUES('"
            .$id_propiedad."','"
            .$fecha_ini."','"
            .$fecha_fin."','"
            .$id_cliente."','"
            .$valor."','";
            if($req_aut==="0"){
                $sql=$sql.$hoy;
            }
            $sql=$sql."','"
            .$hoy."')";
        $resp = grabar::grabar_registro($sql);

        /* Cambio la disponibilidad de reserva a Reservada */
        $sql="UPDATE propiedades SET Disponible = 0 WHERE Id =".$id_propiedad;
        $resp1 = modificar::modificar_datos($sql);
              
     
     }else if($llamador==="validar_acceso"){
        $correo = $_POST['correo'];
        $clave  = $_POST['clave'];
        $sql="SELECT Id, CONCAT(Nbres, ' ', Apellidos) AS Nbres, Calificacion1, Calificacion2, Calificacion3
              FROM usuarios
              WHERE Correo='".$correo."' AND AES_DECRYPT(Clave,'JdQa1972!')='".$clave."' AND Activo=1 LIMIT 1";
        $resp = consultas::traer_json($sql);
        
     
          
     }else if($llamador=="verificar_correo"){
        $correo = $_POST['correo'];
        $sql="SELECT Id, CONCAT(Nbres, ' ', Apellidos) AS Nbre FROM usuarios WHERE Correo = '".$correo."'";
             
        $resp = consultas::traer_json($sql);    
          
    }
    echo $resp;
    return $resp;
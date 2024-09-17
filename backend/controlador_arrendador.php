<?php
    
    require_once 'modelo.php';
    header("Content-Type: text/html;charset=utf-8");
      
    $llamador= $_POST['llamador'];      //Contiene la pantalla que llama
    //$llamador= "modificar_arrendador";
    $resp="No se pudo realizar la conexión a la DB";

    
    if($llamador=="autenticar"){
        /*Pantalla de autenticación de proveedores y clientes*/
        $correo= $_POST['correo'];
        $clave = $_POST['clave'];
        $tabla = $_POST['tabla'];
        $sql="SELECT Id, CONCAT(Nbres, ' ', Apellidos) AS Nbre FROM ".$tabla.
             " WHERE Correo='".$correo."' AND AES_DECRYPT(Clave,'Prospero2018!')='".$clave."' AND Activo=1 LIMIT 1";
        $resp= consultas::traer_json($sql);
    
    }else if($llamador=="anular_activar_arriendo"){        /*Anula o activa la disponibilidad de una solución*/
        $id    = $_POST['id'];
        $estado= $_POST['estado'];
        $sql="UPDATE soluciones SET Activo=".$estado." WHERE Id=".$id;
        $resp = modificar::modificar_datos($sql);
    
         
    }else if($llamador=="autorizar_cancelar_reserva"){        /*Autoriza la reserva*/
        $id_reserva       = $_POST['id_reserva'];
        $fecha_autorizado = $_POST['fecha_autorizado'];
        $fecha_cancelado  = $_POST['fecha_cancelado'];
        $sql="UPDATE reservas SET "
            ."Fecha_Autorizado='".$fecha_autorizado
            ."', Fecha_Cancelacion='".$fecha_cancelado."' WHERE Id=".$id_reserva;
        $resp = modificar::modificar_datos($sql);
    
         
    }else if($llamador=="actualizar_foto_arrendador"){
        $id   = $_POST['id_arrendador'];
        $foto = $_POST['foto'];
        $sql="UPDATE arrendadores SET Foto='".$foto."' WHERE Id=".$id;
        $resp = modificar::modificar_datos($sql);
    
        
    }else if($llamador=="actualizar_datos_arrendador"){
        /*Pantalla de edición de arrendadores*/
        date_default_timezone_set('America/Bogota'); 
        $hoy = date('y/m/d g:ia'); 
        $id         = $_POST['id'];
        $pais       = $_POST['pais'];
        $dpto       = $_POST['dpto'];
        $municipio  = $_POST['municipio'];
        $direccion  = $_POST['direccion'];
        $telefono   = $_POST['telefono'];
        $correo     = $_POST['correo'];
        $clave      = $_POST['clave'];
        $sql="UPDATE arrendadores SET Fecha_Reg='".$hoy."'";
        if($municipio!=null && $municipio!==""){$sql=$sql.", Municipio='".$municipio."', Dpto='".$dpto."', Pais='".$pais."'";}
        if($direccion!=null && $direccion!==""){$sql=$sql.", Direccion='".$direccion."'";}
        if($telefono!=null && $telefono!==""){$sql=$sql.", Telefono='".Telefono."'";}
        if($correo!=null && $correo!==""){$sql=$sql.", Correo='".$correo."'";}
        if($clave!=null && $clave!==""){$sql=$sql.", Clave='".$clave."'";}
        $sql=$sql." WHERE Id=".$id;
        $resp       = modificar::modificar_datos($sql);
    
        
        
    }else if($llamador=="cargar_combo"){
        $sql="SELECT Id, Nbre FROM tipo_solucion WHERE Activo=1 ORDER BY Nbre ASC";
        $resp = consultas::traer_json($sql);
        
        
        
    }else if($llamador=="calificar_huesped"){         
        $id_huesped = $_POST['id_huesped'];
        $id_reserva = $_POST['id_reserva'];
        $calificacion = $_POST['calificacion'];
        $sql="UPDATE reservas SET Se_Hospedo=1, Cal_Del_Arrendador=".$calificacion." WHERE Id='".$id_reserva."'";
        $resp = modificar::modificar_datos($sql);
        
        /*Ahora actualizo en la tabla del huesped*/
        $sql1="UPDATE huespedes SET Calificacion".$calificacion."=Calificacion".$calificacion."+1".
             " WHERE Id='".$id_huesped."'";
        $resp = modificar::modificar_datos($sql1);
        
     
    }else if($llamador=="consultar_existencia_correo"){         /*Pantalla de consulta si existe un cliente o arrendador con el correo*/
        $correo = $_POST['correo'];
        $tabla = $_POST['tabla'];
        $sql="SELECT Id FROM ".$tabla." WHERE Correo='".$correo."' LIMIT 1";
        $resp = consultas::traer_json($sql);
        
     
    }else if($llamador=="consultar_resumen"){
        $id_arrendador = $_POST['id_arrendador'];
        $sql="SELECT Calificacion1, Calificacion2, Calificacion3 FROM arrendadores WHERE Id='".$id_arrendador."'";
        $resp = consultas::traer_json($sql);
        
     
     }else if($llamador=="consultar_datos_arrendador"){
        $id_arrendador= $_POST['id_arrendador'];
        $sql="SELECT CONCAT(arrendadores.Nbres, ' ', arrendadores.Apellidos) AS Nbre
            , paises.Id AS Id_Pais
            , paises.Nbre AS Pais
            , dptos.Id AS Id_Dpto
            , dptos.Nbre AS Dpto
            , municipios.Id AS Id_Municipio
            , municipios.Nbre AS Municipio
            , arrendadores.Direccion
            , arrendadores.Telefono
            , arrendadores.Correo
            , arrendadores.Foto
        FROM arrendadores
            INNER JOIN paises ON (arrendadores.Pais = paises.Id)
            INNER JOIN dptos ON (arrendadores.Dpto = dptos.Id)
            INNER JOIN municipios ON (arrendadores.Municipio = municipios.Id)
        WHERE arrendadores.Id ='".$id_arrendador."'";
        $resp = consultas::traer_json($sql);

   
     }else if($llamador=="consultar_reservas"){
        /*Pantalla de consulta de soluciones de un arrendador*/
        $id_arrendador= $_POST['id_arrendador'];
        $sql="SELECT reservas.Id AS Id_reserva
            , reservas.Fecha_Ini
            , reservas.Fecha_Fin
            , reservas.Cal_Del_Huesped
            , huespedes.Id AS Id_huesped
            , huespedes.Telefono
            , huespedes.Correo
            , CONCAT(huespedes.Nbres, ' ', huespedes.Apellidos) AS Nbre_huesped
            , tipo_solucion.Nbre AS Tipo_solucion
            , reservas.Valor
            , reservas.Se_Hospedo
            , reservas.Cal_Del_Arrendador
            , reservas.Fecha_Cancelacion
            , reservas.Id_Solucion
            , reservas.Medio_Pago
            , medios_pago.Nbre AS Nbre_Medio_Pago
            , reservas.Referencia_Pago
            , reservas.Fecha_Pago
            , reservas.Fecha_Autorizado
            , soluciones.Direccion
        FROM reservas
            INNER JOIN huespedes ON (reservas.Huesped = huespedes.Id)
            INNER JOIN tipo_solucion ON (reservas.Tipo_Solucion = tipo_solucion.Id)
            INNER JOIN soluciones ON (reservas.Id_Solucion = soluciones.Id)
            LEFT  JOIN medios_pago ON (reservas.Medio_Pago = medios_pago.Id)
        WHERE soluciones.Arrendador ='".$id_arrendador.
            "' ORDER BY reservas.Id DESC";
        $resp = consultas::traer_json($sql);

   
     }else if($llamador=="consultar_solucion"){
        /*Pantalla de consulta de soluciones de un arrendador*/
        $id_arrendador= $_POST['id_arrendador'];
        $sql="SELECT soluciones.Id, tipo_solucion.Id AS Id_Tipo_Solucion, tipo_solucion.Nbre AS Tipo_Solucion,
                paises.Nbre AS Pais, dptos.Nbre AS Dpto, municipios.Nbre AS Municipio, soluciones.Direccion,
                soluciones.Fecha_Ini_Disp, soluciones.Fecha_Fin_Disp, FORMAT(soluciones.Valor,0) AS Valor, 
                soluciones.Observacion, soluciones.Activo, paises.Id AS Id_Pais, 
                dptos.Id AS Id_Dpto, municipios.Id As Id_Municipio, soluciones.Sala,
                soluciones.No_Banios, soluciones.No_Habitaciones, soluciones.No_Pisos, soluciones.No_Piso, 
                soluciones.Cocina, soluciones.Hab_Ppal_Banio, 
                soluciones.Hab_Ppal_Aire, soluciones.Patio, soluciones.Garage, 
                soluciones.Conjunto_Cerrado, soluciones.Conjunto_Abierto, 
                soluciones.Piscina, soluciones.Turco, soluciones.Sauna, soluciones.Balcon,
                soluciones.Amoblada, soluciones.Kiosko, soluciones.Bar, soluciones.Aire,
                soluciones.Calefaccion, soluciones.Sotano, soluciones.Atico, soluciones.Caja_Fuerte, 
                soluciones.Wifi, soluciones.Taxi, soluciones.Auto_Particular, soluciones.Moto_Taxi,
                soluciones.Requiere_Autorizacion, soluciones.Observacion, soluciones.Foto
            FROM soluciones 
                INNER JOIN municipios  ON (soluciones.Municipio = municipios.Id)
                INNER JOIN dptos  ON (municipios.Dpto = dptos.Id)
                INNER JOIN paises  ON (dptos.Pais = paises.Id)
                INNER JOIN tipo_solucion  ON (soluciones.Tipo = tipo_solucion.Id)
            WHERE (soluciones.Arrendador =".$id_arrendador.") ORDER BY soluciones.Id DESC";
        $resp = consultas::traer_json($sql);

   
        
    }else if($llamador=="grabar_arrendador"){        /*Pantalla de registro de proveedores*/
        date_default_timezone_set('America/Bogota'); 
        $hoy = date('y/m/d g:ia'); 
        $nbres      = $_POST['nbres'];
        $apellidos  = $_POST['apellidos'];
        $pais       = $_POST['pais'];
        $dpto       = $_POST['dpto'];
        $municipio  = $_POST['municipio'];
        $direccion  = $_POST['direccion'];
        $telefono   = $_POST['telefono'];
        $correo     = $_POST['correo'];
        $clave      = $_POST['clave'];
        $codigo     = $_POST['codigo'];
        if($codigo===""){
            $codigo="1";
        }
        $sql="INSERT INTO arrendadores(Nbres, Apellidos, Pais, Dpto, Municipio, "
                . "Direccion, Telefono, Correo, Clave, Miembro, Fecha_Reg) "
                . "VALUES('"
                .$nbres."','".$apellidos."',".$pais.",".$dpto.",".$municipio.",'".$direccion."','"
                .$telefono."','".$correo."',AES_ENCRYPT('".$clave."','Prospero2018!'),'".$codigo."','".$hoy."')";
        $resp  = grabar::grabar_registro($sql);
            
        
    }else if($llamador=="grabar_solucion_arrendador"){        /*Pantalla de registro de arriendos*/
        date_default_timezone_set('America/Bogota'); 
        $hoy = date('y/m/d g:ia'); 
        $id_arrendador= $_POST['id_arrendador'];
        $tipo_solucion= $_POST['tipo_solucion'];
        $municipio= $_POST['municipio'];
        $direccion= $_POST['direccion'];
        $geo1= $_POST['geo1'];
        $geo2= $_POST['geo2'];
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
        $sql="INSERT INTO soluciones(Arrendador, Municipio, Direccion, Telefono, Geo1, Geo2, Fecha_Ini_Disp,"
                ."Fecha_Fin_Disp,Valor,Tipo,Sala,Cocina,No_Banios,No_Habitaciones,Hab_Ppal_Banio,"
                . "Hab_Ppal_Aire,Patio,No_Pisos,No_Piso, Garage, Conjunto_Cerrado, Conjunto_Abierto, Piscina,"
                . "Turco, Sauna, Balcon,Amoblada,Kiosko, Bar, Aire,Calefaccion, Sotano, Atico, Caja_Fuerte, "
                . "Cuarto_Labores, Wifi,Taxi,Auto_Particular,Moto_Taxi,Observacion,Requiere_Autorizacion,Fecha_Reg) VALUES('"
                .$id_arrendador."','".$municipio."','".$direccion."','".$telefono."','".$geo1."','".$geo2."','"
                .$fechaIni."','".$fechaFin."','".$valor."',".$tipo_solucion.",".$sala.","
                .$cocina.",".$no_banios.",".$no_habitaciones.",".$hab_ppal_banio.",".$hab_ppal_aire.","
                .$patio.",".$no_pisos.",".$no_piso.",".$garage.",".$conjunto_cerrado.","
                .$conjunto_abierto.",".$piscina.",".$turco.",".$sauna.",".$balcon.","
                .$amoblada.",".$kiosko.",".$bar.",".$aire.",".$calefaccion.","
                .$sotano.",".$atico.",".$caja_fuerte.",".$cuarto_labores.","
                .$wifi.",".$taxi.",".$auto_particular.",".$moto_taxi.",'".$observacion."','"
                .$autorizacion."','".$hoy."')";
        $resp=grabar::grabar_registro($sql);
    
          
     
        
     }else if($llamador=="modificar_arrendador"){
        /*Modifica datos de contacto del arrendador*/
        $id    = $_POST['id_arrendador'];
        $pais= $_POST['pais'];
        $dpto= $_POST['dpto'];
        $municipio= $_POST['municipio'];
        $direccion= $_POST['direccion'];
        $telefono= $_POST['telefono'];
        $correo= $_POST['correo'];
        $clave= $_POST['clave'];
        
        if($municipio!==null or $direccion!==null or $telefono!==null or $correo!==null or $clave!==null){
            $sql="UPDATE arrendadores SET Activo = 1 ";
            if($municipio!=="" && $municipio!==null){
                $sql=$sql.", Pais='".$pais."'";
                $sql=$sql.", Dpto='".$dpto."'";
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
                $sql=$sql.", Clave =AES_ENCRYPT('".$clave."','Prospero2018!')";
            }
            $sql=$sql." WHERE Id=".$id;
            $resp = modificar::modificar_datos($sql);
        }
        
        
     }else if($llamador=="modificar_solucion_arrendador"){
        /*Modifica datos de soluciones de arriendo*/
        $id_solucion = $_POST['id_solucion'];
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
               
        
        $sql="UPDATE soluciones SET ".
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
             "'  WHERE Id='".$id_solucion."'";
            $resp = modificar::modificar_datos($sql);
    }
    
    
    echo $resp;
    return $resp;
        
       
    
<?php
    require 'PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $nbres_destino  =$_POST["nbres"];
    $municipio      =$_POST["municipio"];
    $correo         =$_POST["correo"];
    $clave          =$_POST["clave"];
    $id             =$_POST["id"];
    $destino        =$_POST["destino"];
    $resultado      = 'ok';
    $cuerpo         ="Bienvenido a qartos!";
    $team           ="El equipo de <b>qartos!</b>";

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->CharSet = 'UTF-8';     
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host         = 'mail.qartos.com.co';           // Specify main and backup SMTP servers
    $mail->SMTPAuth     = true;                           // Enable SMTP authentication
    $mail->Username     = 'team@qartos.com.co';          // SMTP username
    $mail->Password     = 'JdQa1972!2022';                // SMTP password
    $mail->SMTPSecure   = 'tls';                          // Enable TLS encryption, `ssl` also accepted
    $mail->Port         = 587;                            // TCP port to connect to
    $mail->From         = 'team@qartos.com.co';
    //$mail->FromName     = $titulo;                       //Nombre que aparece cuando se envía el correo
   
    //$mail->addReplyTo('info@acamellarsedijo.com', 'Informacion');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    //$mail->addAttachment('../imagenes/publica1.jpg');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
   
    
    if($destino==="Registro_Usuario"){                 //Hacía el nuevo usuario
        $mail->FromName= "Bienvenido a qartos!";
        $mail->addAddress($correo, $nbres_destino);
        $mail->Subject = 'Bienvenido '.$nbre_cliente.'!';
        $cuerpo= '<br>
            Gusto en saludarlo(a).<br><br>'.
            'Usted se ha registrado satisfactoriamente en nuestro portal.<br><br>
            Estamos felices que sea parte de nuestro equipo de <b>qartos</b> y le damos la mas cordial Bienvenida.
            <br><br><br>
            Los datos de registro en nuestro portal son los siguientes:<br><br>
            Su ID: <b>'.$id.'</b><br>
            Usuario: <b>'.$correo.'</b><br>
            Clave  : <b>'.$clave.'</b><br><br>
            Si necesita información adicional, por favor no dude en contactarnos.<br><br>
            Le deseamos exito!.<br><br>'.$team;
            
    }else if($destino==="1"){                   //Modificación del perfil arrendador
        $mail->FromName= "Suceso en aqartos!";
        $mail->addAddress($correo, $nbres_destino);
        $mail->Subject = 'Actualización de datos ';
        $cuerpo= '<br>
            Estimado(a) Sr(a): '.$nbres_destino.'!<br><br>
            Su información de perfil fue actualizada de forma correcta en nuestra Base de Datos.<br><br>
            
            Si usted no fue quien modifico la información, por favor póngase en contacto de 
            inmediato con nosotros.<br><br>
            Le deseamos exito!.<br><br>'.$team;
    
    }else if($destino==="2"){                   //Hacía Info informando de la creación de un arrendador
        $mail->FromName= "Nuevo registro en aqartos!";
        $mail->addAddress("team@qartos.com.co", $nbres_destino);     // Add a recipiente
        $mail->Subject = 'Arrendador: '.$nbres_destino.'!';
        $cuerpo= '<br>
            Se ha resgistrado un arrendador con los siguientes datos:<br><br>
            ID: '.$id.'<br>'.
            'Nombres: '.$nbres_destino.'<br>'.
            'Municipio: '.$municipio.'<br><br>'.
            
            'Por favor contactarlo.<br><br><br>'.$team;
        
    }else if($destino==="3"){                   //Registro de un cliente
        $mail->FromName= "Bienvenido a aqartos!";
        $mail->addAddress($correo, $nbres_destino);
        $mail->Subject = 'Felicitaciones!';
        $cuerpo= '<br>
            Gusto en saludarlo(a).<br><br>'.
            'Usted se ha registrado satisfactoriamente en nuestro portal <b>qartos!</b><br><br>
            Estamos felices de tenerlo con nosotros y el equipo de <b>qartos!</b> le da la mas cordial Bienvenida.<br><br><br>
            Los datos de registro en nuestro portal son los siguientes:<br><br>
            Su ID: <b>'.$id.'</b><br>
            Usuario: <b>'.$correo.'</b><br>
            Clave  : <b>'.$clave.'</b><br><br>
            Si necesita información adicional, por favor no dude en contactarnos.<br><br>
            Le deseamos exito!.<br><br>'.$team;
        
    }else if($destino==="4"){                   //Hacía Info informando de la creación de un huesped
        $mail->FromName= "Nuevo huesped";
        $mail->addAddress("team@qartos.com.co", $nbres_destino);     // Add a recipiente
        $mail->Subject = 'Huesped: '.$nbres_destino.'!';
        $cuerpo= '<br>
            Se ha resgistrado un nuevo Cliente con los siguientes datos:<br><br>
            ID: '.$id.'<br>'.
            'Nombres: '.$nbres_destino.'<br>'.
            'Municipio: '.$municipio.'<br><br>'.
            
            'Por favor contactarlo.<br><br><br>'.$team;
        
            
    }else if($destino==="Reserva_Propietario"){                   //Hacía el propietario
        $mail->FromName= "Reserva en qartos!";
        $mail->addAddress($correo, "team@qartos.com.co");
        $mail->Subject = 'Reserva: '.$id.'!';    //Esta variable la utilizo para traer el ID de la solución
        $cuerpo= '<br>
            Estimado(a) Sr(a) '.$nbres_destino.'<br>
            Reciba un cordial saludo.<br><br>
            Han solicitado la reserva de un(a) '.$clave.'<br><br>'. //reutilizo esta variable trayendo el nbre de la solución de propiedad
            'Por favor revísela para dar respuesta inmediata al Cliente<br><br>
            ID: '.$id.'<br>'.
            'Municipio/Provincia: '.$municipio.'<br><br>'.
            
            'Por favor ingrese a la plataforma de https://qartos.com.co y autorice la reserva.<br><br><br>'.$team;
    
            }else if($destino==="Reserva_Usuario"){                   //Hacía el usuario
                $mail->FromName= "Reserva en qartos!";
                $mail->addAddress($correo);
                $mail->Subject = 'Reserva: '.$id.'!';    //Esta variable la utilizo para traer el ID de la solución
                $cuerpo= '<br>
                    Estimado(a) Sr(a) '.$nbres_destino.'<br>
                    Reciba un cordial saludo.<br><br>
                    Usted ha solicitado la reserva de un(a) '.$clave.'<br><br>'. //reutilizo esta variable trayendo el nbre de la solución de propiedad
                    'Muy pronto se le dará respuesta a su solicitud.<br><br>
                    ID: '.$id.'<br>'.
                    'Municipio/Provincia: '.$municipio.'<br><br><br>'.$team;
                

    }else if($destino==="6"){                   //Hacía qartos, informando de una reserva
        $mail->FromName= "Nueva reserva!";
        /*En esta sección reutilizo las variables aunque tengan nombres diferentes*/
        $mail->addAddress("team@qartos.com.co", $nbres_destino);
        $mail->Subject = 'Reserva: '.$id.'!';    //Esta variable la utilizo para traer el ID de la solución
        $cuerpo= '<br>
            En hora buena!<br><br>
            Han realizado la reserva de un(a) '.$clave.'<br><br>'. //reutilizo esta variable trayendo el nbre de la solución de arriendo
            'Por favor gestionar con el Propietario<br><br>
            ID: '.$id.'<br>'.
            'Municipio/Provincia: '.$municipio.'<br><br>'.
            
            'Exitos!.<br><br><br>'.$team;
        
    }else if($destino==="7"){                   //Hacía el arrendador, informando de una reserva
        $mail->FromName= "Nueva reserva en aqartos!";
        /*En esta sección reutilizo las variables aunque tengan nombres diferentes*/
        $mail->addAddress($correo, $nbres_destino);
        $mail->Subject = 'Reserva: '.$id.'!';    //Esta variable la utilizo para traer el ID de la solución
        $cuerpo= '<br>
            Estimado(a) Sr(a) '.$nbres_destino.'<br>
            Reciba un cordial saludo.<br><br>
            Han realizado una reserva de un(a) '.$clave.'<br><br>'. //reutilizo esta variable trayendo el nbre de la solución de arriendo
            '<br><br>
            ID: '.$id.'<br>'.
            'Municipio/Provincia: '.$municipio.'<br><br>'.
            '<br><br><br>'.$team;
        
    }else if($destino==="8"){                   //Hacía qartos, informando de una reserva
        $mail->FromName= "Nueva reserva!";
        /*En esta sección reutilizo las variables aunque tengan nombres diferentes*/
        $mail->addAddress("team@qartos.com.co", $nbres_destino);
        $mail->Subject = 'Reserva: '.$id.'!';    //Esta variable la utilizo para traer el ID de la solución
        $cuerpo= '<br>
            En hora buena!<br><br>
            Han realizado la reserva de un(a) '.$clave.'<br><br>'. //reutilizo esta variable trayendo el nbre de la solución de arriendo
            'Esta reserva no requiere autorización por el Propietario<br><br>
            ID: '.$id.'<br>'.
            'Municipio/Provincia: '.$municipio.'<br><br>'.
            
            'Exitos!.<br><br><br>'.$team;
        
    }else if(substr($destino, 0, 1)==="9"){                   //Hacía el arrendador y hacía qartos informando el pago
        /*En esta sección reutilizo las variables aunque tengan nombres diferentes*/
        $mail->FromName= "Pago de reserva en aqartos!";
        $mail->addAddress($correo, $nbres_destino);
        $mail->addCC('team@qartos.com.co');
        $mail->Subject = 'Pago de Reserva No : '.$id.'!';
        $cuerpo= '<br>
            Felicidades!<br><br>
            Han realizado el pago de la siguiente reserva:<br>'. 
            'Reserva número: '.$id.'<br>'.
            'Fecha de reserva: '.substr($destino, 1, 11).'<br>'.    //Reutilizo esta variable
            'Fecha de pago: '.$clave.'<br>'.    //Reutilizo esta variable
            'Referencia o número de pago: '.$municipio.'<br><br>'.    //Reutilizo esta variable
            'Por favor póngase en contacto con el cliente para finiquitar la logística'.
            'y para que el cliente se sienta bien atendido y vea lo importante que es para usted.<br><br>'.
            'Recuerde que de la buena atención que le de, obtendra una buena calificación '.
            'y lo recomendarán muy bien; lo que generará buena fama y mayor afluencia de clientes a su propiedad!<br><br>'.
            'Gracias por confiar en nosotros.<br>'.
            'Exitos!.<br><br><br>.'.$team;
        
    }else if($destino==="10"){                   //Hacía el cliente y hacía qartos informando el pago
        /*En esta sección reutilizo las variables aunque tengan nombres diferentes*/
        $mail->FromName= "Autorizada reserva aqartos!";
        $mail->addAddress($correo, $nbres_destino);
        $mail->addCC('team@qartos.com.co');
        $mail->Subject = 'Autorización de Reserva No : '.$id.'!';
        $cuerpo= '<br>
            Felicidades!<br><br>
            Ha sido autorizada por el propietario la reserva realizada por usted.<br><br>'. 
            'Reserva número: '.$id.'<br>'.
            'Fecha de reserva: '.$municipio.'<br><br>'.    //Reutilizo esta variable
            'Por favor ingrese a su perfil, busque la reserva y realice el pago antes que otro cliente '.
            'la reserve y pague antes que usted!<br><br>'.
            'Gracias por preferirnos y disfrute su alojamiento.<br><br><br>'.
            'Exitos!.<br><br><br>.'.$team;
        
    }else if($destino==="11"){                   //Hacía el cliente y hacía qartos informando el pago
        /*En esta sección reutilizo las variables aunque tengan nombres diferentes*/
        $mail->FromName= "Reserva cancelada aqartos!";
        $mail->addAddress($correo, $nbres_destino);
        $mail->addCC('admin@qartos.com.co');
        $mail->Subject = 'Cancelación de Reserva No : '.$id.'!';
        $cuerpo= '<br>
            Estimado cliente!<br><br>
            Lastimosamente el propietario ha Cancelado su reserva.<br>'. 
            'Lamentamos esta situación, pero '.
            'queremos animarlo a que busque otra.<br><br>'.
            'Recuerde que tenemos muchas propiedades disponibles donde usted necesita.<br><br>'.
            'Gracias por preferirnos.<br><br><br>'.
            'Exitos en su nueva busqueda!.<br><br><br>.'.$team;
        
    }else if($destino==="Recuperar_Clave"){                   //Recuperar clave de acceso
        /*En esta sección reutilizo las variables aunque tengan nombres diferentes*/
        $mail->FromName= "Qartos - Clave!";
        $mail->addAddress($correo, $nbres_destino);
        $mail->addCC('team@qartos.com.co');
        $mail->Subject = 'Recuperación de Clave de Acceso';
        $cuerpo= '<br>
            Estimado usuario!<br><br>
            Uste ha solicitado el cambio de su clave de acceso.'. 
            'Por lo anterior, por favor utilice la siguiente contraseña, la cual podrá cambiar cuando lo desee: <br><strong> '
            .$clave.
            '</strong><br>Le recomendamos cambiar su clave por una igual de segura y de fácil recordación.<br><br>'.
            'Exitos!.<br><br><br>.'.$team;
        
    }else if($destino==="Contactenos"){                   //Hacía quien nos contacta
        $mail->FromName= "Qartos - Bienvenidos!";
        $mail->addAddress($correo, $nbres_destino);
        $mail->addCC('team@qartos.com.co');
        $mail->Subject = 'Mensaje de contacto';
        $cuerpo= '<br>
            Estimado Sr(a) '.$nbres_destino.
            'Es un gusto saludarlo(a)<br><br>'.
            'Gracias por ponerse en contacto con nosotros.<br>'. 
            'Atenderemos su requemiento de inmediato.'.
            '<br><br>Exitos!.<br><br><br>'.$team;
    }
    
    $mail->Body=$cuerpo;
    //$mail->AltBody = 'Usted se ha registrado en nuestro portal de Red Social de Trabajo.';
    if(!$mail->send()) {            //No se pudo enviar el correo
        $resultado=$mail->ErrorInfo;
    }
    echo $resultado;
    return $resultado;
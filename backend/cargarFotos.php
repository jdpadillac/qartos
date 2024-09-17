<?php
    
    //$directory = '../img/prop/3/';
   $directory = $_REQUEST['carpetaF'].'/';
   $resp =json_encode('{"0":"'.$directory.'"}');
   if(is_dir($directory)){
       $scanned_directory = array_diff(scandir($directory), array('..', '.'));
       $resp =json_encode($scanned_directory);
   }
   print_r($resp);
   return $resp;
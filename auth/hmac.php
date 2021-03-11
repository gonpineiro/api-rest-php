<?php
    if (
        !array_key_exists('HTTP_X_HASH', $_SERVER) ||
        !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) ||
        !array_key_exists('HTTP_X_UID', $_SERVER)
        ) {
            die('No se enviaron los parametros');
        }
        
    /* Guardamos las variables */
    list($hash, $uid, $timestamp) = [
        $_SERVER['HTTP_X_HASH'],
        $_SERVER['HTTP_X_UID'],
        $_SERVER['HTTP_X_TIMESTAMP']
    ];
    
    /* Generamos el Hash */
    $secret = '12345';
    $newHash = sha1($uid.$timestamp.$secret);
    
    /* Si no coincide se detiene la ejecucion */
    if ($newHash !==  $hash) {
        die('Error de Autenticacion - HMAC');
    }

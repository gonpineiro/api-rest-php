<?php
    /*  Verificamos si existe un usuario  */
    $user = array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : '';
    $pwd = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : '';

    if ($user !== 'user' || $pwd !== 'pass') {
        die('Error de autenticacion - HTTP');
    }

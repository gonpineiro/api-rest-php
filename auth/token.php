<?php
    /* Verificamos si recibimos el Token del cliente */
    if (!array_key_exists('HTTP_X_TOKEN', $_SERVER)) {
        die('No recibimos el Token');
    }

    /* Servidor de Auth */
    $url = 'http://localhost:8001';

    /* Inicializamos la llamada */
    $ch = curl_init($url);

    /* Configuramos las opciones de la llamada */
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "X-Token: {$_SERVER['HTTP_X_TOKEN']}"
        ]
    );

    /* La configuracion para obtener la llamada del servidor */
    curl_setopt(
        $ch,
        CURLOPT_RETURNTRANSFER,
        true
    );

    /* Ralizar la llamada */
    $ret = curl_exec($ch);
    if ($ret !== 'true') {
        die('Error de Autenticacion.');
    }

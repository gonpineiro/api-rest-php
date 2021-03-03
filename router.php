<?php
$matches = [];

/* Exepcion para que la URL principas sea index.php */
if (in_Array($_SERVER["REQUEST_URI"], ['/index.php', '/', ''])) {
    echo file_get_contents('index.html');
}

/* Verificamos que sea una URL valida,  para un recurso en particular */
if (preg_match('/\/([^\/]+)\/([^\/]+)/', $_SERVER["REQUEST_URI"], $matches)) {
    $_GET['resource_type'] = $matches[1];
    $_GET['resource_id'] = $matches[2];

    error_log(print_r($matches, 1));
    require 'server.php';

/* Verificamos que sea una URL valida,  para una coleccion */
} elseif (preg_match('/\/([^\/]+)\/?/', $_SERVER["REQUEST_URI"], $matches)) {
    $_GET['resource_type'] = $matches[1];
    error_log(print_r($matches, 1));

    require 'server.php';
} else {
    error_log('No matches');
    http_response_code(404);
}

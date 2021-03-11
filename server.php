<?php
    /* Haders */
    include('header.php');

    /*Autenticacion via HTTP */
    // include('auth/http.php');

    /* Autenticacion via HMAC */
    // include('auth/hmac.php');

    /* Autenticacion via Token */
    // include('auth/token.php');

    /* Definimos los recursos disponibles */
    $allowedResourceTypes = [
        'books',
        'authors',
        'genres'
    ];

    /* Validamos que el recurso este disponible */
    $resourceType = $_GET['resource_type'];
    
    if (!in_array($resourceType, $allowedResourceTypes)) {
        http_response_code(400);
        die('Correcta Peticion');
    }

    /* Definos los recursos */
    $books = [
        1 => [
            'titulo' => 'Lo que el viento se llevo.',
            'id_autor' => 2,
            'id_genero' => 2
        ],
        2 => [
            'titulo' => 'La ida del capital.',
            'id_autor' => 1,
            'id_genero' => 1
        ],
        3 => [
            'titulo' => 'Wally .',
            'id_autor' => 3,
            'id_genero' => 3
        ],
    ];
    
    /* Levantamos el ID del recurso buscado */
    $resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';


    /* Generamos la respuesta asumiendo que el perdido es correcto */
    switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
        case 'GET':
            if (empty($resourceId)) {
                echo json_encode($books);
            } else {
                if (array_key_exists($resourceId, $books)) {
                    echo json_encode($books[$resourceId]);
                } else {
                    http_response_code(404);
                }
            }
            break;
        case 'POST':

            /* Tomamos la entrada cruda */
            $json = file_get_contents('php://input');

            /* Agregamos el nuevo libro */
            $books[] = json_decode($json, true);

            echo array_keys($books)[count($books) - 1].PHP_EOL;

            echo json_encode($books).PHP_EOL;
            break;
        case 'PUT':

            /* Validamos que el recurso buscado exista */
            if (!empty($resourceId) && array_key_exists($resourceId, $books)) {

                /* Tomamos la entrada cruda */
                $json = file_get_contents('php://input');

                /* Modificamos el libro */
                $books[$resourceId] = json_decode($json, true);

                echo json_encode($books).PHP_EOL;
            }
            break;
        case 'DELETE':

            /* Validamos que el recurso buscado exista */
            if (!empty($resourceId) && array_key_exists($resourceId, $books)) {

                /* Eliminamos el recurso */
                unset($books[$resourceId]);

                echo json_encode($books).PHP_EOL;
            }
            break;
    }

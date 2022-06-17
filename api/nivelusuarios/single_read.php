<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/nivelusuarios.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new NivelUsuarios($db);

    $item->id_tipo_usuario = isset($_GET['id_tipo_usuario']) ? $_GET['id_tipo_usuario'] : die();

    $item->getSingleNivelUsuario();

    if ($item->nombre_tipo_usuario != null) {
        $emp_arr = array(
            "id_tipo_usuario" => $item->id_tipo_usuario,
            "nombre_tipo_usuario" => $item->nombre_tipo_usuario
        );

        http_response_code(200);
        echo json_encode($emp_arr);
    } else {
        http_response_code(404);
        echo json_encode("Departamento no encontrado.");
    }

<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/usuarios.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Usuarios($db);
    $item->id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : die();


    $stmt = $item->getSingleUsuario();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        $employeeArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_usuario" => $id_usuario,
                "nombre_usuario" => $nombre_usuario,
                "departamento" => $departamento,
                "tipo_usuario" => $tipo_usuario,
                "contrasena" => $contrasena,
                "estatus" => $estatus,
                "login_count" => $login_count
            );
        }
        echo json_encode($e);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Sin registros.")
        );
    }

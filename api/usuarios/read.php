<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/usuarios.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Usuarios($db);

    $stmt = $item->getUsuarios();
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

            array_push($employeeArr, $e);
        }
        echo json_encode($employeeArr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Sin registros.")
        );
    }

<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/departamentos.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Departamentos($db);

    $stmt = $items->getDepartamentos();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        $employeeArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_departamento" => $id_departamento,
                "nombre_departamento" => $nombre_departamento
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

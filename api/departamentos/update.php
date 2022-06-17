<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/departamentos.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Departamentos($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_departamento = $data->id_departamento;
    $item->nombre_departamento = $data->nombre_departamento;
    
    if($item->updateDepartamento()){
        echo json_encode("Departamento actualizado.");
    } else{
        echo json_encode("Departamento no actualizado");
    }
?>
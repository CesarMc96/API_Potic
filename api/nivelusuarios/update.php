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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_tipo_usuario = $data->id_tipo_usuario;
    $item->nombre_tipo_usuario = $data->nombre_tipo_usuario;
    
    if($item->updateNivelUsuario()){
        echo json_encode("Nivel de usuario actualizado.");
    } else{
        echo json_encode("Nivel de usuario no actualizado");
    }
?>
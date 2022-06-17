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

    $data = json_decode(file_get_contents("php://input"));

    $item->nombre_usuario = $data->nombre_usuario;
    $item->departamento = $data->departamento;
    $item->tipo_usuario = $data->tipo_usuario;
    $item->contrasena = $data->contrasena;
    $item->estatus = $data->estatus;
    $item->login_count = $data->login_count;
    
    if($item->createUsuario()){
        echo 'Usuario creado exitosamente.';
    } else{
        echo 'Error al intentar crear al Usuario.';
    }
?>
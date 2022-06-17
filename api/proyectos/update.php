<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/proyectos.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Proyectos($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_proyecto = $data->id_proyecto;
    $item->fecha_inicio = $data->fecha_inicio;
    $item->fecha_fin = $data->fecha_fin;
    $item->tecnico_responsable = $data->tecnico_responsable;
    $item->cartera_inversion = $data->cartera_inversion;
    $item->cancelacion = $data->cancelacion;
    $item->documento_final = $data->documento_final;
    $item->area_responsable = $data->area_responsable;
    $item->nombre = $data->nombre;
    $item->plurianualidad = $data->plurianualidad;
    $item->numero_proyecto = $data->numero_proyecto;
    
    if($item->updateProyecto()){
        echo "Proyecto actualizado con exito.";
    } else{
        echo "Error al intentar actualziar al Proyecto.";
    }
?>
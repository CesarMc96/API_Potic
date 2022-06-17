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
$item->id_proyecto = isset($_GET['id_proyecto']) ? $_GET['id_proyecto'] : die();


$stmt = $item->getSingleProyecto();
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
    $employeeArr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "id_proyecto" => $id_proyecto,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "tecnico_responsable" => $tecnico_responsable,
            "cartera_inversion" => $cartera_inversion,
            "cancelacion" => $cancelacion,
            "documento_final" => $documento_final,
            "dictaminacion" => $dictaminacion,
            "autorizaciones" => $autorizaciones,
            "petic" => $petic,
            "potic" => $potic,
            "area_responsable" => $area_responsable,
            "nombre" => $nombre,
            "plurianualidad" => $plurianualidad,
            "numero_proyecto" => $numero_proyecto
        );
    }
    echo json_encode($e);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Sin registros.")
    );
}

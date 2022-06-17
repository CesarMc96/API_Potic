<?php
class Proyectos {

    private $conn;

    private $db_table = "proyectos";

    public $id_proyecto;
    public $fecha_inicio;
    public $fecha_fin;
    public $tecnico_responsable;
    public $cartera_inversion;
    public $cancelacion;
    public $documento_final;
    public $dictaminacion;
    public $autorizaciones;
    public $petic;
    public $potic;
    public $area_responsable;
    public $nombre;
    public $plurianualidad;
    public $numero_proyecto;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProyectos() {
        $sqlQuery = "SELECT id_proyecto, fecha_inicio, fecha_fin, tecnico_responsable, cartera_inversion, cancelacion, documento_final, dictaminacion, autorizaciones, petic, potic, area_responsable, nombre,
        plurianualidad, numero_proyecto FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function createProyecto() {
        $sqlQuery1 = 'INSERT INTO dictaminacion_tic SET iniciativa="", anexo_tecnico="", resultado_investigacion_protocolo="", estudio_costo_beneficio="", desarrollo_sistemas="", estudio_factibilidad=""';
        $sqlQuery2 = 'INSERT INTO autorizaciones SET gtic="", oic="", cedn="", upcp_shcp=""';
        $sqlQuery3 = 'INSERT INTO petic SET informe1="", informe2="", informe3="", informe4=""';
        $sqlQuery4 = 'INSERT INTO potic SET pedido_contrato="", acta_constitucion="", acta_aceptacion="", acta_cierre="", desarrollo=""';

        $sqlQuery = "INSERT INTO " . $this->db_table . " SET fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, tecnico_responsable=:tecnico_responsable, cartera_inversion=:cartera_inversion, cancelacion=:cancelacion, documento_final=:documento_final, dictaminacion=LAST_INSERT_ID(), autorizaciones=LAST_INSERT_ID(), petic=LAST_INSERT_ID(), potic=LAST_INSERT_ID(), area_responsable=:area_responsable, nombre=:nombre, plurianualidad=:plurianualidad, numero_proyecto=:numero_proyecto";

        $stmt1 = $this->conn->prepare($sqlQuery1);
        $stmt2 = $this->conn->prepare($sqlQuery2);
        $stmt3 = $this->conn->prepare($sqlQuery3);
        $stmt4 = $this->conn->prepare($sqlQuery4);
        $stmt = $this->conn->prepare($sqlQuery);

        $this->fecha_inicio = htmlspecialchars(strip_tags($this->fecha_inicio));
        $this->fecha_fin = htmlspecialchars(strip_tags($this->fecha_fin));
        $this->tecnico_responsable = htmlspecialchars(strip_tags($this->tecnico_responsable));
        $this->cartera_inversion = htmlspecialchars(strip_tags($this->cartera_inversion));
        $this->cancelacion = htmlspecialchars(strip_tags($this->cancelacion));
        $this->documento_final = htmlspecialchars(strip_tags($this->documento_final));
        $this->area_responsable = htmlspecialchars(strip_tags($this->area_responsable));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->plurianualidad  = htmlspecialchars(strip_tags($this->plurianualidad));
        $this->numero_proyecto  = htmlspecialchars(strip_tags($this->numero_proyecto));

        $stmt->bindParam(":fecha_inicio", $this->fecha_inicio);
        $stmt->bindParam(":fecha_fin", $this->fecha_fin);
        $stmt->bindParam(":tecnico_responsable", $this->tecnico_responsable);
        $stmt->bindParam(":cartera_inversion", $this->cartera_inversion);
        $stmt->bindParam(":cancelacion", $this->cancelacion);
        $stmt->bindParam(":documento_final", $this->documento_final);
        $stmt->bindParam(":area_responsable", $this->area_responsable);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":plurianualidad", $this->plurianualidad);
        $stmt->bindParam(":numero_proyecto", $this->numero_proyecto);

        $stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();
        $stmt4->execute();

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getSingleProyecto() {
        $sqlQuery = "SELECT id_proyecto, fecha_inicio, fecha_fin, tecnico_responsable, cartera_inversion, cancelacion, documento_final, dictaminacion, autorizaciones, petic, potic, area_responsable, nombre,
        plurianualidad, numero_proyecto FROM " . $this->db_table . " WHERE id_proyecto = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id_proyecto);
        $stmt->execute();
        return $stmt;
    }

    public function getSingleProyectoNombre() {
        $sqlQuery = "SELECT id_proyecto, fecha_inicio, fecha_fin, tecnico_responsable, cartera_inversion, cancelacion, documento_final, dictaminacion, autorizaciones, petic, potic, area_responsable, nombre,
        plurianualidad, numero_proyecto FROM " . $this->db_table . " WHERE nombre = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->nombre);
        $stmt->execute();
        return $stmt;
    }

    public function updateProyecto() {
        $sqlQuery = "UPDATE " . $this->db_table . " SET fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, tecnico_responsable=:tecnico_responsable, cartera_inversion=:cartera_inversion, cancelacion=:cancelacion, documento_final=:documento_final, area_responsable=:area_responsable, nombre=:nombre, plurianualidad=:plurianualidad, numero_proyecto=:numero_proyecto WHERE id_proyecto = :id_proyecto";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_proyecto = htmlspecialchars(strip_tags($this->id_proyecto));
        $this->fecha_inicio = htmlspecialchars(strip_tags($this->fecha_inicio));
        $this->fecha_fin = htmlspecialchars(strip_tags($this->fecha_fin));
        $this->tecnico_responsable = htmlspecialchars(strip_tags($this->tecnico_responsable));
        $this->cartera_inversion = htmlspecialchars(strip_tags($this->cartera_inversion));
        $this->cancelacion = htmlspecialchars(strip_tags($this->cancelacion));
        $this->documento_final = htmlspecialchars(strip_tags($this->documento_final));
        $this->area_responsable = htmlspecialchars(strip_tags($this->area_responsable));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->plurianualidad  = htmlspecialchars(strip_tags($this->plurianualidad));
        $this->numero_proyecto  = htmlspecialchars(strip_tags($this->numero_proyecto));

        $stmt->bindParam(":id_proyecto", $this->id_proyecto);
        $stmt->bindParam(":fecha_inicio", $this->fecha_inicio);
        $stmt->bindParam(":fecha_fin", $this->fecha_fin);
        $stmt->bindParam(":tecnico_responsable", $this->tecnico_responsable);
        $stmt->bindParam(":cartera_inversion", $this->cartera_inversion);
        $stmt->bindParam(":cancelacion", $this->cancelacion);
        $stmt->bindParam(":documento_final", $this->documento_final);
        $stmt->bindParam(":area_responsable", $this->area_responsable);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":plurianualidad", $this->plurianualidad);
        $stmt->bindParam(":numero_proyecto", $this->numero_proyecto);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function deleteProyecto() {
        $sqlQuery1 = 'DELETE FROM dictaminacion_tic WHERE id_tic = ?';
        $sqlQuery2 = 'DELETE FROM autorizaciones WHERE id_autorizaciones = ?';
        $sqlQuery3 = 'DELETE FROM petic WHERE id_petic = ?';
        $sqlQuery4 = 'DELETE FROM potic WHERE id_potic = ?';

        $stmt1 = $this->conn->prepare($sqlQuery1);
        $stmt2 = $this->conn->prepare($sqlQuery2);
        $stmt3 = $this->conn->prepare($sqlQuery3);
        $stmt4 = $this->conn->prepare($sqlQuery4);

        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_proyecto = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_proyecto = htmlspecialchars(strip_tags($this->id_proyecto));

        $stmt->bindParam(1, $this->id_proyecto);
        $stmt1->bindParam(1, $this->id_proyecto);
        $stmt2->bindParam(1, $this->id_proyecto);
        $stmt3->bindParam(1, $this->id_proyecto);
        $stmt4->bindParam(1, $this->id_proyecto);

        if ($stmt->execute()) {
            $stmt1->execute();
            $stmt2->execute();
            $stmt3->execute();
            $stmt4->execute();
            return true;
        }
        return false;
    }
}
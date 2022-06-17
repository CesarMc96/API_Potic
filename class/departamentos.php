<?php
class Departamentos {

    private $conn;

    private $db_table = "cat_departamentos";

    public $id_departamento;
    public $nombre_departamento;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDepartamentos() {
        $sqlQuery = "SELECT id_departamento, nombre_departamento FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function createDepartamento() {
        $sqlQuery = "INSERT INTO " . $this->db_table . " SET nombre_departamento= :nombre_departamento";

        $stmt = $this->conn->prepare($sqlQuery);
        $this->nombre_departamento = htmlspecialchars(strip_tags($this->nombre_departamento));
        $stmt->bindParam(":nombre_departamento", $this->nombre_departamento);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getSingleDepartamento() {
        $sqlQuery = "SELECT id_departamento, nombre_departamento FROM " . $this->db_table . " WHERE id_departamento = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id_departamento);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nombre_departamento = $dataRow['nombre_departamento'];
    }

    public function updateDepartamento() {
        $sqlQuery = "UPDATE " . $this->db_table . " SET nombre_departamento= :nombre_departamento WHERE id_departamento = :id_departamento";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->nombre_departamento = htmlspecialchars(strip_tags($this->nombre_departamento));
        $this->id_departamento = htmlspecialchars(strip_tags($this->id_departamento));
        $stmt->bindParam(":nombre_departamento", $this->nombre_departamento);
        $stmt->bindParam(":id_departamento", $this->id_departamento);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function deleteDepartamento() {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_departamento = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_departamento = htmlspecialchars(strip_tags($this->id_departamento));

        $stmt->bindParam(1, $this->id_departamento);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

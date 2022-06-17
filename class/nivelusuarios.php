<?php
class NivelUsuarios {

    private $conn;

    private $db_table = "cat_tipo_usuario";

    public $id_tipo_usuario;
    public $nombre_tipo_usuario;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getNivelUsuarios() {
        $sqlQuery = "SELECT id_tipo_usuario, nombre_tipo_usuario FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function createNivelUsuario() {
        $sqlQuery = "INSERT INTO " . $this->db_table . " SET nombre_tipo_usuario= :nombre_tipo_usuario";

        $stmt = $this->conn->prepare($sqlQuery);
        $this->nombre_tipo_usuario = htmlspecialchars(strip_tags($this->nombre_tipo_usuario));
        $stmt->bindParam(":nombre_tipo_usuario", $this->nombre_tipo_usuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getSingleNivelUsuario() {
        $sqlQuery = "SELECT id_tipo_usuario, nombre_tipo_usuario FROM " . $this->db_table . " WHERE id_tipo_usuario = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id_tipo_usuario);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nombre_tipo_usuario = $dataRow['nombre_tipo_usuario'];
    }

    public function updateNivelUsuario() {
        $sqlQuery = "UPDATE " . $this->db_table . " SET nombre_tipo_usuario= :nombre_tipo_usuario WHERE id_tipo_usuario = :id_tipo_usuario";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->nombre_tipo_usuario = htmlspecialchars(strip_tags($this->nombre_tipo_usuario));
        $this->id_tipo_usuario = htmlspecialchars(strip_tags($this->id_tipo_usuario));
        $stmt->bindParam(":nombre_tipo_usuario", $this->nombre_tipo_usuario);
        $stmt->bindParam(":id_tipo_usuario", $this->id_tipo_usuario);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function deleteNivelUsuario() {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_tipo_usuario = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_tipo_usuario = htmlspecialchars(strip_tags($this->id_tipo_usuario));

        $stmt->bindParam(1, $this->id_tipo_usuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

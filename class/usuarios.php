<?php
class Usuarios {

    private $conn;

    private $db_table = "usuarios";

    public $id_usuario;
    public $nombre_usuario;
    public $departamento;
    public $tipo_usuario;
    public $contrasena;
    public $estatus;
    public $login_count;    

    public $nombre_tipo_usuario;
    public $nombre_departamento;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUsuarios() {
        $sqlQuery = "SELECT id_usuario, nombre_usuario, departamento, tipo_usuario, contrasena, estatus, login_count FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function getUsuariosConDetalles() {
        $sqlQuery = "SELECT U.nombre_usuario, D.nombre_departamento, TU.nombre_tipo_usuario, CASE U.estatus WHEN 0 THEN 'Inactivo' WHEN 1 THEN 'Activo' END estatus, U.id_usuario, login_count FROM  " . $this->db_table . " U inner join cat_tipo_usuario TU on TU.id_tipo_usuario = U.tipo_usuario inner join cat_departamentos D on D.id_departamento= U.departamento order by U.nombre_usuario;";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    
    public function createUsuario() {
        $sqlQuery = "INSERT INTO " . $this->db_table . " SET nombre_usuario=:nombre_usuario, departamento=:departamento, tipo_usuario=:tipo_usuario, contrasena=:contrasena, estatus=:estatus, login_count=:login_count ";

        $stmt = $this->conn->prepare($sqlQuery);
        $this->nombre_usuario = htmlspecialchars(strip_tags($this->nombre_usuario));
        $this->departamento = htmlspecialchars(strip_tags($this->departamento));
        $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
        $this->estatus = htmlspecialchars(strip_tags($this->estatus));
        $this->login_count = htmlspecialchars(strip_tags($this->login_count));
        $stmt->bindParam(":nombre_usuario", $this->nombre_usuario);
        $stmt->bindParam(":departamento", $this->departamento);
        $stmt->bindParam(":tipo_usuario", $this->tipo_usuario);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":estatus", $this->estatus);
        $stmt->bindParam(":login_count", $this->login_count);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getSingleUsuario() {
        $sqlQuery = "SELECT id_usuario, nombre_usuario, departamento, tipo_usuario, contrasena, estatus, login_count FROM " . $this->db_table . " WHERE id_usuario = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id_usuario);
        $stmt->execute();
        return $stmt;
    }

    public function getSingleUsuarioNombre() {
        $sqlQuery = "SELECT id_usuario, nombre_usuario, departamento, tipo_usuario, contrasena, estatus, login_count FROM " . $this->db_table . " WHERE nombre_usuario = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->nombre_usuario);
        $stmt->execute();
        return $stmt;
    }

    public function updateUsuario() {
        $sqlQuery = "UPDATE " . $this->db_table . " SET nombre_usuario=:nombre_usuario, departamento=:departamento, tipo_usuario=:tipo_usuario, contrasena=:contrasena, estatus=:estatus WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->nombre_usuario = htmlspecialchars(strip_tags($this->nombre_usuario));
        $this->departamento = htmlspecialchars(strip_tags($this->departamento));
        $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
        $this->estatus = htmlspecialchars(strip_tags($this->estatus));
        $stmt->bindParam(":nombre_usuario", $this->nombre_usuario);
        $stmt->bindParam(":departamento", $this->departamento);
        $stmt->bindParam(":tipo_usuario", $this->tipo_usuario);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":estatus", $this->estatus);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateUsuarioLC() {
        $sqlQuery = "UPDATE " . $this->db_table . " SET login_count=:login_count WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->login_count = htmlspecialchars(strip_tags($this->login_count));
        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":login_count", $this->login_count);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function deleteUsuario() {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(1, $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

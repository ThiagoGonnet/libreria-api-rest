<?php
require_once 'config.php';

class AutoresModel
{
  private $db;

      public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8",
        MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    private function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = <<<END
        CREATE TABLE IF NOT EXISTS ejemplo (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(50)
        );
        END;
        $this->db->query($sql);
        }
    }

  public function obtenerAutores()
  {
    $query = $this->db->prepare('SELECT * FROM autores');
    $query->execute();
    $autores = $query->fetchAll(PDO::FETCH_OBJ);
    return $autores;
  }
  public function obtenerAutorPorId($id){
    $query = $this->db->prepare('SELECT * FROM autores WHERE id_autor = ?');
    $query->execute([$id]);
    $autor = $query->fetch(PDO::FETCH_OBJ);
    return $autor;
  }

  public function agregarAutor($nombre, $fechaDeNacimiento, $nacionalidad, $biografia){
    $query = $this->db->prepare("INSERT INTO libros('nombre', 'fechaDeNacimiento', 'nacionalidad', 'biografia') values(?,?,?,?)");
    $query->execute([$nombre, $fechaDeNacimiento, $nacionalidad, $biografia]);
    return $this->db->lastInsertId();
  }

  public function eliminarAutor($id_autor){
    $query = $this->db->prepare('DELETE FROM autores WHERE id_autor = ?');
    $query->execute([$id_autor]);
    return $query->rowCount();
  }

  public function actualizarAutor($nombre, $fechaDeNacimiento, $nacionalidad, $biografia){
    $query = $this->db->prepare("UPDATE autores SET 'nombre' = ?, 'fechaDeNacimiento' = ?, 'nacionalidad' = ?, 'biografia' = ?) values(?,?,?,?)");
    $query->execute([$nombre, $fechaDeNacimiento, $nacionalidad, $biografia]);
    return $query->rowCount();
  }
}

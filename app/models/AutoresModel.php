<?php


class AutoresModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=db_libreria;charset=utf8', 'root', '');
  }

  public function obtenerAutores()
  {
    $query = $this->db->prepare('SELECT * FROM autores');
    $query->execute();
    $autores = $query->fetchAll(PDO::FETCH_OBJ);
    return $autores;
  }
  public function obtenerAutoresOrdenados($campo, $orden){
    $query = $this->db->prepare("SELECT * FROM autores ORDER BY $campo $orden");
    $query->execute();
    $autores = $query->fetchAll(PDO::FETCH_OBJ);
    return $autores;
  }
  public function obtenerAutorPorId($id)
  {
    $query = $this->db->prepare('SELECT * FROM autores WHERE id_autores = ?');
    $query->execute([$id]);
    $autor = $query->fetch(PDO::FETCH_OBJ);
    return $autor;
  }
  public function agregarAutor($nombre, $fechaDeNacimiento, $nacionalidad, $biografia)
  {
    $query = $this->db->prepare("INSERT INTO autores (nombre, fecha_de_nacimiento, nacionalidad, biografia) VALUES (?,?,?,?)");
    $query->execute([$nombre, $fechaDeNacimiento, $nacionalidad, $biografia]);
    return $this->db->lastInsertId();
  }
  public function eliminarAutor($id_autor)
  {
    $query = $this->db->prepare('DELETE FROM autores WHERE id_autor = ?');
    $query->execute([$id_autor]);
    return $query->rowCount();
  }

  public function actualizarAutor($id_autor, $nombre, $fechaDeNacimiento, $nacionalidad, $biografia)
  {
    $query = $this->db->prepare("UPDATE autores SET nombre = ?, fecha_de_nacimiento = ?, nacionalidad = ?, biografia = ? WHERE id_autor = ?");
    $query->execute([$id_autor, $nombre, $fechaDeNacimiento, $nacionalidad, $biografia]);
    return $query->rowCount();
  }

}
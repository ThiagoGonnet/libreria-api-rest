<?php 
require_once "./app/models/AutoresModel.php";
class AutoresApiController{
    private $model;

    public function __construct(){
        $this->model =new AutoresModel();
    }
    public function sanitizador($input){
      // tablas de mi db
    $tablas = array("nombre", "fecha_de_nacimiento", "nacionalidad", "biografia");

    $estaEnTabla = false;
    $i = 0;
    // mientras el indice sea menor al tamaño del arreglo, y el input no este en la tabla, sigue iterando, hasta que se cumpla que este en la tabla y corte o hasta que se termine el tamaño del arreglo, por lo tanto devuelva false
    while ($i < count($tablas) && !$estaEnTabla) {
      if ($tablas[$i] == $input) {
        $estaEnTabla = true;
      }
      $i++;
    }
    // si corto antes es porque el input del usuario esta en el arreglo, si no, osea que el indice es mayor o igual al tamaño del arreglo, es porque no esta el input del usuario en la tabla, por ende no es un input valido
    if ($estaEnTabla) {
      return $input;
    } else {
      return "id";
    }  
    }

    public function obtenerAutores($req, $res)
  {
    $campoQuery = $req->query->nacimiento ?? null;
    $ordenQuery = $req->query->orden ?? null;
    if ($campoQuery != null && $ordenQuery != null) {
      if ($ordenQuery != "ASC" && $ordenQuery != "DESC") {
        return $res->json("Bad Request", 400);
      }
      // funcion para sanitizar lo que ingresa el usuario
      $campoAsegurado = $this->sanitizador($campoQuery);

      $autores = $this->model->obtenerAutoresOrdenados($campoAsegurado, $ordenQuery);
      if (empty($autores) || !isset($autores)) {
        return $res->json("No hay autores cargados", 404);
      }
      return $res->json($autores, 200);
    }

    $autores = $this->model->obtenerAutores();
    if (empty($autores) || !isset($autores)) {
      return $res->json("No hay autores cargados", 404);
    }
    return $res->json($autores, 200);
  }
  public function obtenerAutorPorId($req, $res)
  {
    $id_autor = $req->params->id;
    $autor = $this->model->obtenerAutorPorId($id_autor);
    if (!$autor) {
      return $res->json("El autor con id:$id_autor no existe", 404);
    }
    return $res->json($autor, 200);
  }
  public function eliminarAutor($req, $res)
  {
    $id_autor = $req->params->id;
    $autor = $this->model->obtenerAutorPorId($id_autor);
    if (!$autor) {
      return $res->json("El autor con id:$id_autor no existe", 404);
    }
    $rowcount = $this->model->eliminarAutor($id_autor);
    if ($rowcount != 0) {
      return $res->json("Se elimino el autor con id: $id_autor", 200);
    }
  }
  public function agregarAutor($req, $res)
  {
    $nombre = $req->params->nombre;
    $nacimiento = $req->params->fecha_de_nacimiento;
    $nacionalidad = $req->params->nacionalidad;
    $biografia = $req->params->biografia;

    if (empty($autor) || empty($nacimiento) || empty($nacionalidad) || empty($biografia)) {
      return $res->json("Falta completar campos", 400);
    }

    $id = $this->model->agregarAutor($nombre, $nacimiento, $nacionalidad, $biografia);
    if (empty($id)) {
      return $res->json("Error al insertar", 500);
    }

    // se considera una buena práctica devolver la entidad creada que contiene todos los datos que el modelo agregó automaticamente
    $autor = $this->model->obtenerAutorPorId($id);
    return $res->json($autor, 201);
  }
  public function actualizarAutor($req, $res)
  {
    $id_autor = $req->params->id_autor;
    $id = $this->model->obtenerAutorPorId($id_autor);
    if ($id == null) {
      return $res->json("La id con numero:$id_autor no existe", 404);
    }
    $nombre = $req->params->nombre;
    $nacimiento = $req->params->fecha_de_nacimiento;
    $nacionalidad = $req->params->nacionalidad;
    $biografia = $req->params->biografia;

    if (empty($autor) || empty($nacimiento) || empty($nacionalidad) || empty($biografia)) {
      return $res->json("Falta completar campos", 400);
    }

    $this->model->actualizarAutor($id_autor, $nombre, $nacimiento, $nacionalidad, $biografia);

    // se considera una buena práctica devolver la entidad modificada que contiene todos los datos que el modelo agregó automaticamente
    $libro = $this->model->obtenerAutorPorId($id_autor);
    return $res->json($autor, 200);
  }
}
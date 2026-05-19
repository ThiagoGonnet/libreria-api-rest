<?php
require_once "./app/models/LibrosModel.php";
class LibrosApiController{
  private $model;

  public function __construct(){
    $this->model = new LibrosModel();
  }
  public function sanitizador($input){
    // tablas de mi db
    $tablas = array("titulo", "anio_de_publicacion", "disponible", "id_autor");

    $estaEnTabla = false;
    $i = 0;
    // mientras el indice sea menor al tamaño del arreglo, y el input no este en la tabla, sigue iterando, hasta que se cumpla que este en la tabla y corte o hasta que se termine el tamaño del arreglo, por lo tanto devuelva false
    while($i<count($tablas) && !$estaEnTabla){
      if($tablas[$i] == $input){
        $estaEnTabla = true;
      }
      $i++;
    }
    // si corto antes es porque el input del usuario esta en el arreglo, si no, osea que el indice es mayor o igual al tamaño del arreglo, es porque no esta el input del usuario en la tabla, por ende no es un input valido
    if($estaEnTabla){
      return $input;
    } else {
      return "id";
    }
  }

  public function obtenerLibros($req, $res){
    $campoQuery = $req->query->anio ?? null;
    // funcion para sanitizar lo que ingresa el usuario
    $campoAsegurado = $this->sanitizador($campoQuery);
    $ordenQuery = $req->query->orden ?? null;
    if($ordenQuery != "ASC" && $ordenQuery != "DESC"){
      return $res->json("Bad Request", 400);
    }
    // todos los libros con la fecha de publicacion en forma descendente
    if($campoAsegurado != null && $ordenQuery != null){
      $libros = $this->model->obtenerLibrosOrdenados($campoAsegurado, $ordenQuery);
      if(empty($libros) || !isset($libros)){
      return $res->json("No hay libros cargados", 404);
      }
    return $res->json($libros, 200);
    }

    $libros = $this->model->obtenerLibros();
    if(empty($libros) || !isset($libros)){
      return $res->json("No hay libros cargados", 404);
    }
    return $res->json($libros, 200);
  }
  public function obtenerLibroPorId($req, $res){
    $id_libro = $req->params->id;
    $libro = $this->model->obtenerLibroPorId($id_libro);
    if(!$libro){
      return $res->json("El libro con id:$id_libro no existe", 404);
    }
    return $res->json($libro, 200);
  }
  public function eliminarLibro($req, $res){
    $id_libro = $req->params->id;
    $libro = $this->model->obtenerLibroPorId($id_libro);
    if(!$libro){
      return $res->json("El libro con id:$id_libro no existe", 404);
    }
    $rowcount = $this->model->eliminarLibro($id_libro);
    if($rowcount!=0){
      return $res->json("Se elimino el libro con id: $id_libro", 200);
    }
  }
  public function agregarLibro($req, $res){
    $titulo = $req->params->titulo;
    $sinopsis = $req->params->sinopsis;
    $anio = $req->params->anio;
    $disponible = $req->params->disponible;
    $autor = $req->params->autor;

    if(empty($libro) || empty($sinopsis) || empty($anio) || empty($disponible) || empty($autor)){
      return $res->json("Falta completar campos", 400);
    }

    $id = $this->model->agregarLibro($titulo, $sinopsis, $anio, $disponible, $autor);
    if(empty($id)){
      return $res->json("Error al insertar", 500);
    }

    // se considera una buena práctica devolver la entidad creada que contiene todos los datos que el modelo agregó automaticamente
    $libro = $this->model->obtenerLibroPorId($id);
    return $res->json($libro, 201);
  }
  public function actualizarLibro($req, $res){
    $id_libro = $req->params->id_libro;
    $id = $this->model->obtenerLibroPorId($id_libro)
    if($id == null){
      return $res->json("La id con numero:$id_libro no existe", 404);
    }
    $titulo = $req->body->titulo;
    $sinopsis = $req->body->sinopsis;
    $anio = $req->body->anio;
    $disponible = $req->body->disponible;
    $autor = $req->body->autor;


    if(empty($titulo) || empty($sinopsis) || empty($anio) || empty($disponible) || empty($autor) || empty($id_libro)){
      return $res->json("Falta completar campos", 400);
    }

    $this->model->actualizarLibro($titulo, $sinopsis, $anio, $disponible, $autor, $id_libro);

    // se considera una buena práctica devolver la entidad modificada que contiene todos los datos que el modelo agregó automaticamente
    $libro = $this->model->obtenerLibroPorId($id_libro);
    return $res->json($libro, 200);
  }
}

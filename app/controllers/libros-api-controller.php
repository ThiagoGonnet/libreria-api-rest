<?php
require_once "./app/models/LibrosModel.php";
class LibrosApiController{
  private $model;

  public function __construct(){
    $this->model = new LibrosModel();
  }

  public function obtenerLibros($req, $res){
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
}

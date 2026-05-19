# Librería REST API

Este repositorio contiene una API RESTful pública para la gestión y ordenamiento del catálogo de una librería digital, desarrollada bajo la arquitectura Modelo-Vista-Controlador (MVC).

## Integrantes y División de Roles
* **Thiago Gonnet (Miembro A):** Implementación del listado dinámico ordenado (con sanitización por lista blanca) y el servicio de actualización total (`PUT`).
* **Tomas Gonzalez (Miembro B):** --.

---

## Estructura del Proyecto

* `api_router.php` - Entry point que centraliza y deriva los endpoints de la API según el recurso y método HTTP.
* `app/controllers/libros-api.controller.php` - Controlador encargado de capturar las peticiones, procesar los datos JSON de entrada (`$req->body`) y manejar las respuestas HTTP.
* `app/models/LibrosModel.php` - Modelo que interactúa de forma directa con la base de datos MySQL mediante PDO y sentencias preparadas.
* `libs/router/` - Librería interna ligera utilizada para proveer URLs semánticas y mapeo dinámico de parámetros.
* `db/db_libreria.sql` - Script SQL original que contiene la estructura de tablas y datos iniciales (Base de datos compartida).
* `.htaccess` - Reglas de reescritura de Apache para redirigir todo el tráfico al ruteador semántico.

---

## Requisitos e Instalación

1. **Servidor Local:** Contar con un entorno de desarrollo PHP como XAMPP, WampServer o Laragon (PHP 7.4 o superior).
2. **Base de Datos:**
   * Iniciar el servidor MySQL.
   * Crear una base de datos llamada `db_libreria`.
   * Importar el archivo ubicado en `db/db_libreria.sql`.
3. **Despliegue:** Clonar o mover la carpeta del proyecto a la raíz de tu servidor web (`htdocs` o `www`).
4. **Pruebas:** Configurar un cliente HTTP como **Postman** o **Insomnia** para consumir los servicios apuntando a la URL base. No es necesario un frontend.

---

## Documentación de Endpoints

### 1. Listar Libros (GET)
* **URL:** `/api/libros`
* **Método:** `GET`
* **Descripción:** Devuelve la colección entera de libros. Admite ordenamiento dinámico opcional por cualquier campo válido de la tabla mediante Query Params.
* **Query Params Opcionales:**
  * `anio`: Nombre de la columna por la cual ordenar (Lista blanca: `titulo`, `anio_de_publicacion`, `disponible`, `id_autor`). Si se ingresa un campo inválido o no se envía, por defecto ordena por `id`.
  * `orden`: Sentido del ordenamiento (`ASC` o `DESC`).
* **Respuestas:**
  * `200 OK`: Devuelve un arreglo JSON con las entidades.
  * `400 Bad Request`: Si el valor de `orden` no es `ASC` o `DESC`.
  * `404 Not Found`: "No hay libros cargados".

### 2. Obtener Libro por ID (GET)
* **URL:** `/api/libros/:id`
* **Método:** `GET`
* **Descripción:** Obtiene los datos detallados de un único libro específico según su identificador.
* **Respuestas:**
  * `200 OK`: Devuelve el objeto JSON del libro solicitado.
  * `404 Not Found`: "El libro con id: :id no existe".

### 3. Eliminar Libro (DELETE)
* **URL:** `/api/libros/:id`
* **Método:** `DELETE`
* **Descripción:** Remueve de manera permanente un libro del catálogo a partir de su ID.
* **Respuestas:**
  * `200 OK`: "Se elimino el libro con id: :id".
  * `404 Not Found`: "El libro con id: :id no existe".

### 4. Agregar Libro (POST)
* **URL:** `/api/libros`
* **Método:** `POST`
* **Descripción:** Inserta un nuevo libro en el sistema. Los datos deben ser enviados estructurados en formato JSON dentro del cuerpo de la petición.
* **Cuerpo de la Petición (JSON):**
```json
{
  "titulo": "El Aleph",
  "sinopsis": "Colección de cuentos y relatos mágicos.",
  "anio_de_publicacion": 1949,
  "disponible": 1,
  "autor": 1
}

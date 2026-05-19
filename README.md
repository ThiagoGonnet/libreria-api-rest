# Libreria REST API

Este repositorio contiene una API REST simple para gestionar la libreria digital.

## Qué hay en este proyecto

- `api_router.php` - Entry point para los endpoints de la API.
- `app/controllers/` - Controladores, por ejemplo `libros-api.controller.php`.
- `app/models/` - Modelos, por ejemplo `libros.model.php`.
- `libs/router/` - Librería ligera de ruteo usada por este proyecto.
- `db/db_libreria.sql` - Script SQL para crear la base de datos y tablas iniciales.
- `.htaccess`: reglas apache para soportar URL semánticas

## Librería de ruteo

Este proyecto usa una librería interna para rutear peticiones ubicada en `libs/router/`.
Consulta la documentación de la librería de ruteo aquí:

[libs/router/README.md](libs/router/README.md)


## API de Issues

API RESTful simple para la gestión de issues.  
Permite **listar, obtener, crear, actualizar y eliminar** issues mediante distintos endpoints HTTP.

---

## Endpoints

- GET /api/libros — listar libros
- GET /api/libros/:id — ver un libro
- DELETE /api/libros/:id — eliminar libro
- POST /api/libros - agregar un libro

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2026 a las 22:57:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `nacionalidad` varchar(150) NOT NULL,
  `biografia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autor`, `nombre`, `fecha_de_nacimiento`, `nacionalidad`, `biografia`) VALUES
(0, 'Gabriel García Márquez', '1927-03-06', 'Colombiano', 'Escritor y periodista colombiano, referente del realismo mágico y ganador del Premio Nobel de Literatura en 1982.'),
(0, 'Jorge Luis Borges', '1899-08-24', 'Argentino', 'Escritor argentino reconocido mundialmente por sus cuentos, ensayos y poemas.'),
(0, 'Julio Cortázar', '1914-08-26', 'Argentino', 'Novelista y cuentista argentino, autor destacado de la literatura latinoamericana.'),
(0, 'Isabel Allende', '1942-08-02', 'Chilena', 'Escritora chilena reconocida por sus novelas históricas y realismo mágico.'),
(0, 'Mario Vargas Llosa', '1936-03-28', 'Peruano', 'Novelista, ensayista y político peruano, Premio Nobel de Literatura 2010.'),
(0, 'Stephen King', '1947-09-21', 'Estadounidense', 'Escritor estadounidense famoso por sus novelas de terror y suspenso.'),
(0, 'J.K. Rowling', '1965-07-31', 'Británica', 'Autora británica conocida por la saga Harry Potter.'),
(0, 'George Orwell', '1903-06-25', 'Británico', 'Escritor y periodista británico, autor de novelas distópicas.'),
(0, 'Antoine de Saint-Exupéry', '1900-06-29', 'Francés', 'Escritor y aviador francés, autor de El Principito.'),
(0, 'Paulo Coelho', '1947-08-24', 'Brasileño', 'Novelista brasileño conocido por obras espirituales y filosóficas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `sinopsis` text NOT NULL,
  `anio_de_publicacion` year(4) NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `tapa_libro` varchar(300) NOT NULL,
  `id_autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo`, `sinopsis`, `anio_de_publicacion`, `disponible`, `tapa_libro`, `id_autor`) VALUES
(0, 'Cien años de soledad', 'Historia de la familia Buendía en el pueblo ficticio de Macondo.', '1967', 1, 'cien_anios.jpg', 1),
(0, 'El amor en los tiempos del cólera', 'Historia de amor que perdura durante décadas.', '1985', 1, 'amor_colera.jpg', 1),
(0, 'Ficciones', 'Colección de cuentos emblemáticos de Borges.', '1944', 1, 'ficciones.jpg', 2),
(0, 'El Aleph', 'Libro de cuentos donde aparece el mítico Aleph.', '1949', 1, 'aleph.jpg', 2),
(0, 'Rayuela', 'Novela experimental considerada una obra maestra.', '1963', 1, 'rayuela.jpg', 3),
(0, 'Bestiario', 'Colección de cuentos fantásticos.', '1951', 1, 'bestiario.jpg', 3),
(0, 'La casa de los espíritus', 'Saga familiar ambientada en Chile.', '1982', 1, 'casa_espiritus.jpg', 4),
(0, 'Eva Luna', 'Historia de una joven narradora llena de imaginación.', '1987', 1, 'eva_luna.jpg', 4),
(0, 'La ciudad y los perros', 'Crítica al sistema militar peruano.', '1963', 1, 'ciudad_perros.jpg', 5),
(0, 'Conversación en La Catedral', 'Reflexión sobre la corrupción política.', '1969', 1, 'catedral.jpg', 5),
(0, 'It', 'Un grupo de amigos enfrenta a una entidad maligna.', '1986', 1, 'it.jpg', 6),
(0, 'El resplandor', 'Una familia vive sucesos aterradores en un hotel.', '1977', 1, 'resplandor.jpg', 6),
(0, 'Harry Potter y la piedra filosofal', 'Inicio de la historia del joven mago.', '1997', 1, 'hp1.jpg', 7),
(0, 'Harry Potter y la cámara secreta', 'Segundo año de Harry en Hogwarts.', '1998', 1, 'hp2.jpg', 7),
(0, '1984', 'Sociedad totalitaria controlada por el Gran Hermano.', '1949', 1, '1984.jpg', 8),
(0, 'Rebelión en la granja', 'Fábula política protagonizada por animales.', '1945', 1, 'granja.jpg', 8),
(0, 'El Principito', 'Relato filosófico sobre la amistad y la vida.', '1943', 1, 'principito.jpg', 9),
(0, 'El Alquimista', 'Viaje espiritual de un joven pastor.', '1988', 1, 'alquimista.jpg', 10),
(0, 'Brida', 'Historia de una joven en búsqueda espiritual.', '1990', 1, 'brida.jpg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `rol` enum('ADMIN','CLIENTE') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contraseña`, `rol`) VALUES
(0, 'webadmin', '$2a$12$UaF6iBv9jMdjNCZxT/GwweKfnZqT9A/tJMdPap0pz08hPZIRo9kIa', 'ADMIN');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

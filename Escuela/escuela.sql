-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-09-2025 a las 00:56:00
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frase`
--

CREATE TABLE `frase` (
  `idfrase` int(11) NOT NULL,
  `texto` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `frase`
--

INSERT INTO `frase` (`idfrase`, `texto`, `autor`) VALUES
(1, 'El éxito es la suma de pequeños esfuerzos repetido', 'Robert Collier'),
(2, 'Cree en ti mismo y todo será posible.', 'Anónimo'),
(3, 'La disciplina es el puente entre metas y logros.', 'Jim Rohn'),
(4, 'El fracaso es la oportunidad de comenzar de nuevo ', 'Henry Ford'),
(5, 'Haz de cada día tu obra maestra.', 'John Wooden'),
(6, 'No sueñes tu vida, vive tu sueño.', 'Anónimo'),
(7, 'El único modo de hacer un gran trabajo es amar lo ', 'Steve Jobs'),
(8, 'Si puedes soñarlo, puedes hacerlo.', 'Walt Disney'),
(9, 'La perseverancia convierte lo imposible en inevita', 'Anónimo'),
(10, 'La actitud positiva lo cambia todo.', 'Anónimo'),
(11, 'Tu tiempo es limitado, no lo malgastes viviendo la', 'Steve Jobs'),
(12, 'El aprendizaje nunca agota la mente.', 'Leonardo da Vinci'),
(13, 'La clave del éxito es empezar antes de estar listo', 'Marie Forleo'),
(14, 'El éxito depende del esfuerzo.', 'Sófocles'),
(15, 'No cuentes los días, haz que los días cuenten.', 'Muhammad Ali'),
(16, 'Cada logro comienza con la decisión de intentarlo.', 'Anónimo'),
(17, 'Haz lo que puedas, con lo que tengas, donde estés.', 'Theodore Roosevelt'),
(18, 'El único límite a tus logros es tu imaginación.', 'Anónimo'),
(19, 'Nunca es tarde para ser lo que podrías haber sido.', 'George Eliot'),
(20, 'El optimismo es la fe que conduce al logro.', 'Helen Keller'),
(21, 'La constancia es la clave para alcanzar cualquier ', 'Anónimo'),
(22, 'El dolor de la disciplina pesa gramos, el dolor de', 'Jim Rohn'),
(23, 'A veces perder es aprender lo que realmente import', 'Anónimo'),
(24, 'Sueña en grande, empieza pequeño, actúa ahora.', 'Robin Sharma'),
(25, 'El éxito no es para los que piensan que pueden, si', 'Anónimo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `idtarea` int(11) NOT NULL,
  `idusuario` int(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `Notarea` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`idtarea`, `idusuario`, `descripcion`, `estado`, `Notarea`) VALUES
(19, 16, 'tarea', 'En progreso', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `pasword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `Nombre`, `pasword`) VALUES
(16, 'Kevin123', '$2y$10$xoJ1HJuRlsXYUk8Gt0pPhe5wqiwtJJdM8S06xdRlGbYjqBqGhqffi'),
(17, 'kevin', '$2y$10$imz/291MBo.Ee0OzKNQlI.T5anTAepGibl.wakLovsDfvp/anxjva'),
(18, 'dalay', '$2y$10$v7wB2kcbRNIcCJka.cJPeuKRLHzFPpMmSs9qZLNBUtRo1oI6BFWAO'),
(19, 'aaaa', '$2y$10$m/qExIg447lzG60Mzgc/WuPrO2gHPz6wBr8RztePzuOYW9eCWJaTe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `frase`
--
ALTER TABLE `frase`
  ADD PRIMARY KEY (`idfrase`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`idtarea`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `frase`
--
ALTER TABLE `frase`
  MODIFY `idfrase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `idtarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

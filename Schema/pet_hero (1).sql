-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-11-2022 a las 20:53:14
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pet_hero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keeper`
--

DROP TABLE IF EXISTS `keeper`;
CREATE TABLE IF NOT EXISTS `keeper` (
  `keeperId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `petSize` varchar(50) NOT NULL,
  `petType` varchar(100) NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `days` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `isActive` varchar(20) NOT NULL,
  PRIMARY KEY (`keeperId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `keeper`
--

INSERT INTO `keeper` (`keeperId`, `userId`, `petSize`, `petType`, `initialDate`, `endDate`, `days`, `price`, `isActive`) VALUES
(2, 6, 'Small', '2', '2022-11-18', '2022-11-19', 'monday,wednesday', 500, '1'),
(6, 4, 'Medium', '1', '2022-11-10', '2022-11-25', 'monday,tuesday,wednesday', 1400, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `petType` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `breed` varchar(25) NOT NULL,
  `size` varchar(25) NOT NULL,
  `description` varchar(50) NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `vaccines` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(250) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`id`, `userId`, `petType`, `name`, `breed`, `size`, `description`, `photo`, `vaccines`, `video`, `isActive`) VALUES
(2, 3, '1', 'Carlos Chan', 'Caniche', 'Small', 'carlos el caniche chan', NULL, NULL, NULL, 1),
(3, 2, '1', 'Trigger', 'Cruza', 'Small', 'el gato trigger', NULL, NULL, NULL, 1),
(4, 3, '3', 'Fisher', 'Golden', 'Small', 'el pez dorado', NULL, NULL, NULL, 1),
(16, 3, '1', 'Charles', 'Stripe', 'Small', 'nice cat', 'https://cdn.pixabay.com/photo/2017/09/01/00/15/png-2702691_960_720.png', 'https://www.signnow.com/preview/100/670/100670453.png', 'https://www.youtube.com/watch?v=1K5h8jUllKc&t=17s', 1),
(17, 3, '1', 'Juan', 'German Shepard', 'Big', 'juan tiene un perro q se llama juan', 'https://toppng.com/uploads/preview/erman-shepherd-png-download-image-german-shepherd-11562976673vb9gniasum.png', 'https://www.pdffiller.com/preview/35/805/35805451/large.png', 'https://www.youtube.com/watch?v=Ug-XdXLG0kk', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pettype`
--

DROP TABLE IF EXISTS `pettype`;
CREATE TABLE IF NOT EXISTS `pettype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pettype`
--

INSERT INTO `pettype` (`id`, `name`) VALUES
(1, 'Dog'),
(2, 'Cat'),
(3, 'Fish');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idOwner` int(10) NOT NULL,
  `idKeeper` int(10) NOT NULL,
  `idPet` int(10) NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `days` varchar(100) NOT NULL,
  `totalPrice` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`id`, `idOwner`, `idKeeper`, `idPet`, `initialDate`, `endDate`, `days`, `totalPrice`, `status`) VALUES
(5, 3, 6, 4, '2022-11-18', '2022-11-23', 'monday', 1400, 'created'),
(3, 3, 5, 4, '2022-11-16', '2022-11-16', 'wednesday', 1000, 'created');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `dni` int(10) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `userType` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `lastname`, `dni`, `phone`, `email`, `userType`) VALUES
(1, 'dbb', '1234', 'Dave', 'Bear', 555155, 5051777, 'db@db.com', 'Owner'),
(3, 'ivanbravo', '1234', 'Ivan', 'Belfort', 46546, 45555, 'student@utn.com', 'Owner'),
(4, 'bbking', '1234', 'BB', 'King', 4544559, 25555, 'bb@king.com', 'Keeper');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

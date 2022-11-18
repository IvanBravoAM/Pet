-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-11-2022 a las 21:45:22
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
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `days` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `isActive` varchar(20) NOT NULL,
  PRIMARY KEY (`keeperId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `keeper`
--

INSERT INTO `keeper` (`keeperId`, `userId`, `petSize`, `initialDate`, `endDate`, `days`, `price`, `isActive`) VALUES
(2, 6, 'Small', '2022-11-18', '2022-11-19', 'Array', 500, '1');

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
  `photo` varchar(50) DEFAULT NULL,
  `vaccines` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`id`, `userId`, `petType`, `name`, `breed`, `size`, `description`, `photo`, `vaccines`, `video`, `isActive`) VALUES
(1, 3, '2', 'Johnson', 'German Shepard', 'Medium', 'juan tiene un perro q se llama juan', NULL, NULL, NULL, 1),
(2, 3, '2', 'Carlos', 'Caniche', 'Small', 'carlos el caniche', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pettype`
--

DROP TABLE IF EXISTS `pettype`;
CREATE TABLE IF NOT EXISTS `pettype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pettype`
--

INSERT INTO `pettype` (`id`, `name`) VALUES
(1, 'Snake');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`id`, `idOwner`, `idKeeper`, `idPet`, `initialDate`, `endDate`, `days`, `totalPrice`, `status`) VALUES
(1, 3, 1, 5, '2022-11-19', '2022-11-20', 'sunday', 2000, 'created');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `lastname`, `dni`, `phone`, `email`, `userType`) VALUES
(1, 'dbb', '1234', 'Dave', 'Bear', 555155, 5051777, 'db@db.com', 'Owner');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

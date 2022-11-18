CREATE DATABASE pet_hero;

USE pet_hero;

CREATE TABLE `pet` (
  `id` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `petType` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `breed` varchar(25) NOT NULL,
  `size` varchar(25) NOT NULL,
  `description` varchar(50) NOT NULL,
  `photo` varchar(50),
  `vaccines` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `video` varchar(50),
  `isActive` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `pettype` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

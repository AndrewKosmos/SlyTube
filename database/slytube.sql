-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 29 2015 г., 11:14
-- Версия сервера: 5.6.15-log
-- Версия PHP: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `slytube`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Login` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Mail` varchar(250) DEFAULT NULL,
  `Avatar` varchar(250) DEFAULT NULL,
  `salt` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `Login`, `Password`, `Mail`, `Avatar`, `salt`) VALUES
(1, 'Andrew', 'd022e54e128a2a63b7e03dfcddea9064', 'baggik42@rambler.ru', NULL, '563e4a363dfe7'),
(2, 'Vovan', '6d1437b52f1f7bee6498160fdcb70cee', 'bla@bla.com', NULL, '56478eed29707');

-- --------------------------------------------------------

--
-- Структура таблицы `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Path` varchar(250) NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `videos`
--

INSERT INTO `videos` (`ID`, `Name`, `Description`, `Path`, `userID`) VALUES
(1, 'VIDEO1', 'bla-bla', 'videos/VIDEO1.mp4', 2),
(2, 'GTR Drift COOl', 'echoooooo', 'videos/GTR Drift COOl.mp4', 1),
(3, 'Skyline mountain ride', 'Mountain raceway', 'videos/Skyline mountain ride.mp4', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

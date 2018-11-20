-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 20 2018 г., 17:26
-- Версия сервера: 10.2.12-MariaDB
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id7095807_database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ad`
--

CREATE TABLE `ad` (
  `a_id` int(50) NOT NULL,
  `u_id` int(11) NOT NULL,
  `a_time` datetime(4) NOT NULL,
  `a_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `a_tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `a_price` decimal(20,2) NOT NULL,
  `a_city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `a_descr` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `a_views` int(50) NOT NULL DEFAULT 0,
  `a_comment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `a_delete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ad`
--

INSERT INTO `ad` (`a_id`, `u_id`, `a_time`, `a_title`, `a_tag`, `a_price`, `a_city`, `a_descr`, `a_views`, `a_comment`, `a_delete`) VALUES
(28, 55, '2018-11-08 23:06:14.0000', 'Danil', 'service', 1234.00, '', 'qwerty is it', 0, '', 0),
(29, 24, '2018-11-08 23:08:14.0000', 'Daniel', 'service', 2345.00, '', 'qwerty is very cool', 0, '', 1),
(30, 19, '2018-11-08 23:11:08.0000', 'Meme', 'service', 3456.00, '', 'Admin is great', 0, '', 0),
(31, 19, '2018-11-08 23:11:31.0000', 'Meme', 'service', 3456.00, '', 'Admin is great', 0, '', 1),
(32, 24, '2018-11-11 23:56:12.0000', 'Ttest1', 'shoes', 800.00, '', 'All is cool', 0, '', 0),
(34, 24, '2018-11-13 14:45:30.0000', '123', 'dress', 123.00, '', 'qwerty is very cool', 0, '', 0),
(35, 24, '2018-11-13 14:56:04.0000', 'Ret', 'dress', 800.00, '', 'Daniel is cool', 0, '', 0),
(36, 24, '2018-11-13 15:11:59.0000', 'qwrerwt', 'service', 345345.00, '', 'reterter', 0, '', 0),
(37, 24, '2018-11-13 15:12:26.0000', 'rtyrty', 'service', 34534.00, '', 'ghjhgjhgj', 0, '', 0),
(38, 24, '2018-11-14 16:57:31.0000', 'Цукер', 'service', 100.00, '', 'Укусно', 0, '', 0),
(39, 24, '2018-11-14 18:33:52.0000', '123', 'service', 123.00, '', 'qwerty is very cool', 0, '', 1),
(40, 24, '2018-11-14 18:35:22.0000', '456', 'dress', 123.00, '', 'Dtest1', 0, '', 1),
(41, 24, '2018-11-19 17:50:53.0000', 'Ttest1', 'shoes', 123.00, '', '123', 0, '', 0),
(42, 24, '2018-11-19 17:53:19.0000', 'Danil', 'service', 213.00, '', '123', 0, '', 0),
(43, 24, '2018-11-19 17:59:21.0000', 'Danil', 'service', 123.00, '', '123', 0, '', 0);

--
-- Триггеры `ad`
--
DELIMITER $$
CREATE TRIGGER `dateinsert` BEFORE INSERT ON `ad` FOR EACH ROW SET NEW.a_time =  DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 2 HOUR)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `u_id` int(11) UNSIGNED NOT NULL,
  `u_fio` varchar(50) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `activation` varchar(32) NOT NULL,
  `u_numtel` varchar(50) NOT NULL,
  `u_adres` varchar(50) NOT NULL,
  `u_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`u_id`, `u_fio`, `u_email`, `u_password`, `activation`, `u_numtel`, `u_adres`, `u_time`) VALUES
(19, 'admin', 'admin@gmail.com', '$2y$10$J387UAiVpkjy1aL2NgBelOXyJsUNg6t22H4vAOU9hbJjmMXsUm6Lu', '', '', '', '2018-11-06 18:44:36'),
(24, 'me', 'me@gmail.com', '$2y$10$peQwYQpZVUpbiKD86eZESuZRMsm0feYvSp7xvcuxot/dee.JOcbGe', '', '', '', '2018-11-06 18:44:36'),
(55, 'Jester', 'jester1606@gmail.com', '$2y$10$U2JjaOWztfCTYc3AK3jqEO1N4CLi/Hk/.QKA/fIHjsNoq.GvpjJee', '', '', '', '2018-11-08 23:04:50'),
(59, 'FATE', 'luchnykov.d@gmail.com', '$2y$10$d5G33amh25VE2flVVScohe7ZkIuueRZTRM287qdJ9B4GSRnxivz7C', '', '', '', '2018-11-14 16:06:16');

--
-- Триггеры `user`
--
DELIMITER $$
CREATE TRIGGER `dateinsert2` BEFORE INSERT ON `user` FOR EACH ROW SET NEW.u_time =  DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 2 HOUR)
$$
DELIMITER ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`a_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ad`
--
ALTER TABLE `ad`
  MODIFY `a_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

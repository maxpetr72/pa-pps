-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 30 2018 г., 13:03
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pa`
--

-- --------------------------------------------------------

--
-- Структура таблицы `papps_osn_print_type`
--

CREATE TABLE `papps_osn_print_type` (
  `id` int(11) NOT NULL,
  `pr_type_name_en` varchar(50) NOT NULL,
  `pr_type_name_ru` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `papps_osn_print_type`
--

INSERT INTO `papps_osn_print_type` (`id`, `pr_type_name_en`, `pr_type_name_ru`) VALUES
(1, 'Flexo', 'Флексо'),
(2, 'Trafaret', 'Трафарет'),
(3, 'Kongrev', 'Конгрев'),
(4, 'Emboss', 'Тиснение'),
(5, 'Knife', 'Нож');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `papps_osn_print_type`
--
ALTER TABLE `papps_osn_print_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pr_type_name_en` (`pr_type_name_en`),
  ADD UNIQUE KEY `pr_type_name_ru` (`pr_type_name_ru`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `papps_osn_print_type`
--
ALTER TABLE `papps_osn_print_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

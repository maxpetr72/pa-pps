-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 30 2018 г., 13:10
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
-- Структура таблицы `papps_osn_equpment_list`
--

CREATE TABLE `papps_osn_equpment_list` (
  `id` int(11) NOT NULL,
  `eq_type_name_id` int(11) NOT NULL,
  `eq_list` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `papps_osn_equpment_list`
--

INSERT INTO `papps_osn_equpment_list` (`id`, `eq_type_name_id`, `eq_list`) VALUES
(1, 1, 'A9'),
(2, 1, 'A10'),
(3, 2, 'S5'),
(4, 3, 'F');

-- --------------------------------------------------------

--
-- Структура таблицы `papps_osn_equpment_type`
--

CREATE TABLE `papps_osn_equpment_type` (
  `id` int(11) NOT NULL,
  `eq_type_name` varchar(50) NOT NULL,
  `eq_type_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `papps_osn_equpment_type`
--

INSERT INTO `papps_osn_equpment_type` (`id`, `eq_type_name`, `eq_type_code`) VALUES
(1, 'Arsoma', 'A'),
(2, 'RCS', 'S'),
(3, 'Berra', 'F');

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

-- --------------------------------------------------------

--
-- Структура таблицы `papps_osn_raports`
--

CREATE TABLE `papps_osn_raports` (
  `id` int(11) NOT NULL,
  `z` int(11) NOT NULL,
  `mm` decimal(8,3) NOT NULL,
  `is_uses` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `papps_osn_raports`
--

INSERT INTO `papps_osn_raports` (`id`, `z`, `mm`, `is_uses`) VALUES
(1, 1, '3.175', 0),
(2, 2, '6.350', 0),
(3, 3, '9.525', 0),
(4, 4, '12.700', 0),
(5, 5, '15.875', 0),
(6, 6, '19.050', 0),
(7, 7, '22.225', 0),
(8, 8, '25.400', 0),
(9, 9, '28.575', 0),
(10, 10, '31.750', 0),
(11, 11, '34.925', 0),
(12, 12, '38.100', 0),
(13, 13, '41.275', 0),
(14, 14, '44.450', 0),
(15, 15, '47.625', 0),
(16, 16, '50.800', 0),
(17, 17, '53.975', 0),
(18, 18, '57.150', 0),
(19, 19, '60.325', 0),
(20, 20, '63.500', 0),
(21, 21, '66.675', 0),
(22, 22, '69.850', 0),
(23, 23, '73.025', 0),
(24, 24, '76.200', 0),
(25, 25, '79.375', 0),
(26, 26, '82.550', 0),
(27, 27, '85.725', 0),
(28, 28, '88.900', 0),
(29, 29, '92.075', 0),
(30, 30, '95.250', 0),
(31, 31, '98.425', 0),
(32, 32, '101.600', 0),
(33, 33, '104.775', 0),
(34, 34, '107.950', 0),
(35, 35, '111.125', 0),
(36, 36, '114.300', 0),
(37, 37, '117.475', 0),
(38, 38, '120.650', 0),
(39, 39, '123.825', 0),
(40, 40, '127.000', 0),
(41, 41, '130.175', 0),
(42, 42, '133.350', 0),
(43, 43, '136.525', 0),
(44, 44, '139.700', 0),
(45, 45, '142.875', 0),
(46, 46, '146.050', 0),
(47, 47, '149.225', 0),
(48, 48, '152.400', 0),
(49, 49, '155.575', 0),
(50, 50, '158.750', 0),
(51, 51, '161.925', 0),
(52, 52, '165.100', 0),
(53, 53, '168.275', 0),
(54, 54, '171.450', 0),
(55, 55, '174.625', 0),
(56, 56, '177.800', 0),
(57, 57, '180.975', 0),
(58, 58, '184.150', 0),
(59, 59, '187.325', 0),
(60, 60, '190.500', 0),
(61, 61, '193.675', 0),
(62, 62, '196.850', 0),
(63, 63, '200.025', 0),
(64, 64, '203.200', 0),
(65, 65, '206.375', 0),
(66, 66, '209.550', 1),
(67, 67, '212.725', 0),
(68, 68, '215.900', 0),
(69, 69, '219.075', 0),
(70, 70, '222.250', 0),
(71, 71, '225.425', 0),
(72, 72, '228.600', 0),
(73, 73, '231.775', 0),
(74, 74, '234.950', 0),
(75, 75, '238.125', 0),
(76, 76, '241.300', 1),
(77, 77, '244.475', 0),
(78, 78, '247.650', 1),
(79, 79, '250.825', 0),
(80, 80, '254.000', 1),
(81, 81, '257.175', 0),
(82, 82, '260.350', 0),
(83, 83, '263.525', 0),
(84, 84, '266.700', 0),
(85, 85, '269.875', 0),
(86, 86, '273.050', 0),
(87, 87, '276.225', 0),
(88, 88, '279.400', 1),
(89, 89, '282.575', 1),
(90, 90, '285.750', 0),
(91, 91, '288.925', 1),
(92, 92, '292.100', 0),
(93, 93, '295.275', 0),
(94, 94, '298.450', 1),
(95, 95, '301.625', 0),
(96, 96, '304.800', 1),
(97, 97, '307.975', 0),
(98, 98, '311.150', 0),
(99, 99, '314.325', 0),
(100, 100, '317.500', 0),
(101, 101, '320.675', 0),
(102, 102, '323.850', 1),
(103, 103, '327.025', 0),
(104, 104, '330.200', 1),
(105, 105, '333.375', 1),
(106, 106, '336.550', 0),
(107, 107, '339.725', 0),
(108, 108, '342.900', 1),
(109, 109, '346.075', 0),
(110, 110, '349.250', 0),
(111, 111, '352.425', 0),
(112, 112, '355.600', 1),
(113, 113, '358.775', 0),
(114, 114, '361.950', 0),
(115, 115, '365.125', 0),
(116, 116, '368.300', 1),
(117, 117, '371.475', 1),
(118, 118, '374.650', 0),
(119, 119, '377.825', 0),
(120, 120, '381.000', 1),
(121, 121, '384.175', 0),
(122, 122, '387.350', 1),
(123, 123, '390.525', 0),
(124, 124, '393.700', 0),
(125, 125, '396.875', 1),
(126, 126, '400.050', 0),
(127, 127, '403.225', 0),
(128, 128, '406.400', 1),
(129, 129, '409.575', 0),
(130, 130, '412.750', 0),
(131, 131, '415.925', 0),
(132, 132, '419.100', 0),
(133, 133, '422.275', 1),
(134, 134, '425.450', 0),
(135, 135, '428.625', 0),
(136, 136, '431.800', 0),
(137, 137, '434.975', 0),
(138, 138, '438.150', 0),
(139, 139, '441.325', 0),
(140, 140, '444.500', 0),
(141, 141, '447.675', 0),
(142, 142, '450.850', 0),
(143, 143, '454.025', 0),
(144, 144, '457.200', 0),
(145, 145, '460.375', 0),
(146, 146, '463.550', 0),
(147, 147, '466.725', 0),
(148, 148, '469.900', 0),
(149, 149, '473.075', 0),
(150, 150, '476.250', 0),
(151, 151, '479.425', 0),
(152, 152, '482.600', 1),
(153, 153, '485.775', 0),
(154, 154, '488.950', 0),
(155, 155, '492.125', 0),
(156, 156, '495.300', 0),
(157, 157, '498.475', 0),
(158, 158, '501.650', 0),
(159, 159, '504.825', 0),
(160, 160, '508.000', 0),
(161, 161, '511.175', 0),
(162, 162, '514.350', 0),
(163, 163, '517.525', 0),
(164, 164, '520.700', 0),
(165, 165, '523.875', 0),
(166, 166, '527.050', 0),
(167, 167, '530.225', 0),
(168, 168, '533.400', 0),
(169, 169, '536.575', 0),
(170, 170, '539.750', 0),
(171, 171, '542.925', 0),
(172, 172, '546.100', 0),
(173, 173, '549.275', 0),
(174, 174, '552.450', 0),
(175, 175, '555.625', 0),
(176, 176, '558.800', 1),
(177, 177, '561.975', 0),
(178, 178, '565.150', 0),
(179, 179, '568.325', 0),
(180, 180, '571.500', 0),
(181, 181, '574.675', 0),
(182, 182, '577.850', 0),
(183, 183, '581.025', 0),
(184, 184, '584.200', 0),
(185, 185, '587.375', 0),
(186, 186, '590.550', 0),
(187, 187, '593.725', 0),
(188, 188, '596.900', 0),
(189, 189, '600.075', 0),
(190, 190, '603.250', 0),
(191, 191, '606.425', 0),
(192, 192, '609.600', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `papps_osn_equpment_list`
--
ALTER TABLE `papps_osn_equpment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `papps_osn_equpment_list_eq_type_name_id_idx` (`eq_type_name_id`),
  ADD KEY `papps_osn_equpment_list_eq_list_idx` (`eq_list`);

--
-- Индексы таблицы `papps_osn_equpment_type`
--
ALTER TABLE `papps_osn_equpment_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eq_type_name` (`eq_type_name`),
  ADD UNIQUE KEY `eq_type_code` (`eq_type_code`);

--
-- Индексы таблицы `papps_osn_print_type`
--
ALTER TABLE `papps_osn_print_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pr_type_name_en` (`pr_type_name_en`),
  ADD UNIQUE KEY `pr_type_name_ru` (`pr_type_name_ru`);

--
-- Индексы таблицы `papps_osn_raports`
--
ALTER TABLE `papps_osn_raports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `MM` (`mm`),
  ADD UNIQUE KEY `Z` (`z`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `papps_osn_equpment_list`
--
ALTER TABLE `papps_osn_equpment_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `papps_osn_equpment_type`
--
ALTER TABLE `papps_osn_equpment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `papps_osn_print_type`
--
ALTER TABLE `papps_osn_print_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `papps_osn_raports`
--
ALTER TABLE `papps_osn_raports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

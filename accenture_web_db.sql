-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 03 2021 г., 18:50
-- Версия сервера: 5.7.31
-- Версия PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `accenture_web_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `defect_frequency` double DEFAULT NULL,
  `delta` double DEFAULT NULL,
  `dataset` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id`, `title`, `defect_frequency`, `delta`, `dataset`) VALUES
(1, 'Гречка', 10, 15, '[{\"src\": \"blob:http://185.251.91.22/036e7fce-6725-4189-95fc-c8321543ab97\", \"title\": \"UOlC_6cE83E.jpg\", \"rawFile\": {\"path\": \"UOlC_6cE83E.jpg\"}}]');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `number_vagon` int(11) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `defect_percent` int(11) DEFAULT NULL,
  `defect_weight` int(11) DEFAULT NULL,
  `vagons` json DEFAULT NULL,
  `id_warehouse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `number_vagon`, `weight`, `date`, `status`, `defect_percent`, `defect_weight`, `vagons`, `id_warehouse`) VALUES
(1, 1, 200, NULL, NULL, 10, 15, '\"5\"', NULL),
(2, 34566, 400, NULL, NULL, 20, 25, '\"5\"', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `reception_point`
--

CREATE TABLE `reception_point` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `id_technologist` int(11) DEFAULT NULL,
  `id_technician` int(11) DEFAULT NULL,
  `stream_url` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `queue_vagons` json DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reception_point`
--

INSERT INTO `reception_point` (`id`, `title`, `id_technologist`, `id_technician`, `stream_url`, `status`, `queue_vagons`, `id_order`) VALUES
(1, 'test', 1, 2, 'fasdsad', 0, NULL, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `orders` json DEFAULT NULL,
  `id_technologist` int(11) DEFAULT NULL,
  `id_technician` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shift`
--

INSERT INTO `shift` (`id`, `date_start`, `date_end`, `orders`, `id_technologist`, `id_technician`) VALUES
(1, NULL, NULL, '[\"1\"]', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `is_admin` varchar(10) DEFAULT NULL,
  `reset_pass_token` varchar(200) DEFAULT NULL,
  `auth_key` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `is_admin`, `reset_pass_token`, `auth_key`) VALUES
(1, 'admin@gmail.com', '$2y$13$PlT2VrFoyXYbLrZ/Q7aST.uhcv/wEbTBMxrlw4deO.D2UjrqeAZIi', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_refresh_tokens`
--

CREATE TABLE `user_refresh_tokens` (
  `user_refresh_tokenID` int(10) UNSIGNED NOT NULL,
  `urf_userID` int(10) UNSIGNED NOT NULL,
  `urf_token` varchar(1000) NOT NULL,
  `urf_ip` varchar(50) NOT NULL,
  `urf_user_agent` varchar(1000) NOT NULL,
  `urf_created` datetime NOT NULL,
  `available` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_refresh_tokens`
--

INSERT INTO `user_refresh_tokens` (`user_refresh_tokenID`, `urf_userID`, `urf_token`, `urf_ip`, `urf_user_agent`, `urf_created`, `available`) VALUES
(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NDcwMjQsImV4cCI6MTY0MTAzOTAyNCwidWlkIjoiMSJ9.c2exmzwiHwNP0eCpPL_6e_H_BxHZGIiXAXCek0PXooo', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 15:10:24', 1),
(2, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NDcwMzIsImV4cCI6MTY0MTAzOTAzMiwidWlkIjoiMSJ9.ICC8Nesm98COAyreCeAKMTbYUbu2JL6jnEkAWHbasG4', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 15:10:32', 1),
(3, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NDk3MDMsImV4cCI6MTY0MTA0MTcwMywidWlkIjoiMSJ9.2u9gjJ82-Qn_Ces4GtVCQVne83g8v5DXANXJgnZAmqA', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 15:55:03', 1),
(4, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NDk3OTcsImV4cCI6MTY0MTA0MTc5NywidWlkIjoiMSJ9.f-swPm9dbukNAf6pfmrrxnS6AvHPNQg2U0MmpoL1X4U', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 15:56:37', 0),
(5, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTA3NTcsImV4cCI6MTY0MTA0Mjc1NywidWlkIjoiMSJ9.EP8m_qo18IIwwas6A9eP3yegRtHCv6yOYl5dtb_Yc2A', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:12:37', 1),
(6, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTE2ODMsImV4cCI6MTY0MTA0MzY4MywidWlkIjoiMSJ9.h2AnBJLq2kj8DR6k0VRjavNl1hpF862PNxD7TsdeMWA', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:28:03', 0),
(7, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTE3NDQsImV4cCI6MTY0MTA0Mzc0NCwidWlkIjoiMSJ9.Fj-Gs769CKl06vmEAwOVyWvuGD52KRrzMfApCJdnVrI', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:29:04', 1),
(8, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTE4NzksImV4cCI6MTY0MTA0Mzg3OSwidWlkIjoiMSJ9.hZbflSnNw4mDgtOQKm4rHc430FySh8zVIzmn2jgmQX8', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:31:19', 0),
(9, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTIxOTksImV4cCI6MTY0MTA0NDE5OSwidWlkIjoiMSJ9.UP_pkxPAKAMGINoNvgoDJ20w2krizi-RmnFNzDionkI', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:36:39', 1),
(10, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTIyMjMsImV4cCI6MTY0MTA0NDIyMywidWlkIjoiMSJ9.WBhx-eMe8EgW2j79rpf-rqXF34kHkwHIqlAMwl2YgFM', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:37:03', 1),
(11, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTIzNjIsImV4cCI6MTY0MTA0NDM2MiwidWlkIjoiMSJ9.IFVmWUSp_MvRzekzoHzH4dgA9DkiQgUypv7jIurxRJQ', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:39:22', 1),
(12, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTI0OTIsImV4cCI6MTY0MTA0NDQ5MiwidWlkIjoiMSJ9.jHtitCPdXR1XmGNKRtk-LBmpG2x537o_Xe13TDCJ3EI', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:41:32', 1),
(13, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTI1MDQsImV4cCI6MTY0MTA0NDUwNCwidWlkIjoiMSJ9.fB-ha_6VIO0eRAvdKKVrTlkFEMrCgW4AgZ9PPY5fNLc', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:41:44', 1),
(14, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTI1NTEsImV4cCI6MTY0MTA0NDU1MSwidWlkIjoiMSJ9.ZXyd_XHFJGUhhnEgs81bX_VfdbSTBc1UXHdXpvcba8U', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:42:31', 1),
(15, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2Mzg0NTI3MTQsImV4cCI6MTY0MTA0NDcxNCwidWlkIjoiMSJ9.SkyDFkAT74OONOwjuLajeKMIfBLxdAiRUb733LSXjAA', '127.0.0.1', 'PostmanRuntime/7.26.8', '2021-12-02 16:45:14', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `vagon`
--

CREATE TABLE `vagon` (
  `id` int(11) NOT NULL,
  `auto_number` varchar(45) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `fixation` json DEFAULT NULL,
  `id_technologist` int(11) DEFAULT NULL,
  `id_technician` int(11) DEFAULT NULL,
  `declared_rejection_rate` int(11) DEFAULT NULL,
  `actual_scrap_rate` int(11) DEFAULT NULL,
  `defect` double DEFAULT NULL,
  `pure_material` double DEFAULT NULL,
  `id_provider` int(11) DEFAULT NULL,
  `id_reception_point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vagon`
--

INSERT INTO `vagon` (`id`, `auto_number`, `weight`, `status`, `fixation`, `id_technologist`, `id_technician`, `declared_rejection_rate`, `actual_scrap_rate`, `defect`, `pure_material`, `id_provider`, `id_reception_point`) VALUES
(1, '12345', 100, 2, NULL, 1, 1, 10, 12, 13, 20, 1, 1),
(2, '123', 100, 0, NULL, 1, 2, 20, 13, 10, 12, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `reception_points` json DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `fullness` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `warehouse`
--

INSERT INTO `warehouse` (`id`, `reception_points`, `volume`, `fullness`) VALUES
(35, NULL, 100, 1),
(36, NULL, 300, 3),
(37, NULL, 200, 2),
(38, NULL, 500, 4),
(39, NULL, 750, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `reception_point` json DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id`, `name`, `status`, `reception_point`, `type`) VALUES
(1, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL),
(4, '32131', NULL, NULL, NULL),
(5, '321', NULL, NULL, NULL),
(6, '32131', '321', NULL, 23),
(7, 'Алексей', '1', NULL, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reception_point`
--
ALTER TABLE `reception_point`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Индексы таблицы `user_refresh_tokens`
--
ALTER TABLE `user_refresh_tokens`
  ADD PRIMARY KEY (`user_refresh_tokenID`);

--
-- Индексы таблицы `vagon`
--
ALTER TABLE `vagon`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `reception_point`
--
ALTER TABLE `reception_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user_refresh_tokens`
--
ALTER TABLE `user_refresh_tokens`
  MODIFY `user_refresh_tokenID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `vagon`
--
ALTER TABLE `vagon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

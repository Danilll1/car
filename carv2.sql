-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 13 2025 г., 15:46
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `v3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`id`, `name`) VALUES
(2, 'Kia K5'),
(3, 'Kia Seed');

-- --------------------------------------------------------

--
-- Структура таблицы `oplata`
--

CREATE TABLE `oplata` (
  `id` int NOT NULL,
  `oplata` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_car` int NOT NULL,
  `id_status` int NOT NULL,
  `booking_date` datetime DEFAULT NULL,
  `prava` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prava_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `oplata` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `id_user`, `id_car`, `id_status`, `booking_date`, `prava`, `prava_date`, `contact`, `adress`, `oplata`, `admin_message`) VALUES
(36, 9, 3, 3, '2025-06-13 20:37:00', '11 11 111111', '2025-06-22', '1', '1', 'Наличные', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `code`, `name`) VALUES
(1, 'user', 'Зарегистрированный пользователь'),
(2, 'admin', 'Администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `code`, `name`) VALUES
(1, 'new', 'На проверке'),
(3, 'canceled', 'Отменено'),
(4, 'confirmed', 'Подтверждено');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `id_role` int NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `driver_license` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `id_role`, `password`, `full_name`, `phone`, `email`, `driver_license`) VALUES
(3, 2, 'user', 'Иванов Иван Иванович', '91111111111', 'user@user.ru', '11 11 111111'),
(5, 1, '$2y$12$7bKrofMEUnBLyOlTvHy5le9..7ug4.8IjKtpR.wnhDv9N0SRMcL9y', '123', '123', '123@mail.ri', '123'),
(9, 2, '$2y$12$ZYCxHKctGQ85Lgj6piU/Hu1c0xVuxCe531olfULCO0Yjrrri5/Rvi', '111', '111', '111@mail.ru', '111'),
(15, 1, '$2y$12$fHymE5O6Nt0Uoh43qH9D4.3Wb7PHJdGvvMGb.DOgq/QDKNSRtBS5S', 'rfewrf', '+7 111 111 11 11', 'ewdfwe@mail.ru', 'wedw'),
(16, 1, '$2y$12$4DLSSOKvrKhdL4czXSv0hOorcihcIksgbyCFiCk2DlV6pkP2EjWyS', 'Kozlov Danil Adnreevich', '+7 952 677 78 89', 'Danil@mail.ru', 'Danil'),
(17, 1, '$2y$12$CRajuSe7UPHnZVkzntKCR.hvtp3.uBDYPVjM386YFjgHPgO5wOZ/.', 'dfwed', '+7 111 111 11 11', 'wedw@mail.ru', 'dswdw'),
(18, 1, '$2y$12$jR5yknOv2x2srtEfgG89Ce9.zIr1EHWKraHpAF9Z7jC8ecgqeWYQK', '111', '+7 111 111 11', '111@mail.ru', '1d111'),
(19, 1, '$2y$12$rdEOY0UwNhuRNzyMcCYz9OhhokEXZ2CUgQs6V33tm1BpPCrvfvvLW', '123', '+7 111 111 11 11', '123@mail.ru', '123'),
(20, 1, '$2y$12$wpNfJjIPYaXtIR94hYgxyujHMk4xiEyqA4WxOF4zrCkY3hjnb5ssC', '123', '+7 111 111 11 11', '123@mail.ru', '123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oplata`
--
ALTER TABLE `oplata`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_car` (`id_car`) USING BTREE;

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `oplata`
--
ALTER TABLE `oplata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`id_car`) REFERENCES `car` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

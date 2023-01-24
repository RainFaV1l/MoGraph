-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 18 2022 г., 03:20
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
-- База данных: `MoGraph`
--

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(250) NOT NULL,
  `category` int NOT NULL DEFAULT '1',
  `number_of_hours` int NOT NULL DEFAULT '0',
  `author_id` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `price`, `created_at`, `path`, `category`, `number_of_hours`, `author_id`) VALUES
(14, 'Merrill Giles', 'Ut eaque sit rerum ', 920, '2022-11-17 17:29:54', 'img/courses/16687061943.png', 1, 46, 1),
(15, 'McKenzie Gallagher', 'Tempore voluptatem ', 830, '2022-11-17 17:30:04', 'img/courses/16687062042.png', 2, 93, 1),
(16, 'Walker Hyde', 'Cupiditate suscipit ', 144, '2022-11-17 17:30:21', 'img/courses/16687062211.png', 1, 43, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `courses_category`
--

CREATE TABLE `courses_category` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `courses_category`
--

INSERT INTO `courses_category` (`id`, `name`) VALUES
(1, 'Junior'),
(2, 'Middle'),
(3, 'Pro');

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int NOT NULL,
  `path` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `course_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `path`, `name`, `description`, `course_id`) VALUES
(6, 'video/courses/16687092221667997725loon-on-the-lake (Original).mp4', 'Shaeleigh Bryan', 'Quas exercitation vo', 14),
(7, 'video/courses/16687092311667997725loon-on-the-lake (Original).mp4', 'Preston Kelley', 'Labore quibusdam ut ', 14);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `email`, `message`) VALUES
(1, 'fawf@fwf.fwf', 'fwafawfaw'),
(2, 'afwfawf@fwwf.fwwf', 'fwwfwf'),
(3, 'wfawf@wfwf.wfwf', 'wfwf'),
(4, 'fawfw@fwfw.fwf', 'wfwfwafwaf'),
(5, 'afawf@wfwf.fwf', 'fawfwafawf'),
(6, 'faegesg@wfawf.afwf', 'awfawfaf');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `subscribe`
--

INSERT INTO `subscribe` (`id`, `email`) VALUES
(1, 'test@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'uploads/avatars/default-avatar-profile.jpg',
  `role` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `tel`, `password`, `avatar`, `role`) VALUES
(1, 'Админ', 'Админский', 'admin@mail.ru', '+7 (890) 896 0895', '$2y$10$T61oTbOT1e3138Kn8V3O3Oy3mErWwzfEvzTGSLC.z9obnPNxXft0a', 'img/courses/16687062751668024608agefis-qh-mar1Tzo8-unsplash.jpg', 3),
(2, 'Пользователь', 'Пользовательский', 'user@mail.ru', '+7 (905) 234 5113', '$2y$10$oQzCdVWAU1sIr.2vT5MIVeR3Sk1Rm4pofmv5PRZ4iLHae3h6t6h2e', 'uploads/avatars/default-avatar-profile.jpg', 1),
(3, 'finale_test', 'finale_test', 'finale_test@mail.ru', '+7 (987) 858 8898', '$2y$10$Qf/uXjDRwiNTULmpw/WQduIFwHaZYgcPL/tbxL22DRhM0gfQPevwe', 'uploads/avatars/default-avatar-profile.jpg', 1),
(4, 'finale', 'finale', 'finale@mail.ru', '+7 (464) 646 4634', '$2y$10$0BkSBYojCWYIpr6skE28k.x1nfouNGpL4D4PurDokOX29tCN.u44K', 'uploads/avatars/default-avatar-profile.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `userscourses`
--

CREATE TABLE `userscourses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `course_id` int NOT NULL,
  `created at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `userscourses`
--

INSERT INTO `userscourses` (`id`, `user_id`, `course_id`, `created at`) VALUES
(1, 2, 1, '2022-11-09 15:21:04'),
(2, 1, 6, '2022-11-17 11:03:16'),
(3, 2, 6, '2022-11-17 11:07:33'),
(4, 2, 8, '2022-11-17 11:38:59'),
(5, 4, 16, '2022-11-17 18:17:51'),
(6, 4, 14, '2022-11-17 18:42:34');

-- --------------------------------------------------------

--
-- Структура таблицы `users_category`
--

CREATE TABLE `users_category` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users_category`
--

INSERT INTO `users_category` (`id`, `name`) VALUES
(1, 'Пользователь'),
(2, 'Преподаватель'),
(3, 'Администратор');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Индексы таблицы `courses_category`
--
ALTER TABLE `courses_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Индексы таблицы `userscourses`
--
ALTER TABLE `userscourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Индексы таблицы `users_category`
--
ALTER TABLE `users_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `courses_category`
--
ALTER TABLE `courses_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `userscourses`
--
ALTER TABLE `userscourses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users_category`
--
ALTER TABLE `users_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`category`) REFERENCES `courses_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `users_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

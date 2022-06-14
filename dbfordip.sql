-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 14 2022 г., 19:45
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dbfordip`
--

-- --------------------------------------------------------

--
-- Структура таблицы `finding_team_members`
--

CREATE TABLE `finding_team_members` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `finding_team_members`
--

INSERT INTO `finding_team_members` (`id`, `project_id`, `description`, `post`) VALUES
(3, 25, 'Необходим разработчик программного обеспечения', 'Разработчик'),
(4, 26, 'Нужен человек, который будет иллюстрировать по одному фрагменту на главу', 'Иллюстратор');

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `project_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `project_id`) VALUES
(24, 11, 25),
(75, 8, 25);

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `project_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `st_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `links` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `like` int NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` date NOT NULL,
  `moderation` int NOT NULL DEFAULT '0',
  `m_message` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'Проект проходит модерацию. По ее окончанию проект будет виден в каталоге, иначе у вас в профиле.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`project_id`, `name`, `st_description`, `description`, `links`, `like`, `status`, `date`, `moderation`, `m_message`) VALUES
(25, 'Проект ...', 'Краткое описание проекта', 'Полное описание проекта', NULL, 2, 'Идея/задумка', '2022-06-06', 1, 'Проект проходит модерацию. По ее окончанию проект будет виден в каталоге, иначе у вас в профиле.	'),
(26, 'Project 2', 'Пишу о Данте и его \"Божественной Комедии\"', 'Данте и \"Комедия\" играют важную роль в истории развития литературы, поэтому я решила посвятить ему сайт, в котором разработаю подробную карту всех трёх царств и разной величины пересказы его работы. Дополнительно прикреплю оригинальную версию \"Комедии\" для тех, кто хочет проверить свои знания в итальянском языке, и так же для студентов будет доступен читательский дневник с полным разбором композиции и анализом итальянской поэмы. ', NULL, 0, 'Идея/задумка', '2022-06-06', 1, 'Проект проходит модерацию. По ее окончанию проект будет виден в каталоге, иначе у вас в профиле.	'),
(27, 'Разработка сайта студенческих проектов', 'Сайт направлен на помощь студентам, создающим свои первые проекты', 'Большинство идей приходят случайно в процессе работы, но часто они забываются или не реализовываются из-за недостатка знаний, финансов и тд. Особенно это относится к студентам. Очень часто хорошие идеи учеников не выходят дальше курсовой работы или домашнего проекта. Из-за этого подростки теряют возможность воплотить в жизнь их задумки.\r\n<br>Цель: \r\n<br>\r\n<br>Реализовать платформу, которая даёт возможность студентам рассказать другим людям о своей идее, найти товарищей в команду и инвестиции, и в конечном счете реализовать свой проект.\r\n<br>\r\n<br>Задачи: \r\n<br>\r\n<br>Создать макет каталога студенческих проектов\r\n<br>Реализовать каталог студенческих проектов\r\n<br>Реализовать создание страницы проекта\r\n<br>Реализовать поиск людей в команду\r\n<br>Реализовать возможность оценки проекта\r\n<br>Реализовать авторизацию/регистрацию\r\n<br>', 'Гугл - https://www.google.com/search?q=%D0%B1%D0%BE%D1%83%D0%B8&oq=%D0%B1%D0%BE%D1%83%D0%B8&aqs=chrome..69i57.1908j0j7&sourceid=chrome&ie=UTF-8', 1, 'Завершен', '2022-06-07', 1, 'В описании проекта использоваться нецензурная лексика не должна!'),
(28, 'Разработка сайта студенческих проектов', 'Сайт направлен на помощь студентам, создающим свои первые проекты', 'Пока что здесь пусто', '', 0, 'Идея/задумка', '2022-06-07', 1, 'Проект проходит модерацию. По ее окончанию проект будет виден в каталоге, иначе у вас в профиле.	');

-- --------------------------------------------------------

--
-- Структура таблицы `request_to_team`
--

CREATE TABLE `request_to_team` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `vacancy_id` int NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `team_members`
--

CREATE TABLE `team_members` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `user_id` int NOT NULL,
  `post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'Участник'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `team_members`
--

INSERT INTO `team_members` (`id`, `project_id`, `user_id`, `post`, `role`) VALUES
(10, 25, 1, 'Веб-дизайнер', 'Создатель'),
(11, 26, 11, 'Главный редактор', 'Создатель'),
(12, 26, 1, 'Корректор', 'Участник'),
(15, 27, 1, 'Веб-дизайнер', 'Создатель'),
(17, 25, 11, 'Менеджер', 'Участник'),
(19, 28, 1, 'Директор', 'Создатель'),
(20, 25, 8, 'Проджект-менеджер', 'Участник');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `surename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `patronymic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date_of_birth` date NOT NULL,
  `organisation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `is_admin` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `name`, `surename`, `patronymic`, `gender`, `date_of_birth`, `organisation`, `role`, `password`, `is_admin`) VALUES
(1, 'Lexus', '123@123.123', 'Алексей', 'Бухвин', 'Дмитриевич', 'Мужчина', '2002-05-31', 'Радиотехнический колледж', 'Студент', '$2y$13$eWFckfSJfDLry5dhPyGWQufId4cFQW61z4K4ZomjbsvO9DXwS6zHC', 0),
(8, 'kenguru', '321@321.321', 'Алексей', 'Бухвин', 'Дмитриевич', 'Мужчина', '2002-05-31', 'Яндекс', 'Физ/юр лицо', '$2y$13$RvEXTSkk4g6Juxvx38mtK.qGHBBlBaekCAcrj1.RjXBcuj.K2yc2C', 0),
(11, 'David34567', 'buley2003@gmail.com', 'Девид', 'Боуи', '', 'Мужчина', '1947-01-08', 'Университет музыкальных искусств', 'Студент', '$2y$13$98145/emod5/CIApy21v2O0lmn4ECZuOY7ZW3VwL6nvZoC6yQLPIq', 0),
(12, 'administrator', 'admin@admin.admin', 'Алексей', 'Брантен', '', 'Мужской', '2022-07-02', 'Университет музыкальных искусств', 'Физ/юр лицо', '$2y$13$8MRW.0MIg5nlnxrCZD9XAOmU2isEcT6dApshA9uPDTWBDR/PruA52', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `finding_team_members`
--
ALTER TABLE `finding_team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Индексы таблицы `request_to_team`
--
ALTER TABLE `request_to_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vacancy_id` (`vacancy_id`);

--
-- Индексы таблицы `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `finding_team_members`
--
ALTER TABLE `finding_team_members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `request_to_team`
--
ALTER TABLE `request_to_team`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `finding_team_members`
--
ALTER TABLE `finding_team_members`
  ADD CONSTRAINT `finding_team_members_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `request_to_team`
--
ALTER TABLE `request_to_team`
  ADD CONSTRAINT `request_to_team_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `request_to_team_ibfk_3` FOREIGN KEY (`vacancy_id`) REFERENCES `finding_team_members` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `team_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

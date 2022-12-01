-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 20 2022 г., 18:30
-- Версия сервера: 10.11.0-MariaDB
-- Версия PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `aldar_mandzhiev`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `AnswerId` int(11) NOT NULL,
  `response` text NOT NULL,
  `UserId` int(11) NOT NULL,
  `QuestionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`AnswerId`, `response`, `UserId`, `QuestionId`) VALUES
(1, 'Новый ответ на 9й вопрос!', 1, 9),
(2, 'Новый ответ', 1, 1),
(3, 'используйте запрос CREATE', 1, 2),
(4, 'МОЙ ОТВЕТ', 1, 4),
(5, 'авыаыва', 1, 3),
(6, '123455нпарекр', 1, 5),
(7, 'сммсипткетутукп', 1, 6),
(8, 'yhgyrjhhteg', 1, 7),
(9, 'dsda', 1, 8),
(10, 'dsda gbgbgsd fasf', 2, 10),
(11, 'новый ответ', 1, 14),
(12, 'Вот так', 2, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `Id` int(11) NOT NULL,
  `theme` varchar(256) NOT NULL,
  `course` varchar(256) NOT NULL,
  `UserId` int(11) NOT NULL,
  `problem` varchar(256) NOT NULL,
  `about` text NOT NULL,
  `userfile` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`Id`, `theme`, `course`, `UserId`, `problem`, `about`, `userfile`) VALUES
(1, 'server', 'advanced', 1, 'Не устанавливается Apache', 'Напишите свой вопрос...', 'img101.png'),
(2, 'database', 'pro', 1, 'Не могу создать базу', 'Напишите свой вопрос...', 'img102.jpg'),
(3, 'php', 'starter', 1, 'не работает скрипт index.php', 'Напишите свой вопрос...', 'img103.png'),
(4, 'php', 'starter', 1, 'не работает скрипт index.php', 'Напишите свой вопрос...', 'img103.png'),
(5, 'php', 'starter', 1, 'не работает скрипт index.php', 'Напишите свой вопрос...', 'img103.png'),
(6, 'php', 'starter', 1, 'не работает скрипт index.php', 'Напишите свой вопрос...', 'img103.png'),
(7, 'other', 'starter', 1, 'как зашифровать строку с помощью openssl_encrypt', 'Шифрование и дешифрование', ''),
(8, 'other', 'starter', 1, 'как зашифровать строку с помощью openssl_encrypt', 'Шифрование и дешифрование', ''),
(9, 'php', 'starter', 1, 'Как задать стандартное значение в функции', 'Не знаю как добавить значение по умолчанию для переменной при создании функции, чтобы можно было не передавать некоторые переменные, а использовать стандартные значения.', ''),
(10, 'server', 'pro', 2, 'Как установить апач на mac', 'Напишите свой вопрос...', ''),
(11, 'server', 'pro', 2, 'Как установить апач на mac', 'Напишите свой вопрос...', ''),
(12, 'database', 'starter', 2, 'как удалить столбец в таблице', 'Напишите свой вопрос...', ''),
(13, 'database', 'advanced', 2, 'Как выполнить INSERT запрос', 'Напишите свой вопрос...', ''),
(14, 'server', 'advanced', 1, 'Хочу создать SMTP подключение', 'Напишите свой вопрос...', ''),
(15, 'other', 'advanced', 1, 'dsdweqweqe', 'Напишeqweqweqweите свой вопрос...', ''),
(16, 'server', 'advanced', 1, 'dsad', 'Напишите свой вопрос...', ''),
(17, 'server', 'advanced', 1, 'dsad', 'Напишите свой вопрос...', ''),
(18, 'php', 'pro', 1, 'rerwqrqrw', 'Напишите свой вопрос...qwrqwrqwr', ''),
(19, 'database', 'starter', 1, 'dereqrqer', 'Напишите свfwefwefой вопрос...', ''),
(20, 'database', 'starter', 1, 'dereqrqer', 'Напишите свfwefwefой вопрос...', ''),
(21, 'database', 'starter', 1, 'dereqrqer', 'Напишите свfwefwefой вопрос...', ''),
(22, 'database', 'starter', 1, 'dereqrqer', 'Напишите свfwefwefой вопрос...', ''),
(23, 'server', 'advanced', 1, 'dasda', 'Напишите свой вопрос...dsad', ''),
(24, 'server', 'advanced', 1, 'dasda', 'Напишите свой вопрос...dsad', ''),
(25, 'server', 'advanced', 1, 'dasda', 'Напишите свой вопрос...dsad', ''),
(26, 'server', 'advanced', 1, 'dsd', 'Напишите свой ввыфвфыопрос...', ''),
(27, 'other', 'pro', 1, '1231243546567568', 'Напишите свой вопрос...пывпцупцпппппппппппппппппппппппппппп', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `gender` char(1) NOT NULL,
  `password` varchar(256) NOT NULL,
  `staff` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `first_name`, `last_name`, `email`, `gender`, `password`, `staff`) VALUES
(1, 'Aldar', 'Mandzhiev', 'ald@ar', 'm', '$2y$10$tYIg84CjFkiAbLgRUcYnPO1.R/nn9getBZcjxoQf5t8w.g1cvneZm', 1),
(2, 'Алдар', 'Манджиев', 'ald@r', 'm', '$2y$10$cnh3yKbwtpfMYasbELJhReSJrPs.FsavQi73yRv8.xOo0p7Wqc0bK', 1),
(3, 'Ochir', 'Budzhalov', 'och@docha', 'm', '$2y$10$7eoqj9nqstvkokWvyfCf5.2Ys9jzzoSWWFoTUuKsyG9Eq7nolKoHS', 0),
(4, 'Altan', 'Ulumdhziev', 'alt@n', 'm', '$2y$10$8ZWKd0fkbqPV0mO0CbOywuYSOMisk6ouhuhsZxFjMApcSESbblhfu', 0),
(5, 'Alexander', 'Shuvarinov', 'al@x', 'm', '$2y$10$6c1VVabEeqc9KhohDv2uue57zEh0ikiRhGwERmrXoGz5WKY3fLb2u', 0),
(6, 'Myngyan', 'Badinov', 'min@bad', 'm', '$2y$10$E9oBig/9u9FuPp0uM8ezxuQSgMX/3NOCcxBg.rbo0hcp6uWGc1T/q', 1),
(7, 'Педро', 'Сан-Хосе', 'san@hose', 'm', '$2y$10$N8XW3Emu5Ivzc1whpBcoye9tNqc43RgZkN3V805Ux62yI8X0F2JtW', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`AnswerId`),
  ADD KEY `QuestionId` (`QuestionId`),
  ADD KEY `UserId` (`UserId`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `AnswerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`QuestionId`) REFERENCES `questions` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

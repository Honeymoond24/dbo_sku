-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 15 2022 г., 09:08
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dbo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `IDStudent` int(11) NOT NULL,
  `StudentCode` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StudentSurName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StudentFirstName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StudentPatronymic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IDGroup` int(11) DEFAULT NULL,
  `IDStudentStatus` tinyint(3) UNSIGNED DEFAULT NULL,
  `NameShort` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StudentFullName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`IDStudent`, `StudentCode`, `StudentSurName`, `StudentFirstName`, `StudentPatronymic`, `IDGroup`, `IDStudentStatus`, `NameShort`, `StudentFullName`, `Email`) VALUES
(5, '10620287', 'Долгушин', 'Никон', 'Львович', 1, 1, 'Никон', 'Долгушин Никон Львович', 'nikon@gmail.com'),
(8, NULL, 'Семейников', 'Артем', 'Николаевич', NULL, NULL, 'Семейников', 'Семейников Артем Николаевич', 'artem@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `IDTeacher` int(11) NOT NULL,
  `IDChair` int(11) NOT NULL,
  `TeacherSurname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TeacherFirstName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TeacherPatronymic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ChairHead` tinyint(1) DEFAULT 0,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`IDTeacher`, `IDChair`, `TeacherSurname`, `TeacherFirstName`, `TeacherPatronymic`, `ChairHead`, `okDeleted`) VALUES
(3, 1, 'Пяткова', 'Татьяна', 'Владимировна', 0, 0),
(4, 1, 'Кухаренко', 'Евгения', 'Владимировна', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `IDUser` int(11) DEFAULT NULL,
  `usersType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usersEmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usersPwd` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `IDUser`, `usersType`, `fullName`, `usersEmail`, `usersPwd`) VALUES
(1, 1, 'student', 'Иванов Иван Иванович', 'ivan1@gmail.com', '$2y$10$mZO645sRHL0bkR3QEbVZIOJca9fWJgL4KYEPt6OEXVKOYaqxcjSQq'),
(2, 2, 'student', 'Петров Петр Петрович', 'petrov1@gmail.com', '$2y$10$b3NsH5BRACGAjpaSK/MwJOKjCJL2fHn1FFpubdJrdPqjJofzpB6/K'),
(3, 3, 'student', 'Иванов Иван Иванович', 'ivan2@gmail.com', '$2y$10$OF.zBmyj9k42qKmZ7nZqBOezHHnPXKlIP4twOcBvGTCm7mn5I6V7.'),
(4, 4, 'student', 'adssdf asdffs2 ads3dd3', 'qazwsx@qaz.we', '$2y$10$A9W3WTsqcrcAD1TR.xijfers9ZUGChlyQKqq4uKWvhIyw/2M1lCvC'),
(5, 1, 'teacher', 'Иванов Иван Иванович', 'zdaniyalr1@gmail.com', '$2y$10$a/18I5EB6WeT3SHcQY6Zlex1P28KWm/xZ6hicsLfwZ8Z035P5.TW6'),
(6, 2, 'teacher', 'Преподов Алексей Алексеевич', 'alex1@gmail.com', '$2y$10$eX6dZRKr75oj/HHOJC85WezOFgeMftBy5i1XRp5voWKgZmnSFyhRe'),
(7, 3, 'head_teacher', 'Кухаренко Евгений Владимировна', 'kev@gmai.com', '$2y$10$Vr5uKILR0VO1CpprS9dY0O4YrHVGsF7WQcxZxevuSExIWtXDOP2Cq'),
(8, 5, 'student', 'Долгушин Никон Львович', 'nikon@gmail.com', '$2y$10$IWv7hyeTZ5d23LPDnPnobuWTpZyY7KSKUsIvocNyqcWw7lC49sUzy'),
(9, 4, 'teacher', 'Пяткова Татьяна Владимировна', 'tpv@gmail.com', '$2y$10$m4oCy2nS6K8.N3tlyblg6.7SO1.vOmCoNScTfKdjctoRExgbSAH6m'),
(10, 5, 'teacher', 'qwer wer ert', 'qwe@qwe.qw', '$2y$10$icxOtgdFlpguay1ocbAavObm8wPKL7jkEaksw5s2wCPadbZyYhwSK'),
(11, 4, 'head_teacher', 'qwer wer ert', 'qwer@qwe.qw', '$2y$10$9XSnAl9I/j3Xg9eBd2g4dubjCl5f9uJe9Lk0/TmZmcO6SVMhu93Ku'),
(14, 6, 'student', 'Семейников Артем Николаевич', 'artem@gmail.com', '$2y$10$geFJjZiKEZ9Ztp2CLyVLOOW25RF0qYkqLmTFeUcrYoOoroDymN2bu');

--
-- Индексы сохранённых таблиц
--

ALTER TABLE `students`
  ADD PRIMARY KEY (`IDStudent`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`IDTeacher`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `IDStudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `IDTeacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

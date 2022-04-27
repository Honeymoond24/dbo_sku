-- phpMyAdmin SQL Dump
-- version 5.2.0-dev+20220417.9174669a7c
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 27 2022 г., 10:01
-- Версия сервера: 10.5.11-MariaDB
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Структура таблицы `chairs`
--

CREATE TABLE `chairs` (
  `IDChair` int(11) NOT NULL,
  `ChairFullName` varchar(100) NOT NULL,
  `ChairShortName` varchar(20) NOT NULL,
  `IDFaculty` int(11) NOT NULL,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chairs`
--

INSERT INTO `chairs` (`IDChair`, `ChairFullName`, `ChairShortName`, `IDFaculty`, `okDeleted`) VALUES
(1, 'Информационно-коммуникационные технологии', 'ИКТ', 5, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `controlanswers`
--

CREATE TABLE `controlanswers` (
  `IDAnswer` int(11) NOT NULL,
  `IDControlsForGroups` int(11) NOT NULL,
  `IDStudent` int(11) NOT NULL,
  `IDTicket` int(11) NOT NULL,
  `answerText` text NOT NULL,
  `answerFile` text NOT NULL,
  `scores` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `controls`
--

CREATE TABLE `controls` (
  `IDControl` int(11) NOT NULL,
  `IDDiscipline` int(11) NOT NULL,
  `IDControlType` int(11) NOT NULL,
  `SemesterNum` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `controls`
--

INSERT INTO `controls` (`IDControl`, `IDDiscipline`, `IDControlType`, `SemesterNum`) VALUES
(1, 1, 1, 6),
(2, 2, 1, 6),
(3, 3, 1, 6),
(4, 4, 1, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `controlsforgroups`
--

CREATE TABLE `controlsforgroups` (
  `IDControlsForGroups` int(11) NOT NULL,
  `IDGroup` int(11) DEFAULT NULL,
  `IDTeacher` int(11) DEFAULT NULL,
  `ControlDate` datetime DEFAULT NULL,
  `IDControl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `controlsforgroups`
--

INSERT INTO `controlsforgroups` (`IDControlsForGroups`, `IDGroup`, `IDTeacher`, `ControlDate`, `IDControl`) VALUES
(1, 1, 3, '2022-04-18 00:00:00', 1),
(2, 1, 1, '2022-05-11 00:00:00', 2),
(3, 1, 1, '2022-05-11 00:00:00', 3),
(4, 1, 1, '2022-05-11 00:00:00', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `controltypes`
--

CREATE TABLE `controltypes` (
  `IDControlType` int(11) NOT NULL,
  `ControlTypeName` varchar(50) NOT NULL,
  `ControlTypeNameKZ` varchar(50) DEFAULT NULL,
  `ControlTypeNameENG` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `controltypes`
--

INSERT INTO `controltypes` (`IDControlType`, `ControlTypeName`, `ControlTypeNameKZ`, `ControlTypeNameENG`) VALUES
(1, 'Письменный', 'Жазбаша', 'Paper');

-- --------------------------------------------------------

--
-- Структура таблицы `criteria`
--

CREATE TABLE `criteria` (
  `IDCriteria` int(11) NOT NULL,
  `IDDiscipline` int(11) DEFAULT NULL,
  `criteria` text DEFAULT NULL,
  `maxScore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `disciplines`
--

CREATE TABLE `disciplines` (
  `IDDiscipline` int(11) NOT NULL,
  `IDChair` int(11) NOT NULL,
  `DisciplineName` varchar(1000) NOT NULL,
  `DisciplineNameKZ` varchar(1000) DEFAULT NULL,
  `DisciplineNameENG` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `disciplines`
--

INSERT INTO `disciplines` (`IDDiscipline`, `IDChair`, `DisciplineName`, `DisciplineNameKZ`, `DisciplineNameENG`) VALUES
(1, 1, 'Управление IT-проектами', 'Управление IT-проектами KAZ', 'Управление IT-проектами ENG'),
(2, 1, 'Программная инженерия', 'Программная инженерия KAZ', 'Программная инженерия ENG'),
(3, 1, 'Инструментальные средства разработки', 'Инструментальные средства разработки KAZ', 'Инструментальные средства разработки ENG'),
(4, 1, 'РИСИСИС', 'РИСИСИС KAZ', 'РИСИСИС ENG');

-- --------------------------------------------------------

--
-- Структура таблицы `faculties`
--

CREATE TABLE `faculties` (
  `IDFaculty` int(11) NOT NULL,
  `FacultyFullName` varchar(100) NOT NULL,
  `FacultyShortName` varchar(20) NOT NULL,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `faculties`
--

INSERT INTO `faculties` (`IDFaculty`, `FacultyFullName`, `FacultyShortName`, `okDeleted`) VALUES
(1, 'Агротехнологический Факультет', 'АФ', 0),
(2, 'Высшая Школа Медицины', 'ВШМ', 0),
(3, 'Институт Языка И Литературы', 'ИЯИЛ', 0),
(4, 'Педагогический Факультет', 'ПФ', 0),
(5, 'Факультет Инженерии И Цифровых Технологий', 'ФИЦТ', 0),
(6, 'Факультет Математики И Естественных Наук', 'ФМЕН', 0),
(7, 'Факультет Истории, Экономики И Права', 'ФИЭП', 0),
(8, 'Факультет Foundation', 'FOUNDATION', 0),
(9, 'Институт Переподготовки И Повышения Квалификации', 'ИППК', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `IDGroup` int(11) NOT NULL,
  `GroupName` varchar(30) NOT NULL,
  `IDSpeciality` int(11) NOT NULL,
  `GroupNameKZ` varchar(20) DEFAULT NULL,
  `GroupNameENG` varchar(20) DEFAULT NULL,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`IDGroup`, `GroupName`, `IDSpeciality`, `GroupNameKZ`, `GroupNameENG`, `okDeleted`) VALUES
(1, 'АПО-19', 1, 'АПО-19', 'APO-19', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `IDNote` int(11) NOT NULL,
  `IDControlsForGroup` int(11) NOT NULL,
  `IDStudent` int(11) NOT NULL,
  `Ball` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `specialities`
--

CREATE TABLE `specialities` (
  `IDSpeciality` int(11) NOT NULL,
  `SpecialityCode` char(8) NOT NULL,
  `IDChair` int(11) NOT NULL,
  `SpecialityShortName` varchar(50) NOT NULL,
  `SpecialityName` varchar(200) NOT NULL,
  `SpecialityNameKZ` varchar(500) DEFAULT NULL,
  `SpecialityNameENG` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `specialities`
--

INSERT INTO `specialities` (`IDSpeciality`, `SpecialityCode`, `IDChair`, `SpecialityShortName`, `SpecialityName`, `SpecialityNameKZ`, `SpecialityNameENG`) VALUES
(1, '6B06105', 1, 'АПО', 'Архитектор программного обеспечения', 'Бағдарламалық қамтамасыз ету сәулетшісі', 'Software architect');

-- --------------------------------------------------------

--
-- Структура таблицы `studentaccess`
--

CREATE TABLE `studentaccess` (
  `IDStudentAccess` int(11) NOT NULL,
  `IDControlsForGroup` int(11) NOT NULL,
  `IDStudent` int(11) NOT NULL,
  `bAllowed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `studentaccess`
--

INSERT INTO `studentaccess` (`IDStudentAccess`, `IDControlsForGroup`, `IDStudent`, `bAllowed`) VALUES
(1, 1, 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `IDStudent` int(11) NOT NULL,
  `StudentCode` varchar(8) DEFAULT NULL,
  `StudentSurName` varchar(50) DEFAULT NULL,
  `StudentFirstName` varchar(50) DEFAULT NULL,
  `StudentPatronymic` varchar(50) DEFAULT NULL,
  `IDGroup` int(11) DEFAULT NULL,
  `IDStudentStatus` tinyint(3) UNSIGNED DEFAULT NULL,
  `NameShort` varchar(50) DEFAULT NULL,
  `StudentFullName` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`IDStudent`, `StudentCode`, `StudentSurName`, `StudentFirstName`, `StudentPatronymic`, `IDGroup`, `IDStudentStatus`, `NameShort`, `StudentFullName`, `Email`) VALUES
(5, '10620287', 'Долгушин', 'Никон', 'Львович', 1, 1, 'Никон', 'Долгушин Никон Львович', 'nikon@gmail.com'),
(6, NULL, 'Семейников', 'Артем', 'Николаевич', 1, NULL, 'Семейников', 'Семейников Артем Николаевич', 'artem@gmail.com'),
(7, NULL, 'Одарич', 'Константин', 'Николаевич', 1, NULL, 'Одарич', 'Одарич Константин Николаевич', 'kostya@gmail.com'),
(8, NULL, 'Тарасюк', 'Андрей', 'Вячеславович', 1, NULL, 'Тарасюк', 'Тарасюк Андрей Вячеславович', 'andrey@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `IDTeacher` int(11) NOT NULL,
  `IDChair` int(11) NOT NULL,
  `TeacherSurname` varchar(50) NOT NULL,
  `TeacherFirstName` varchar(50) DEFAULT NULL,
  `TeacherPatronymic` varchar(50) DEFAULT NULL,
  `ChairHead` tinyint(1) DEFAULT 0,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`IDTeacher`, `IDChair`, `TeacherSurname`, `TeacherFirstName`, `TeacherPatronymic`, `ChairHead`, `okDeleted`) VALUES
(3, 1, 'Пяткова', 'Татьяна', 'Владимировна', 0, 0),
(4, 1, 'Кухаренко', 'Евгения', 'Владимировна', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `IDDiscipline` int(11) DEFAULT NULL,
  `IDTicket` int(11) NOT NULL,
  `ticketText` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `IDUser` int(11) DEFAULT NULL,
  `usersType` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `usersEmail` varchar(255) DEFAULT NULL,
  `usersPwd` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(14, 6, 'student', 'Семейников Артем Николаевич', 'artem@gmail.com', '$2y$10$geFJjZiKEZ9Ztp2CLyVLOOW25RF0qYkqLmTFeUcrYoOoroDymN2bu'),
(15, 7, 'student', 'Одарич Константин Николаевич', 'kostya@gmail.com', '$2y$10$3ELgQG5BA7WiuSs/q3gyn.mV9UzoD4UUiucaRdV/nYGP3TByfsUri'),
(16, 8, 'student', 'Тарасюк Андрей Вячеславович', 'andrey@gmail.com', '$2y$10$12wRm8nQxwYfbwQUS9IuXehsv/lCJNhKiXJQx8aN28DyaRYDaVioe');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chairs`
--
ALTER TABLE `chairs`
  ADD PRIMARY KEY (`IDChair`);

--
-- Индексы таблицы `controlanswers`
--
ALTER TABLE `controlanswers`
  ADD PRIMARY KEY (`IDAnswer`);

--
-- Индексы таблицы `controls`
--
ALTER TABLE `controls`
  ADD PRIMARY KEY (`IDControl`);

--
-- Индексы таблицы `controlsforgroups`
--
ALTER TABLE `controlsforgroups`
  ADD PRIMARY KEY (`IDControlsForGroups`);

--
-- Индексы таблицы `controltypes`
--
ALTER TABLE `controltypes`
  ADD PRIMARY KEY (`IDControlType`);

--
-- Индексы таблицы `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`IDCriteria`);

--
-- Индексы таблицы `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`IDDiscipline`);

--
-- Индексы таблицы `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`IDFaculty`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`IDGroup`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`IDNote`);

--
-- Индексы таблицы `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`IDSpeciality`);

--
-- Индексы таблицы `studentaccess`
--
ALTER TABLE `studentaccess`
  ADD PRIMARY KEY (`IDStudentAccess`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`IDStudent`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`IDTeacher`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`IDTicket`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chairs`
--
ALTER TABLE `chairs`
  MODIFY `IDChair` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `controlanswers`
--
ALTER TABLE `controlanswers`
  MODIFY `IDAnswer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `controls`
--
ALTER TABLE `controls`
  MODIFY `IDControl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `controlsforgroups`
--
ALTER TABLE `controlsforgroups`
  MODIFY `IDControlsForGroups` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `controltypes`
--
ALTER TABLE `controltypes`
  MODIFY `IDControlType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `criteria`
--
ALTER TABLE `criteria`
  MODIFY `IDCriteria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `IDDiscipline` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `faculties`
--
ALTER TABLE `faculties`
  MODIFY `IDFaculty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `IDGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `IDNote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `specialities`
--
ALTER TABLE `specialities`
  MODIFY `IDSpeciality` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `studentaccess`
--
ALTER TABLE `studentaccess`
  MODIFY `IDStudentAccess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `IDTicket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 30 2022 г., 06:18
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
-- Структура таблицы `auditories`
--

CREATE TABLE `auditories` (
  `IdAuditory` int(11) NOT NULL,
  `AuditoryName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `chairs`
--

CREATE TABLE `chairs` (
  `IDChair` int(11) NOT NULL,
  `ChairFullName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ChairShortName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDFaculty` int(11) NOT NULL,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `controls`
--

CREATE TABLE `controls` (
  `IDControl` int(11) NOT NULL,
  `IDDiscipline` int(11) NOT NULL,
  `IDControlType` int(11) NOT NULL,
  `SemesterNum` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `controlsforgroups`
--

CREATE TABLE `controlsforgroups` (
  `IDControlsForGroups` int(11) NOT NULL,
  `IDGroup` int(11) DEFAULT NULL,
  `IDTeacher` int(11) DEFAULT NULL,
  `ControlDate` datetime DEFAULT NULL,
  `IDControl` int(11) NOT NULL,
  `IDAuditory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `controltypes`
--

CREATE TABLE `controltypes` (
  `IDControlType` int(11) NOT NULL,
  `ControlTypeName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ControlTypeNameKZ` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ControlTypeNameENG` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `disciplines`
--

CREATE TABLE `disciplines` (
  `IDDiscipline` int(11) NOT NULL,
  `IDLearningPlan` int(11) NOT NULL,
  `IDChair` int(11) NOT NULL,
  `DisciplineName` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DisciplineNameKZ` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DisciplineNameENG` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `faculties`
--

CREATE TABLE `faculties` (
  `IDFaculty` int(11) NOT NULL,
  `FacultyFullName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FacultyShortName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `IDGroup` int(11) NOT NULL,
  `GroupName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDLearningPlan` int(11) NOT NULL,
  `GroupNameKZ` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GroupNameENG` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `learningplans`
--

CREATE TABLE `learningplans` (
  `IDLearningPlan` int(11) NOT NULL,
  `IDSpeciality` int(11) NOT NULL,
  `LearningPlanName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `YearBegin` smallint(6) DEFAULT NULL,
  `YearEnd` smallint(6) NOT NULL,
  `MonthEnd` tinyint(3) UNSIGNED NOT NULL,
  `okDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `IDNote` int(11) NOT NULL,
  `IDControlsForGroup` int(11) NOT NULL,
  `IDStudent` int(11) NOT NULL,
  `Ball` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `specialities`
--

CREATE TABLE `specialities` (
  `IDSpeciality` int(11) NOT NULL,
  `SpecialityCode` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDChair` int(11) NOT NULL,
  `SpecialityShortName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SpecialityName` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SpecialityNameKZ` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SpecialityNameENG` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `studentaccess`
--

CREATE TABLE `studentaccess` (
  `IDStudentAccess` int(11) NOT NULL,
  `IDControlsForGroup` int(11) NOT NULL,
  `IDStudent` int(11) NOT NULL,
  `bAllowed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `IDStudent` int(11) NOT NULL,
  `StudentCode` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StudentSurName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StudentFirstName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StudentPatronymic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IDGroup` int(11) NOT NULL,
  `IDStudentStatus` tinyint(3) UNSIGNED NOT NULL,
  `NameShort` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StudentFullName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `IDTeacher` int(11) NOT NULL,
  `IDChair` int(11) NOT NULL,
  `TeacherSurname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TeacherFirstName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TeqacherPatronymic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `okDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `IDUser` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auditories`
--
ALTER TABLE `auditories`
  ADD PRIMARY KEY (`IdAuditory`);

--
-- Индексы таблицы `chairs`
--
ALTER TABLE `chairs`
  ADD PRIMARY KEY (`IDChair`);

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
-- Индексы таблицы `learningplans`
--
ALTER TABLE `learningplans`
  ADD PRIMARY KEY (`IDLearningPlan`);

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
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IDUser`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auditories`
--
ALTER TABLE `auditories`
  MODIFY `IdAuditory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `chairs`
--
ALTER TABLE `chairs`
  MODIFY `IDChair` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `controls`
--
ALTER TABLE `controls`
  MODIFY `IDControl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `controlsforgroups`
--
ALTER TABLE `controlsforgroups`
  MODIFY `IDControlsForGroups` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `controltypes`
--
ALTER TABLE `controltypes`
  MODIFY `IDControlType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `IDDiscipline` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `faculties`
--
ALTER TABLE `faculties`
  MODIFY `IDFaculty` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `IDGroup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `learningplans`
--
ALTER TABLE `learningplans`
  MODIFY `IDLearningPlan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `IDNote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `specialities`
--
ALTER TABLE `specialities`
  MODIFY `IDSpeciality` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `studentaccess`
--
ALTER TABLE `studentaccess`
  MODIFY `IDStudentAccess` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `IDStudent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `IDTeacher` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `IDUser` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

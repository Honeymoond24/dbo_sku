-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Students(
	`IDStudent` int AUTO_INCREMENT NOT NULL,
	`StudentCode` varchar(8) NOT NULL,
	`StudentSurName` varchar(50) NULL,
	`StudentFirstName` varchar(50) NULL,
	`StudentPatronymic` varchar(50) NULL,
	`IDGroup` int NOT NULL,
	`IDStudentStatus` tinyint Unsigned NOT NULL,
	`NameShort` varchar(50) NULL, /*AS (case when [StudentSurName] IS NULL then [StudentFirstName] else ([StudentSurName]+case when len([StudentFirstName]);>(0) then (Concat(' ',upper(substring(`StudentFirstName`,(1),(1)))))+'.' else '' end)+case when char_length(rtrim(`StudentPatronymic`))>(0) then (Concat(' ',upper(substring(`StudentPatronymic`,(1),(1)))))+'.' else '' end end),*/
	`StudentFullName` varchar(50) NULL, /*  AS (case when `StudentSurName` IS NULL then `StudentFirstName` else (`StudentSurName`+case when `StudentFirstName` IS NOT NULL then Concat(' ',`StudentFirstName`) else '' end)+case when `StudentPatronymic` IS NOT NULL then Concat(' ',`StudentPatronymic`) else '' end end),*/
	`Email` varchar(50) NULL
)

/* SQLINES DEMO *** әдүәқас	Баянсұлу	Қайратқызы	3216	1	Сәдүәқас Б. Қ.	Сәдүәқас Баянсұлу Қайратқызы	NULL
41518	10709005	Хасенов		Самат		Омирбекович	3216	1	Хасенов С. О.	Хасенов Самат Омирбекович		NULL
41519	10709006	Шанаурин	Константин	Андреевич	3222	1	Шанаурин К. А.	Шанаурин Константин Андреевич	NULL
*/

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Groups(
	`IDGroup` int AUTO_INCREMENT NOT NULL,
	`GroupName` varchar(30) NOT NULL,
	`IDLearningPlan` int NOT NULL,
	`GroupNameKZ` varchar(20) NULL,
	`GroupNameENG` varchar(20) NULL
	`okDeleted` boolean NOT NULL
);

/* SQLINES DEMO *** 	2234	ҚТӘ-14-қ	NULL		0
3911	РЛ-14		2236	ОТӘ-14	 	NULL		0
3912	ИЯ-14-к		2202	ШТ-14-қ		FL-14-k		0
*/

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE LearningPlans(
	`IDLearningPlan` int AUTO_INCREMENT NOT NULL,
	`IDSpeciality` int NOT NULL,
	`LearningPlanName` varchar(20) NOT NULL,
	`YearBegin` smallint NULL,
	`YearEnd` smallint NOT NULL,
	`MonthEnd` tinyint Unsigned NOT NULL,
	`okDeleted` Tinyint NULL
);

/* SQLINES DEMO *** -к-10		2010	2013	2	0
1691	844	ФКСIII-к-10		2010	2014	6	0
1692	844	ФКС-к-10		2010	2013	6	0
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Specialities(
	`IDSpeciality` int AUTO_INCREMENT NOT NULL,
	`SpecialityCode` char(8) NOT NULL,
	`IDChair` int NOT NULL,
	`SpecialityShortName` varchar(50) NOT NULL,
	`SpecialityName` varchar(200) NOT NULL,
	`SpecialityNameKZ` varchar(500) NULL,
	`SpecialityNameENG` varchar(500) NULL
);

/* SQLINES DEMO *** � 	Агрономия 				NULL 	NULL
886		5B071300	5 	Б 	Биология 				NULL 	NULL
887		5B071600	6 	ИС 	Информационные системы 	NULL 	NULL
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Chairs(
	`IDChair` int AUTO_INCREMENT NOT NULL,
	`ChairFullName` varchar(100) NOT NULL,
	`ChairShortName` varchar(20) NOT NULL,
	`IDFaculty` int NOT NULL,
	`okDeleted` Tinyint NOT NULL
);

/* SQLINES DEMO *** ьной и социальной педагогики	 	ССП 	12 		0
97	Агрономии и лесоводства				 	АЛ		13 	 	0
98	Продовольственной безопасности			ПБ		13 		0
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Faculties(
	`IDFaculty` int AUTO_INCREMENT NOT NULL,
	`FacultyFullName` varchar(100) NOT NULL,
	`FacultyShortName` varchar(20) NOT NULL,
	`okDeleted` Tinyint NOT NULL
);

/* SQLINES DEMO *** ет инженерии и цифровых технологий	ФИЦТ	0
59	Факультет математики и естественных наук	ФМЕН	0
60	Факультет истории, экономики и права	 	ФИЭП	0
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Disciplines(
	`IDDiscipline` int AUTO_INCREMENT NOT NULL,
	`IDLearningPlan` int NOT NULL,
	`IDChair` int NOT NULL,
	`DisciplineName` varchar(1000) NOT NULL,
	`DisciplineNameKZ` varchar(1000) NULL,
	`DisciplineNameENG` varchar(1000) NULL
);

/* SQLINES DEMO *** �едение в педагогическую деятельность	Педагогикалық іс-әрекетке кіріспе	Introduction to Pedagogical Activity
20361	3454	23	Агроэкология							Агроэкология						Agroecology
20363	3187	23	Агрохимия								Агрохимия							Agrochemistry
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Controls(
	`IDControl` int AUTO_INCREMENT NOT NULL,
	`IDDiscipline` int NOT NULL,
	`IDControlType` int NOT NULL,
	`SemesterNum` tinyint Unsigned NOT NULL
);

/* SQLINES DEMO *** 	459 	1 	5
45 	754 	2 	4
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE ControlTypes(
	`IDControlType` int AUTO_INCREMENT NOT NULL,
	`ControlTypeName` varchar(50) NOT NULL,
	`ControlTypeNameKZ` varchar(50) NULL,
	`ControlTypeNameENG` varchar(50) NULL
);

/* SQLINES DEMO *** экз.				Емтихан	емт.			exam	
2	Государственный экзамен		Мемлекеттік емтихан		state exam	
3	Зачет	зач.				Сынақ					offset
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE ControlsForGroups(
	`IDControlsForGroups` int AUTO_INCREMENT NOT NULL,
	`IDGroup` int NULL,
	`IDTeacher` int NULL,
	`ControlDate` Datetime NULL,
	`IDControl` int NOT NULL,
	`IDAuditory` int NOT NULL
);

/* SQLINES DEMO *** 	2021-12-16 	126546 	123
242342		787 	1441 	2020-03-13 	145564  745
34534		454 	4540 	2020-05-19 	445456 	542
*/



-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Teachers(
	`IDTeacher` int AUTO_INCREMENT NOT NULL,
	`IDChair` int NOT NULL,
	`TeacherSurname` varchar(50) NOT NULL,
	`TeacherFirstName` varchar(50) NULL,
	`TeqacherPatronymic` varchar(50) NULL,
	`OKdeleted` Tinyint NOT NULL
);

/* SQLINES DEMO *** �пбаев	Даулет	Касымович	0
5263	110		Мусина 		Ардак	Ергалиевна	0
5264	42		Мусин		Ануар	Айтарович	0
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE StudentAccess(
	`IDStudentAccess` int AUTO_INCREMENT NOT NULL,
	`IDControlsForGroup` int NOT NULL,
	`IDStudent` int NOT NULL,
	`bAllowed` Tinyint NOT NULL
);

/* SQLINES DEMO *** 4 	1
241565	45437	55124 	1
241566	45445	35100 	1
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Auditories(
	`IdAuditory` int AUTO_INCREMENT NOT NULL,
	`AuditoryName` varchar(50) NOT NULL,
	`OkDeleted` Tinyint NOT NULL
);

/* SQLINES DEMO ***  	12/3 	0
256 	205/5 	0
*/


-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE Notes(
	`IDNote` int AUTO_INCREMENT NOT NULL,
	`IDControlsForGroup` int NOT NULL,
	`IDStudent` int NOT NULL,
	`Ball` int NOT NULL
);

/* SQLINES DEMO *** 45444 	98
45646544 	54546 	45485 	75
48596456 	25445 	45742 	83
*/
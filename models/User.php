<?php
require_once '../libraries/Database.php';

class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //Find user by email or username
    public function findUserByEmail($usersEmail)
    {
        $this->db->query('SELECT * FROM `users` WHERE usersEmail = :usersEmail');
        $this->db->bind(':usersEmail', $usersEmail);

        $row = $this->db->single();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findStudentByID($IDUser)
    {
//        $this->db->query('SELECT * FROM `students` WHERE IDStudent = :IDUser');
        $this->db->query('SELECT students.StudentCode, students.StudentFullName, 
        students.IDGroup, groups.GroupName, groups.IDSpeciality, 
        specialities.SpecialityName, chairs.IDChair, 
        chairs.ChairFullName, chairs.ChairShortName, chairs.IDFaculty FROM students 
        JOIN groups on students.IDGroup = groups.IDGroup 
        JOIN specialities on groups.IDSpeciality = specialities.IDSpeciality 
        JOIN chairs on chairs.IDChair = specialities.IDChair 
        WHERE students.IDStudent = :IDUser');
        $this->db->bind(':IDUser', $IDUser);

        $row = $this->db->single();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findTeacherByID($IDUser)
    {
        $this->db->query('SELECT IDTeacher, teachers.IDChair, TeacherSurname, TeacherFirstName, TeacherPatronymic, 
        ChairHead, ChairFullName, ChairShortName, chairs.IDFaculty, FacultyFullName, FacultyShortName
	    FROM teachers 
	    JOIN chairs on teachers.IDChair = chairs.IDChair 
	    JOIN faculties on chairs.IDFaculty = faculties.IDFaculty
        WHERE IDTeacher = :IDUser');
        $this->db->bind(':IDUser', $IDUser);

        $row = $this->db->single();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //Register User
    public function register($data)
    {
//        $this->db->query('INSERT INTO users (usersName, usersEmail, usersPwd)
//        VALUES (:name, :email, :Uid, :password)');
        if ($data['usersType'] == 'student') {
            $query = 'INSERT INTO `users` (`IDUser`, `usersType`, `fullName`, `usersEmail`, `usersPwd`) 
        VALUES ((SELECT IF(
        (SELECT MAX(`IDUser`) FROM (SELECT `IDUser` FROM `users` WHERE `usersType` = :usersType) AS max_uid) IS NULL, 
        1, (SELECT MAX(`IDUser`) FROM (SELECT `IDUser` FROM `users` WHERE `usersType` = :usersType) AS max_uid) + 1)), 
        :usersType, :fullName, :usersEmail, :usersPwd);';
        } else {
            $query = 'INSERT INTO `users` (`IDUser`, `usersType`, `fullName`, `usersEmail`, `usersPwd`) 
        VALUES ((SELECT IF(
        (SELECT MAX(`IDUser`) FROM (SELECT `IDUser` FROM `users` 
        WHERE `usersType` = \'teacher\' OR `usersType` = \'head_teacher\') AS max_uid) IS NULL, 
        1, (SELECT MAX(`IDUser`) FROM (SELECT `IDUser` FROM `users` 
        WHERE `usersType` = \'teacher\' OR `usersType` = \'head_teacher\') AS max_uid) + 1)), 
        :usersType, :fullName, :usersEmail, :usersPwd);';
        }
        if ($data['usersType'] != 'student') {
            $usersType = ($data['usersType'] == 'head_teacher') ? 1 : 0;
            $query = $query . 'INSERT INTO `teachers` (`IDTeacher`,`TeacherSurname`, `TeacherFirstName`, 
        `TeacherPatronymic`, `ChairHead`) VALUES (
        (SELECT MAX(`IDUser`) FROM (SELECT `IDUser` FROM `users` WHERE `usersType` = :usersType) AS max_uid), 
        :usersName1, :usersName2, :usersName3, :ChairHead);';
        } else {
            $query = $query . 'INSERT INTO `students` 
        (`StudentSurName`, `StudentFirstName`, `StudentPatronymic`, `NameShort`, `StudentFullName`, `Email`) 
        VALUES (:usersName1, :usersName2, :usersName3, :usersName1, :fullName, :usersEmail);';
        }
        $this->db->query($query);
        //Bind values
        if ($data['usersType'] != 'student')
            $this->db->bind(':ChairHead', $usersType);
        $this->db->bind(':usersType', $data['usersType']);
        $this->db->bind(':fullName',
            $data['usersName1'] . ' ' . $data['usersName2'] . ' ' . $data['usersName3']);
        $this->db->bind(':usersEmail', $data['usersEmail']);
        $this->db->bind(':usersName1', $data['usersName1']);
        $this->db->bind(':usersName2', $data['usersName2']);
        $this->db->bind(':usersName3', $data['usersName3']);
        $this->db->bind(':usersPwd', $data['usersPwd']);
//        var_dump($this->db);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Login user
    public function login($usersEmail, $usersPwd)
    {
        $row = $this->findUserByEmail($usersEmail);

        if ($row == false) return false;
        $hashedPassword = $row->usersPwd;
        if (password_verify($usersPwd, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail)
    {
        $this->db->query('UPDATE users SET usersPwd= :usersPwd WHERE usersEmail= :usersEmail');
        $this->db->bind(':usersPwd', $newPwdHash);
        $this->db->bind(':usersEmail', $tokenEmail);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
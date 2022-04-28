<?php
require_once '../libraries/Database.php';

class Profile
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //Reset Password
    public function ChangeProfile($data)
    {
        $this->db->query('UPDATE users SET fullName= :fullName, usersEmail= :usersEmail   
        WHERE usersType = :usersType AND IDUser = :IDUser;
        UPDATE students SET StudentCode = :usersISC, StudentSurName = :usersName1, 
                            StudentFirstName = :usersName2, StudentPatronymic = :usersName3
        WHERE IDStudent = :IDStudent;');
        $this->db->bind(':fullName',
            $data['usersName1'] . ' ' .
            $data['usersName2'] . ' ' . $data['usersName3']);
        $this->db->bind(':usersName1', 'usersName1');
        $this->db->bind(':usersName2', 'usersName2');
        $this->db->bind(':usersName3', 'usersName3');
        $this->db->bind(':usersType', 'student');
        $this->db->bind(':IDUser', $_SESSION['IDUser']);
        $this->db->bind(':IDStudent', $_SESSION['IDUser']);
        $this->db->bind(':usersEmail', $data['usersEmail']);
        $this->db->bind(':usersISC', $data['usersISC']);
        $this->db->bind(':usersEmail', $data['usersEmail']);

        //Execute
        if ($this->db->execute()) {
            header("location: index.php?true");
            return true;
        } else {
            header("location: index.php?false");
            return false;
        }
    }
}
<?php

require_once '../libraries/Database.php';

class Teacher
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function insertControl($IDChair)
    {
        $sql = 'INSERT INTO controlsforgroups 
            (IDGroup, IDTeacher, ControlDate, IDControl) 
            VALUES ();';
//            $this->db->query('INSERT INTO criteria
//            (IDCriteria, IDControlsForGroups, criteria, maxScore) VALUES
//            (NULL, )';
        $this->db->query($sql);
//            $this->db->bind(':usersPwd', $newPwdHash);
//            $this->db->bind(':usersEmail', $tokenEmail);
        $row = $this->db->resultSet();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}
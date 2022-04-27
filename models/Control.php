<?php

require_once '../libraries/Database.php';

class Control
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Find Controls By User ID
    public function findControlsByUid($usersId)
    {
        if ($_SESSION['usersType'] != 'student') return false;
        $this->db->query('SELECT disciplines.DisciplineName, disciplines.IDDiscipline, 
       controlsforgroups.IDControlsForGroups FROM controlsforgroups 
    INNER JOIN controls on controlsforgroups.IDControl = controls.IDControl 
    INNER JOIN groups on groups.IDGroup = controlsforgroups.IDGroup 
    INNER JOIN students on students.IDGroup = groups.IDGroup 
    INNER JOIN disciplines on disciplines.IDDiscipline = controls.IDDiscipline 
    WHERE students.IDGroup = controlsforgroups.IDGroup AND students.IDStudent = :usersId;');
        $this->db->bind(':usersId', $usersId);

        $row = $this->db->resultSet();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findControlsByUd($usersId)
    {
        $this->db->query('SELECT disciplines.DisciplineName, disciplines.IDDiscipline, 
       controlsforgroups.IDControlsForGroups FROM controlsforgroups 
    INNER JOIN controls on controlsforgroups.IDControl = controls.IDControl 
    INNER JOIN groups on groups.IDGroup = controlsforgroups.IDGroup 
    INNER JOIN students on students.IDGroup = groups.IDGroup 
    INNER JOIN disciplines on disciplines.IDDiscipline = controls.IDDiscipline 
    WHERE students.IDGroup = controlsforgroups.IDGroup AND students.IDStudent = :usersId;');
        $this->db->bind(':usersId', $usersId);

        $row = $this->db->resultSet();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}
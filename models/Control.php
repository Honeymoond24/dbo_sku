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
    public function findControlsByUidStudent($usersId)
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

    public function findControlsByUidTeacher($usersId)
    {
        $this->db->query('SELECT * FROM controlsforgroups 
        JOIN controls on controlsforgroups.IDControl = controls.IDControl
        JOIN disciplines on disciplines.IDDiscipline = controls.IDDiscipline
        WHERE controlsforgroups.IDTeacher = :usersId;');
        $this->db->bind(':usersId', $usersId);

        $row = $this->db->resultSet();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findControlsByIDChair($IDChair)
    {
        $this->db->query('SELECT * FROM controlsforgroups 
        JOIN controls on controlsforgroups.IDControl = controls.IDControl
        JOIN disciplines on disciplines.IDDiscipline = controls.IDDiscipline
        JOIN groups on groups.IDGroup = controlsforgroups.IDGroup
        JOIN teachers on teachers.IDTeacher = controlsforgroups.IDTeacher
        WHERE disciplines.IDChair = :IDChair;');
        $this->db->bind(':IDChair', $IDChair);
        $row = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findControlsByIDChairTeacherSelect($IDChair)
    {
        $this->db->query('SELECT * FROM disciplines WHERE disciplines.IDChair = :IDChair;');
        $this->db->bind(':IDChair', $IDChair);

        $row = $this->db->resultSet();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findGroupsByIDChairTeacher($IDChair)
    {
        $this->db->query('SELECT * FROM groups
	        JOIN specialities on groups.IDSpeciality = specialities.IDSpeciality
            WHERE specialities.IDChair = :IDChair;');
        $this->db->bind(':IDChair', $IDChair);

        $row = $this->db->resultSet();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function insertControl($data)
    {
        $sql = 'INSERT INTO controls (IDDiscipline) VALUES (:IDDiscipline);';
        $sql .= 'INSERT INTO controlsforgroups
            (IDGroup, IDTeacher, ControlDate, IDControl)
            VALUES (:IDGroup, :IDTeacher, :ControlDate,
                    (SELECT MAX(IDControl) FROM controls AS a));';
        $sql .= 'INSERT INTO tickets
            (IDControlsForGroups, ticketText) VALUES';
        foreach ($data['tickets'] as $index => $ticketText) {
            $sql .= "((SELECT MAX(IDControlsForGroups ) FROM controlsforgroups AS aa), '$ticketText')";
            if ($index != count($data['tickets']) - 1) $sql .= ', ';
        }
        $sql .= ';';
        $sql .= 'INSERT INTO criteria
            (IDControlsForGroups, criteria, maxScore) VALUES';
        foreach ($data['indicators'] as $index => $indicator) {
            $sql .= "((SELECT MAX(IDControlsForGroups ) FROM controlsforgroups AS aa), 
            '$indicator', '{$data['indicators_score'][$index]}')";
            if ($index != count($data['indicators']) - 1) $sql .= ', ';
        }
        $sql .= ';';
        $this->db->query($sql);
        $this->db->bind(':IDDiscipline', $data['dsip']);
        $this->db->bind(':IDGroup', $data['group']);
        $this->db->bind(':IDTeacher', $data['IDUser']);
        $this->db->bind(':ControlDate', $data['datetimePicker']);

        //Execute
        if ($this->db->execute()) {
            return $sql;
            //            return true;
        } else {
            return false;
        }
    }

    public function DeleteControl($data)
    {
        $sql = 'DELETE FROM controlsforgroups WHERE IDControlsForGroups = :IDControlsForGroups;';
        $this->db->query($sql);
        $this->db->bind(':IDControlsForGroups', $data['IDControlsForGroups']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ControlForGroupsApprove($data)
    {
        $sql = 'UPDATE controlsforgroups SET Approve = 1 WHERE IDControlsForGroups = :IDControlsForGroups;';
        $this->db->query($sql);
        $this->db->bind(':IDControlsForGroups', $data['IDControlsForGroups']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function GetCriteria($data)
    {
        $this->db->query('SELECT * FROM criteria
	        WHERE IDControlsForGroups = :IDControlsForGroups;');
        $this->db->bind(':IDControlsForGroups', $data['IDControlsForGroups']);
        $row = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function GetTickets($data)
    {
        $this->db->query('SELECT * FROM tickets
	        WHERE IDControlsForGroups = :IDControlsForGroups;');
        $this->db->bind(':IDControlsForGroups', $data['IDControlsForGroups']);
        $row = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findControlsByIDChair($IDChair)
    {
        $this->db->query('SELECT * FROM controlsforgroups 
        JOIN controls on controlsforgroups.IDControl = controls.IDControl
        JOIN disciplines on disciplines.IDDiscipline = controls.IDDiscipline
        JOIN groups on groups.IDGroup = controlsforgroups.IDGroup
        JOIN teachers on teachers.IDTeacher = controlsforgroups.IDTeacher
        WHERE disciplines.IDChair = :IDChair;');
        $this->db->bind(':IDChair', $IDChair);
        $row = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findIDControlsForGroups($IDControlsForGroups, $IDStudent)
    {
        $this->db->query('SELECT * FROM controlanswers WHERE IDControlsForGroups = :IDControlsForGroups AND IDStudent = :IDStudent;');
        $this->db->bind(':IDControlsForGroups', $IDControlsForGroups);
        $this->db->bind(':IDStudent', $IDStudent);
        $row = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}
<?php
require_once '../models/Control.php';
require_once '../libraries/Database.php';

class Teachers
{
    private $teacherModel;

    public function __construct()
    {
        $this->teacherModel = new Teacher();
    }

    public function saveTickets()
    {
        $group = $_POST['group'];
        $dsip = $_POST['dsip'];
        $tickets = $_POST['tickets'];
        $indicators = $_POST['indicators'];
//        die(var_dump($_POST));
        $data = $this->teacherModel->findGroupsByIDChairTeacher($_SESSION['IDUser']);
        if ($data) {
            echo json_encode($data);
        } else {
            return false;
        }
    }
}

echo json_encode($_POST);

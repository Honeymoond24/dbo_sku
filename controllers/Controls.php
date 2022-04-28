<?php
require_once '../models/Control.php';
require_once '../helpers/session_helper.php';

class Controls
{
    private $controlModel;

    public function __construct()
    {
        $this->controlModel = new Control;
    }

    public function GetControlsStudent()
    {
        $controls = $this->controlModel->findControlsByUidStudent($_SESSION['IDUser']);
        if ($controls) {
            echo json_encode($controls);
        } else {
            return false;
        }
    }

    public function GetControlsTeacher()
    {
        $controls = $this->controlModel->findControlsByUidTeacher($_SESSION['IDUser']);
        if ($controls) {
            echo json_encode($controls);
        } else {
            return false;
        }
    }

    public function GetControlsSelectTeacher()
    {
        $controls = $this->controlModel->findControlsByIDChairTeacherSelect($_SESSION['IDChair']);
        if ($controls) {
            echo json_encode($controls);
        } else {
            return false;
        }
    }

    public function GetGroupsTeacher()
    {
        $controls = $this->controlModel->findGroupsByIDChairTeacher($_SESSION['IDChair']);
        if ($controls) {
            echo json_encode($controls);
        } else {
            return false;
        }
    }

    public function insertControl()
    {
        $group = $_POST['group'];
        $dsip = $_POST['dsip'];
        $tickets = $_POST['tickets'];
        $indicators = $_POST['indicators'];
        $data = $_POST;
        echo $_POST['type'];
        echo $_POST['tickets'][0];
        var_dump($_POST);
        $query = $this->controlModel->insertControl($data);
        if ($query) {
            echo 'Success! <br>';
            echo json_encode($query);
        } else {
            return false;
        }
    }
}

$init = new Controls;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $myPostData = json_decode(file_get_contents("php://input"), true);
//    print_r($_POST);
//    echo $_POST['type'];
    switch ($_POST['type']) {
        case 'insertControl':
            $init->insertControl();
            break;
        case 'GetControlsTeacher':
            $init->GetControlsTeacher();
            break;
        case 'GetGroupsTeacher':
            $init->GetGroupsTeacher();
            break;
        case 'GetControlsSelectTeacher':
            $init->GetControlsSelectTeacher();
            break;
        case 'GetControlsStudent':
            $init->GetControlsStudent();
            break;
//        default:
//            redirect("../index.php");
    }
}
//else {
//    switch ($_GET['q']) {
//        case 'logout':
////            $init->logout();
//            break;
//        default:
//            redirect("../index.php");
//    }
//}


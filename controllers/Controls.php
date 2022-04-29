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

    public function GetControlsToApprove()
    {
        $controls = $this->controlModel->findControlsByIDChair($_SESSION['IDChair']);
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
        $data = $_POST;
        $query = $this->controlModel->insertControl($data);
        if ($query) {
            echo json_encode($query);
        } else {
            return false;
        }
    }

    public function DeleteControl()
    {
        if ($_SESSION['usersType'] != 'head_teacher') return false;
        $data = $_GET;
        $query = $this->controlModel->DeleteControl($data);
        if ($query) {
            echo json_encode($query);
        } else {
            return false;
        }
    }

    public function ControlForGroupsApprove()
    {
        if ($_SESSION['usersType'] != 'head_teacher') return false;
        $data = $_GET;
        $query = $this->controlModel->ControlForGroupsApprove($data);
        if ($query) {
            echo json_encode($query);
        } else {
            return false;
        }
    }

    public function GetCriteria()
    {
        if ($_SESSION['usersType'] != 'head_teacher') return false;
        $data = $_POST;
        $query = $this->controlModel->GetCriteria($data);
        if ($query) {
            echo json_encode($query);
        } else {
            return 'Критерии не указаны';
        }
    }

    public function GetTickets()
    {
        if ($_SESSION['usersType'] != 'head_teacher') return false;
        $data = $_POST;
        $query = $this->controlModel->GetTickets($data);
        if ($query) {
            echo json_encode($query);
        } else {
            return 'Билеты не указаны';
        }
    }
}

$init = new Controls;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_SESSION)) {
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
        case 'GetControlsToApprove':
            $init->GetControlsToApprove();
            break;
        case 'GetCriteria':
            $init->GetCriteria();
            break;
        case 'GetTickets':
            $init->GetTickets();
            break;
//        default:
//            redirect("../index.php");
    }
}
else {
    switch ($_GET['action']) {
        case 'DeleteControl':
            $init->DeleteControl();
            redirect("../controls_approve.php");
            break;
        case 'ControlForGroupsApprove':
            $init->ControlForGroupsApprove();
            redirect("../controls_approve.php");
            break;
//        case 'GetControl':
//            $init->GetControl();
//            redirect("../controls_approve.php");
//            break;
//        default:
//            redirect("../index.php");
    }
}


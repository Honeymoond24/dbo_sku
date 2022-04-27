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

    public function GetControls()
    {
        $controls = $this->controlModel->findControlsByUid($_SESSION['IDUser']);
        var_dump(json_encode($controls));
        if ($controls) {
            var_dump(json_encode($controls));
            echo json_encode($controls);
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
        case 'GetControls':
            $init->GetControls();
            break;
//        default:
//            redirect("../index.php");
    }
} else {
    switch ($_GET['q']) {
        case 'logout':
//            $init->logout();
            break;
        default:
            redirect("../index.php");
    }
}


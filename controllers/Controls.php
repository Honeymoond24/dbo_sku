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
        if ($controls) {
            echo json_encode($controls);
        } else {
            return false;
        }
    }
}

$init = new Controls;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'GetControls':
            $init->GetControls();
            break;
        default:
            redirect("../index.php");
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


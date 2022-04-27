<?php

require_once '../models/Profile.php';
require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class Profiles
{

    private $profileModel;
    private $userModel;

    public function __construct()
    {
        $this->profileModel = new Profile;
        $this->userModel = new User;
    }

    public function ChangeProfile()
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'usersName1' => trim($_POST['usersName1']),
            'usersName2' => trim($_POST['usersName2']),
            'usersName3' => trim($_POST['usersName3']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersISC' => trim($_POST['usersISC']),
            'GroupName' => trim($_POST['GroupName'])
        ];

        if ($this->profileModel->ChangeProfile($data)) {
            $this->createUserSession($data);
            redirect("../profile.php");
        } else {
//            redirect('index.php');
        }
    }

    public function createUserSession($data)
    {
        $_SESSION['usersFullName'] = $data['usersName1'] . ' ' .
            $data['usersName2'] . ' ' . $data['usersName3'];
        $_SESSION['usersEmail'] = $data['usersEmail'];
        if ($_SESSION['usersType'] == 'student') {
            $_SESSION['usersISC'] = $data['usersISC'];
            $_SESSION['GroupName'] = $data['GroupName'];
        } elseif (($_SESSION['usersType'] == 'teacher')) {
            $teacher = $this->userModel->findTeacherByID($_SESSION['IDUser']);
            $_SESSION['IDChair'] = $teacher->IDChair;
            $_SESSION['ChairHead'] = $teacher->ChairHead;
        }
//        redirect("../index.php");
    }
}

$init = new Profiles;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'change':
            $init->ChangeProfile();
            break;
//        default:
//            redirect("../index.php");
    }
}


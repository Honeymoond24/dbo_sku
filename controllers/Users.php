<?php

require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class Users
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function register()
    {
        //Process form

        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'usersName1' => trim($_POST['usersName1']),
            'usersName2' => trim($_POST['usersName2']),
            'usersName3' => trim($_POST['usersName3']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat']),
            'usersType' => trim($_POST['usersType'])
        ];

        //Validate inputs
        if (empty($data['usersName1']) || empty($data['usersName2']) || empty($data['usersName3']) ||
            empty($data['usersEmail']) || empty($data['usersPwd']) || empty($data['pwdRepeat']) ||
            empty($data['usersType'])) {
            flash("register", "Пожалуйста, заполните все поля");
            redirect("../signup.php");
        }

        if (!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)) {
            flash("register", "Неверная электронная почта");
            redirect("../signup.php");
        }

        if (strlen($data['usersPwd']) < 6) {
            flash("register", "Слишком короткий пароль");
            redirect("../signup.php");
        } else if ($data['usersPwd'] !== $data['pwdRepeat']) {
            flash("register", "Введенные пароли не совпадают");
            redirect("../signup.php");
        }

        //User with the same email or password already exists
        if ($this->userModel->findUserByEmail($data['usersEmail'])) {
            flash("register", "Электронная почта уже занята");
            redirect("../signup.php");
        }

        //Passed all validation checks.
        //Now going to hash password
        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        //Register User
        if ($this->userModel->register($data)) {
            redirect("../login.php");
        } else {
            die("Что-то пошло не так");
        }
    }

    public function login()
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'usersEmail' => trim($_POST['usersEmail']),
            'usersPwd' => trim($_POST['usersPwd'])
        ];

        if (empty($data['usersEmail']) || empty($data['usersPwd'])) {
            flash("login", "Пожалуйста, заполните все поля ввода");
            header("location: ../login.php");
            exit();
        }

        //Check for user/email
        if ($this->userModel->findUserByEmail($data['usersEmail'])) {
            //User Found
            $loggedInUser = $this->userModel->login($data['usersEmail'], $data['usersPwd']);
//            die(var_dump($loggedInUser));
            if ($loggedInUser) {
                //Create session
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Пароль неверный");
                redirect("../login.php");
            }
        } else {
            flash("login", "Пользователь с таким электронным адресом не найден");
            redirect("../login.php");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['IDUser'] = $user->IDUser;
        $_SESSION['usersType'] = $user->usersType;
        $_SESSION['usersFullName'] = $user->fullName;
        $_SESSION['usersEmail'] = $user->usersEmail;
        if ($_SESSION['usersType'] == 'student') {
            $student = $this->userModel->findStudentByID($_SESSION['IDUser']);
            $_SESSION['usersISC'] = $student->StudentCode;
            $_SESSION['IDGroup'] = $student->IDGroup;
            $_SESSION['GroupName'] = $student->GroupName;
            $_SESSION['IDSpeciality'] = $student->IDSpeciality;
            $_SESSION['SpecialityName'] = $student->SpecialityName;
        } elseif ($_SESSION['usersType'] == 'teacher' or $_SESSION['usersType'] == 'head_teacher') {
            $teacher = $this->userModel->findTeacherByID($_SESSION['IDUser']);
            $_SESSION['IDChair'] = $teacher->IDChair;
            $_SESSION['ChairFullName'] = $teacher->ChairFullName;
            $_SESSION['ChairShortName'] = $teacher->ChairShortName;
            $_SESSION['FacultyFullName'] = $teacher->FacultyFullName;
            $_SESSION['FacultyShortName'] = $teacher->FacultyShortName;
            $_SESSION['IDFaculty'] = $teacher->IDFaculty;
            $_SESSION['ChairHead'] = $teacher->ChairHead;
        }
        redirect("../index.php");
    }

    public function logout()
    {
        unset($_SESSION['IDUser']);
        unset($_SESSION['usersType']);
        unset($_SESSION['usersFullName']);
        unset($_SESSION['usersEmail']);
        session_destroy();
        redirect("../index.php");
    }
}

$init = new Users;

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        default:
            redirect("../index.php");
    }
} else {
    switch ($_GET['q']) {
        case 'logout':
            $init->logout();
            break;
        default:
            redirect("../index.php");
    }
}

    
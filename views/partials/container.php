<div>
<?php
if ($_SESSION['user']) {
    header('Location:../');
}
$auth = $_SESSION['user'];
$auth_type = $_SESSION['user'];
if ($auth) {
    switch ($auth_type) {
        case 'student':
            break;

        case 'teacher':
            # code...
            break;

        case 'head_dep':
            # code...
            break;

        default:
            // include '../login.php';
            // header('location:/views/login.php');
            break;
    }
} else {
    include 'views/login.php';
}
?>
</div>
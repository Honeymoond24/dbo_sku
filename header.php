<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <title>СКУ</title>
</head>
<body>
<div class="p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <div class="d-flex flex-column flex-md-row align-items-center container">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">Система проведения письменного экзамена в СКУ</a>
        </h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <?php if (!isset($_SESSION['IDUser'])): ?>
                <a class="btn btn-outline-primary" href="login.php" id="sign_in">Войти</a>
                <a class="btn btn-outline-primary" href="signup.php" id="sign_up">Зарегистрироваться</a>
            <?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'student'): ?>
                <a class="p-2 text-dark" href="controls.php">Экзамены</a>
                <a class="p-2 text-dark" href="profile.php">Профиль</a>
                <a class="btn btn-outline-primary" href="./controllers/Users.php?q=logout" id="log_out">Выйти</a>
            <?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'teacher'): ?>
                <a class="p-2 text-dark" href="controls.php">Экзамены</a>
                <a class="p-2 text-dark" href="profile.php">Профиль</a>
                <a class="btn btn-outline-primary" href="./controllers/Users.php?q=logout" id="log_out">Выйти</a>
            <?php endif; ?>
        </nav>
    </div>
</div>
<div class="container">
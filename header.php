<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>СКУ</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<header>
    <div class="py-3 mb-4 border-bottom shadow-sm">
        <div class="container d-flex flex-column flex-md-row align-items-center">
            <a href="/" class="d-flex align-items-center .text-primary text-decoration-none">
                <img class="logo" src="assets/img/logo_ru.png"
                     style="filter: drop-shadow(1px 1px 3px #007bff);" alt="nku.edu.kz">
                <span class="ms-3 fs-5 fw-normal">Система проведения письменного экзамена в СКУ</span>
            </a>
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <?php if (!isset($_SESSION['IDUser'])): ?>
                    <a class="btn btn-outline-primary me-3 py-2" href="login.php" id="sign_in">Войти</a>
                    <a class="btn btn-outline-primary py-2" href="signup.php" id="sign_up">Зарегистрироваться</a>
                <?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'student'): ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="controls.php">Экзамены</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="profile.php">Профиль</a>
                    <a class="btn btn-outline-primary" href="./controllers/Users.php?q=logout" id="log_out">Выйти</a>
                <?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'head_teacher'): ?>
                    <div class="me-3 py-2 flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
                           data-bs-toggle="dropdown" aria-expanded="false">Экзамены</a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="">
                            <li><a class="dropdown-item" href="controls_approve.php">Подтвердить экзамены</a></li>
                            <li><a class="dropdown-item" href="controls.php">Экзамены</a></li>
                        </ul>
                    </div>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="profile.php">Профиль</a>
                    <a class="btn btn-outline-primary" href="./controllers/Users.php?q=logout" id="log_out">Выйти</a>
                <?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'teacher'): ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="controls.php">Экзамены</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="profile.php">Профиль</a>
                    <a class="btn btn-outline-primary" href="./controllers/Users.php?q=logout" id="log_out">Выйти</a>
                <?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'admin'): ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="controls.php">Пользователи</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="controls.php">Экзамены</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="profile.php">Профиль</a>
                    <a class="btn btn-outline-primary" href="./controllers/Users.php?q=logout" id="log_out">Выйти</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
<div class="container">
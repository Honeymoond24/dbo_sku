<?php
// require_once '../models/database.php';

// $query = "INSERT INTO `users` (`id`, `IDUser`, `type`, `login`, `password`) VALUES (NULL, '3', '1', 'login3', 'password3');";
// $query = "SELECT * FROM users";
// $result = query($connect, $query);
// while ($row = mysqli_fetch_assoc($result)) {
//     echo "Name: " . $row["id"];
// }
// if ($_SESSION['user']) {
//     header('Location:../');
// }
?>
<div class="text-center login_block">
    <link href="../assets/css/sign_in.css" rel="stylesheet">
    <form class="form-signin">
        <img class="mb-4" src="https://www.nkzu.kz/images/logo/logo.png" alt="" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Авторизуйтесь</h1>
        <label for="inputEmail" class="sr-only">Электронная почта</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Электронная почта" required autofocus>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
        <button class="btn btn-lg btn-primary btn-block" style="background-color: #05a4ba; border-color: #05a4ba;" type="submit">Войти</button>
        <div class="mt-3">
            <label>
                <a href="registration.php">Зарегистрироваться</a>
            </label>
        </div>
        <p class="mt-2 mb-3 text-muted">&copy; 2022</p>
    </form>
</div>
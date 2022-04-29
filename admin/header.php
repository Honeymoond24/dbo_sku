<?php
include_once 'header.php';


function authenticate()
{
    header('WWW-Authenticate: Basic realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Вы должны ввести корректный логин и пароль для получения доступа к ресурсу \n";
    exit;
}

?>
<?php
if (
    !isset($_SERVER['PHP_AUTH_USER']) ||
    ($_SERVER['PHP_AUTH_PW'] != 'jojodio') && ($_SERVER['PHP_AUTH_USER'] != 'admin')
) {
    authenticate();
} else {
?>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="/admin/users.php">Пользователи</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Дисциплины</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Кафедры</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/logout_admin.php">Выйти</a>
        </li>
    </ul>



<?php
}

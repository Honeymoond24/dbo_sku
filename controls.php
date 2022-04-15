<?php
include_once 'header.php'
?>

<?php if (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'student'): ?>
    <h5>Список назначенных экзаменов</h5>
    <div class="row">
        <ul class="list-group">
            <li class="list-group-item active" aria-current="true">Управление IT-проектами</li>
            <li class="list-group-item">Программная инженерия</li>
            <li class="list-group-item">Инструментальные средства разработки</li>
        </ul>
        <div class="main card col-8 p-2 ml-2">
            <form action=""></form>
            <button type="button" class="btn btn-primary">Добавить экзамен</button>
        </div>
    </div>
<?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'teacher'): ?>
    <div class="row">
        <ul class="list-group">
            <li class="list-group-item">Управление IT-проектами</li>
            <li class="list-group-item">Программная инженерия</li>
            <li class="list-group-item">Инструментальные средства разработки</li>
        </ul>
        <div class="main card col-8 p-2 ml-2">
            <form action=""></form>
            <button type="button" class="btn btn-primary">Добавить экзамен</button>
        </div>
    </div>
<?php endif; ?>

<?php
include_once 'footer.php'
?>
<?php
include_once 'header.php'
?>

<?php if (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'student'): ?>
    <h5>Список назначенных экзаменов</h5>
    <div class="row">
        <ul class="list-group">
            <li class="list-group-item active" aria-current="true">An active item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
        </ul>
    </div>
<?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'teacher'): ?>

<?php endif; ?>

<?php
include_once 'footer.php'
?>
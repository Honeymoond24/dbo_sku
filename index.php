<?php
include_once 'header.php'
?>

    <h1 id="index-text">Добро пожаловать, <?php if (isset($_SESSION['IDUser'])) {
            echo explode(" ", $_SESSION['usersFullName'])[0];
        } else {
            echo 'Гость';
        }
        ?>
    </h1>


<?php
include_once 'footer.php'
?>
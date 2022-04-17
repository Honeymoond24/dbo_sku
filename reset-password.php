<?php
include_once 'header.php';
include_once './helpers/session_helper.php';
?>

<?php flash('reset') ?>

    <form method="post" action="./controllers/ResetPasswords.php" class="col-md-6 mx-auto">
        <h1 class="h1">Восстановить пароль</h1>
        <input type="hidden" name="type" value="send"/>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Электронная почта</label>
            <input type="email" class="form-control" name="usersEmail" id="exampleInputEmail1"
                   aria-describedby="emailHelp" placeholder="Электронная почта">
        </div>
        <div class="mb-3">
            <button type="submit" name="submit" class="btn btn-primary">Получить письмо</button>
        </div>
    </form>

<?php
include_once 'footer.php';
?>
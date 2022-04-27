<?php
include_once 'header.php';
include_once './helpers/session_helper.php';
?>

<?php flash('login') ?>
    <form method="post" action="./controllers/Users.php" class="col-md-6 mx-auto">
        <input type="hidden" name="type" value="login">
        <h1 class="h1">Авторизация</h1>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Электронная почта</label>
            <input type="email" class="form-control" name="usersEmail" id="exampleInputEmail1"
                   aria-describedby="emailHelp" placeholder="Электронная почта">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" name="usersPwd" id="exampleInputPassword1"
                   placeholder="Пароль">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>
        <div class="mb-3">
            <label for="reset-password" class="form-label">
                <a href="./reset-password.php" id="reset-password">Забыли пароль?</a>
            </label>
        </div>
    </form>
<?php
include_once 'footer.php';
?>
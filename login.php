<?php
include_once 'header.php';
include_once './helpers/session_helper.php';
?>

<?php flash('login') ?>
    <form method="post" action="./controllers/Users.php" class="col-md-6 ml-auto mr-auto">
        <input type="hidden" name="type" value="login">
        <h1 class="h1">Авторизация</h1>
        <div class="form-group">
            <label for="exampleInputEmail1">Электронная почта</label>
            <input type="email" class="form-control" name="usersEmail" id="exampleInputEmail1"
                   aria-describedby="emailHelp" placeholder="Электронная почта">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Пароль</label>
            <input type="password" class="form-control" name="usersPwd" id="exampleInputPassword1"
                   placeholder="Пароль">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>
        <div class="form-group">
            <label for="reset-password">
                <a href="./reset-password.php" id="reset-password">Забыли пароль?</a>
            </label>
        </div>
    </form>
<?php
include_once 'footer.php'
?>
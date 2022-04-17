<?php
include_once 'header.php';
include_once './helpers/session_helper.php';
?>


<?php flash('register') ?>
    <form method="post" action="./controllers/Users.php" class="col-md-6 mx-auto">
        <input type="hidden" name="type" value="register">
        <h1 class="h1">Регистрация</h1>
        <div class="mb-3">
            <label for="snp1" class="form-label">Фамилия</label>
            <input type="text" class="form-control" name="usersName1" id="snp1" placeholder="Фамилия">
        </div>
        <div class="mb-3">
            <label for="snp2" class="form-label">Имя</label>
            <input type="text" class="form-control" name="usersName2" id="snp2" placeholder="Имя">
        </div>
        <div class="mb-3">
            <label for="snp3" class="form-label">Отчество</label>
            <input type="text" class="form-control" name="usersName3" id="snp3" placeholder="Отчество">
        </div>
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
            <label for="exampleInputPassword2" class="form-label">Подтверждение пароля</label>
            <input type="password" class="form-control" name="pwdRepeat" id="exampleInputPassword2"
                   placeholder="Пароль">
        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="usersType" id="inlineRadio1"
                       value="student">
                <label class="form-check-label" for="inlineRadio1">Студент</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="usersType" id="inlineRadio2"
                       value="teacher">
                <label class="form-check-label" for="inlineRadio2">Преподаватель</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="usersType" id="inlineRadio3"
                       value="head_teacher">
                <label class="form-check-label" for="inlineRadio3">Заведующий кафедрой</label>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </div>
    </form>
<?php
include_once 'footer.php';
?>
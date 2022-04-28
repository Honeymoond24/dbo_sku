<?php
include_once 'header.php';
include_once 'helpers/session_helper.php';
?>

<?php if (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'student'): ?>
    <?php
    $action = isset($_GET['action']) ? $_GET['action'] : 'null';
    if ($action != 'edit'): ?>
        <div class="row gutters-sm col-md-12 card mb-3 card-body">
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Полное имя</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['usersFullName'] ?>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Электронный адрес</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['usersEmail'] ?>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">ИКС</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['usersISC'] ?>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Группа</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['GroupName'] ?>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <a class="btn btn-outline-primary"
                       href="?action=edit">Изменить</a>
                </div>
            </div>
        </div>
    <?php elseif ($action == 'edit'): ?>
        <form method="post" action="./controllers/Profiles.php">
            <input type="hidden" name="type" value="change">
            <div class="row gutters-sm col-md-12 card mb-3 card-body">
                <div class="row pb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0"><label class="py-2" for="usersName1">Полное имя</label></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <div class="input-group">
                            <input type="text" id="usersName1" name="usersName1" class="form-control"
                                   placeholder="Фамилия" value="<?= explode(" ", $_SESSION['usersFullName'])[0] ?>">
                            <input type="text" id="usersName2" name="usersName2"
                                   class="form-control" placeholder="Имя"
                                   value="<?= explode(" ", $_SESSION['usersFullName'])[1] ?>">
                            <input type="text" id="usersName3" name="usersName3"
                                   class="form-control" placeholder="Отчество"
                                   value="<?= explode(" ", $_SESSION['usersFullName'])[2] ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row pb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0"><label class="py-2" for="usersEmail">Электронный адрес</label></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="email" id="usersEmail" name="usersEmail"
                               class="form-control" placeholder="Электронный адрес"
                               value="<?= $_SESSION['usersEmail'] ?>">
                    </div>
                </div>
                <hr>
                <div class="row pb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0"><label class="py-2" for="usersISC">ИКС</label></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" id="usersISC" name="usersISC"
                               class="form-control" placeholder="ИКС" value="<?= $_SESSION['usersISC'] ?>">
                    </div>
                </div>
                <hr>
                <div class="row pb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0"><label class="py-2" for="GroupName">Группа</label></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" id="GroupName" name="GroupName"
                               class="form-control" placeholder="Группа" value="<?= $_SESSION['GroupName'] ?>">
                    </div>
                </div>
                <hr>
                <div class="row pb-3">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-outline-primary">Подтвердить</button>
                        <a class="btn btn-outline-secondary" href="profile.php">Отмена</a>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
<?php elseif (isset($_SESSION['IDUser']) and
    ($_SESSION['usersType'] == 'teacher' or $_SESSION['usersType'] == 'head_teacher')): ?>
    <?php
    $action = isset($_GET['action']) ? $_GET['action'] : 'null';
    if ($action != 'edit'): ?>
        <div class="row gutters-sm col-md-12 card mb-3 card-body">
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Полное имя</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['usersFullName'] ?>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Электронный адрес</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['usersEmail'] ?>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Кафедра</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['ChairFullName'] ?>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Факультет</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['FacultyFullName'] ?>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Завкафедрой</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $_SESSION['ChairHead'] ? 'Да' : 'Нет' ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <?php redirect("../index.php"); ?>
<?php endif; ?>


<?php
include_once 'footer.php';
?>
<?php
include_once 'header.php';
include_once 'helpers/session_helper.php';
?>
<?php
if (!isset($_SESSION['usersType'])) redirect('403.php');
if ($_SESSION['usersType'] != 'head_teacher') : redirect('403.php');
else: ?>
    <?php if (isset($_GET['action'])): ?>
        <div class="row gutters-sm col-md-12 card mb-3 card-body" id="controls">
            <div class="row pb-3">
                <div class="col-sm-12">
                    <h6 class="mb-0">Список экзаменов кафедры <?= $_SESSION['ChairFullName'] ?></h6>
                </div>
            </div>
            <hr>
            <div class="row pb-3">
                <div class="col-sm-6">
                    <h6 class="mb-0">Дисциплина</h6>
                </div>
                <div class="col-sm-2">
                    <h6 class="mb-0">Утверждено</h6>
                </div>
                <div class="col-sm-4">
                    <h6 class="mb-0">Действия</h6>
                </div>
            </div>
            <hr>
        </div>
        <div class="row gutters-sm col-md-12 card mb-3 card-body" id="controlInfo">
        </div>
        <div class="row gutters-sm col-md-12 card mb-3 card-body" id="controlTickets">
            <div class="row pb-3">
                <div class="col-sm-4">
                    <h6 class="mb-0">Билеты</h6>
                </div>
            </div>
            <hr>
        </div>
        <div class="row gutters-sm col-md-12 card mb-3 card-body" id="controlCriteria">
            <div class="row pb-3">
                <div class="col-sm-10">
                    <h6 class="mb-0">Критерии</h6>
                </div>
                <div class="col-sm-2">
                    <h6 class="mb-0">Баллы</h6>
                </div>
            </div>
            <hr>
        </div>
        <script>
            // Список экзаменов для утверждения
            let controls = [];
            let data = [];

            function insertControlsList(url, data, div_class) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: data,
                    response: 'text',
                    success: function (response) {
                        controls = response;
                        $(div_class).html(response);
                        console.log('ajax', response);
                        response.forEach(el => {
                            if (el['IDControlsForGroups'] === <?= $_GET['IDControlsForGroups']?>) {
                                data = el;
                                document.getElementById('controls').innerHTML += `
                                <div class="row pb-3">
                                    <div class="col-sm-6 text-secondary">
                                        <a href="controls_approve.php?action=GetControl&IDControlsForGroups=${el['IDControlsForGroups']}">
                                        ${el['DisciplineName']}</a>
                                    </div>
                                    <div class="col-sm-2 text-secondary">
                                        ${el['Approve'] === 1 ? 'Да' : 'Нет'}
                                    </div>
                                    <div class="col-sm-2 text-secondary">
                                        <a href="controllers/Controls.php?action=ControlForGroupsApprove&IDControlsForGroups=${el['IDControlsForGroups']}">
                                        <button class="btn btn-outline-primary">Утвердить</button></a>
                                    </div>
                                    <div class="col-sm-2 text-secondary">
                                        <a href="controllers/Controls.php?action=DeleteControl&IDControlsForGroups=${el['IDControlsForGroups']}">
                                        <button class="btn btn-outline-primary">Удалить</button></a>
                                    </div>
                                </div>
                                <hr>
                            `;
                            }
                        })
                        document.getElementById('controlInfo').innerHTML += `
                        <div class="row pb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Дисциплина</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                ${data['DisciplineName']}
                            </div>
                        </div>
                        <hr>
                        <div class="row pb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Группа</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                ${data['GroupName']}
                            </div>
                        </div>
                        <hr>
                        <div class="row pb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Преподаватель</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                ${data['TeacherSurname']} ${data['TeacherFirstName']} ${data['TeacherPatronymic']}
                            </div>
                        </div>
                        <hr>
                        <div class="row pb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Дата и время</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                ${data['ControlDate']}
                            </div>
                        </div>
                        <hr>
                        `;
                    }
                })
            }

            insertControlsList('controllers/Controls.php', {'type': 'GetControlsToApprove'}, 'list-group-item');
            let criteria = [];

            function GetCriteria(url, data, div_class) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: data,
                    response: 'text',
                    success: function (response) {
                        criteria = response;
                        $(div_class).html(response);
                        console.log('ajax', response);
                        response.forEach(el => {
                            if (el['IDControlsForGroups'] === <?= $_GET['IDControlsForGroups']?>) {
                                data = el;
                                document.getElementById('controlCriteria').innerHTML += `
                                <div class="row pb-3">
                                    <div class="col-sm-10 text-secondary">
                                        ${el['criteria']}
                                    </div>
                                    <div class="col-sm-2 text-secondary">
                                        ${el['maxScore']}gi
                                    </div>
                                </div>
                                <hr>
                            `;
                            }
                        })
                    }
                })
            }

            GetCriteria('controllers/Controls.php',
                {'type': 'GetCriteria', 'IDControlsForGroups': '<?= $_GET['IDControlsForGroups']?>'},
                'list-group-item');

            function GetTickets(url, data, div_class) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: data,
                    response: 'text',
                    success: function (response) {
                        $(div_class).html(response);
                        console.log('ajax', response);
                        response.forEach(el => {
                            document.getElementById('controlTickets').innerHTML += `
                            <div class="row pb-3">
                                <div class="col-sm-12 text-secondary">
                                    ${el['ticketText']}
                                </div>
                            </div>
                            <hr>
                            `;
                        })
                    }
                })
            }

            GetTickets('controllers/Controls.php',
                {'type': 'GetTickets', 'IDControlsForGroups': '<?= $_GET['IDControlsForGroups']?>'},
                'list-group-item');
        </script>
    <?php else: ?>
        <p>Ответ студента</p>
        <div class="input-group">
            <textarea class="form-control" aria-label="With textarea"></textarea>
        </div>
        <p>Оценка работы</p>
        <div class="send_rating">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Балл" aria-label="Балл" aria-describedby="basic-addon1">
            </div>
            <button type="button" class="btn btn-primary">Оценить</button>
        </div>
        <script>
            // Список экзаменов для утверждения
            let controls = [];

            function insertControlsList(url, data, div_class) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: data,
                    response: 'text',
                    success: function (response) {
                        controls = response;
                        $(div_class).html(response);
                        console.log('ajax', response);
                        response.forEach(el => {
                            document.getElementById('controls').innerHTML += `
                            <div class="row pb-3">
                                <div class="col-sm-6 text-secondary">
                                    <a href="controls_approve.php?action=GetControl&IDControlsForGroups=${el['IDControlsForGroups']}">
                                    ${el['DisciplineName']}</a>
                                </div>
                                <div class="col-sm-2 text-secondary">
                                    ${el['Approve'] === 1 ? 'Да' : 'Нет'}
                                </div>
                                <div class="col-sm-2 text-secondary">
                                    <a href="controllers/Controls.php?action=ControlForGroupsApprove&IDControlsForGroups=${el['IDControlsForGroups']}">
                                    <button class="btn btn-outline-primary">Утвердить</button></a>
                                </div>
                                <div class="col-sm-2 text-secondary">
                                    <a href="controllers/Controls.php?action=DeleteControl&IDControlsForGroups=${el['IDControlsForGroups']}">
                                    <button class="btn btn-outline-primary">Удалить</button></a>
                                </div>
                            </div>
                            <hr>
                        `;
                        })
                    }
                })
            }

            insertControlsList('controllers/Controls.php', {'type': 'GetControlsToApprove'}, 'list-group-item');
        </script>
    <?php endif; ?>
<?php endif; ?>
<?php
include_once 'footer.php';
?>
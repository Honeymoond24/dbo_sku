<?php
include_once 'header.php';
include_once './helpers/session_helper.php';
?>

<?php if (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'student') : ?>
    <h5>Список назначенных экзаменов</h5>
    <div class="row gutters-sm col-md-12 card mb-3 card-body" id="controls">
        <div class="row pb-3">
            <div class="col-sm-12">
                <h6 class="mb-0">Список экзаменов кафедры <?= $_SESSION['ChairFullName'] ?></h6>
            </div>
        </div>
        <hr>
        <div class="row pb-3">
            <div class="col-sm-8">
                <h6 class="mb-0">Дисциплина</h6>
            </div>
            <div class="col-sm-4">
                <h6 class="mb-0">Утверждено</h6>
            </div>
        </div>
        <hr>
    </div>
    <div class="row gutters-sm col-md-12 card mb-3 card-body" id="controlInfo">
    </div>
    <div class="row gutters-sm col-md-12 card mb-3 card-body" id="controlTickets">
        <div class="row pb-3">
            <div class="col-sm-4">
                <h6 class="mb-0">Билет</h6>
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
    <div class="row main card col-md-12 p-2 ml-2" id="controls1">
        <div class="form-group mb-2">
            <label class="form-label" for="controlAnswer">Ответ на экзамен</label>
            <textarea class="form-control" id="controlAnswer" aria-label="Ответ на экзамен"></textarea>
        </div>
        <button type="button" class="btn btn-primary">Отправить</button>
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
                                    <div class="col-sm-8 text-secondary">
                                        <a href="controls_approve.php?action=GetControl&IDControlsForGroups=${el['IDControlsForGroups']}">
                                        ${el['DisciplineName']}</a>
                                    </div>
                                    <div class="col-sm-4 text-secondary">
                                        ${el['Approve'] === 1 ? 'Да' : 'Нет'}
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
                        //if (el['IDControlsForGroups'] === <?//= $_GET['IDControlsForGroups']?>//) {
                        data = el;
                        document.getElementById('controlCriteria').innerHTML += `
                                <div class="row pb-3">
                                    <div class="col-sm-10 text-secondary">
                                        ${el['criteria']}
                                    </div>
                                    <div class="col-sm-2 text-secondary">
                                        ${el['maxScore']}
                                    </div>
                                </div>
                                <hr>
                            `;
                        // }
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
                    document.getElementById('controlTickets').innerHTML += `
                            <div class="row pb-3">
                                <div class="col-sm-12 text-secondary">
                                    ${response[Math.floor(Math.random() * response.length)]['ticketText']}
                                </div>
                            </div>
                            <hr>
                            `;
                }
            })
        }

        GetTickets('controllers/Controls.php',
            {'type': 'GetTickets', 'IDControlsForGroups': '<?= $_GET['IDControlsForGroups']?>'},
            'list-group-item');
    </script>
<?php endif; ?>
<?php
include_once 'footer.php';
?>
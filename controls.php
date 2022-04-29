<?php
include_once 'header.php';
include_once './helpers/session_helper.php';
?>

<?php if (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'student') : ?>
    <h5>Список назначенных экзаменов</h5>
    <div class="row">
        <ul class="list-group p0 col-4" id="controls"></ul>
        <div class="main card col-8 p-2 ml-2">
            <form action=""></form>
            <button type="button" class="btn btn-primary">Пройти экзамен</button>
        </div>
    </div>
    <script>
        let data = [];

        function insertHTML(url, data, div_class) {
            $.ajax({
                // headers: {
                //     'Content-Type': 'application/json'
                // },
                type: 'POST',
                url: url,
                dataType: 'json',
                data: data,
                response: 'text',
                success: function (_data) {
                    data = _data;
                    $(div_class).html(_data);
                    console.log('ajax', _data);
                    data.forEach(el => {
                        document.getElementById('controls').innerHTML += `<li class="list-group-item">${el['DisciplineName']}</li>`;
                    })
                }
            })
        }

        insertHTML('controllers/Controls.php', {'type': 'GetControlsStudent'}, 'list-group-item');
    </script>
<?php elseif (isset($_SESSION['IDUser']) and
    ($_SESSION['usersType'] == 'teacher' or $_SESSION['usersType'] == 'head_teacher')): ?>
    <h5>Список экзаменов</h5>
    <div class="row">
        <ul class="list-group p0 col-4" id="controls"></ul>
        <div class="main card col-8 p-2 ml-2">
            <form id="teach_form" action="controllers/Teachers.php" method="POST">
                <input type="hidden" name="usersType" value="teacher">
                <div class="disp form-group">
                    <label class="form-label" for="name_disp">Название дисциплины</label>
                    <select class="form-select" aria-label="Default select example"
                            id="name_disp" name="name_disp" required>
                    </select>
                </div>
                <div class="group form-group">
                    <label class="form-label" for="group_id">Группа</label>
                    <select class="form-select" aria-label="Default select example"
                            id="group_id" name="group_id" required>
                    </select>
                </div>
                <div class="group form-group col-sm-6">
                    <label class="form-label" for="datetimePicker">Дата и время экзамена</label>
                    <input class="form-control active" id="datetimePicker" type="text"
                           placeholder="Выберите дату экзамена" data-id="datetime" readonly="readonly" required>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                <script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>
                <script>
                    flatpickr("#datetimePicker",
                        {
                            enableTime: true,
                            dateFormat: "Y-m-d H:i:00",
                            "locale": "ru",
                            minDate: "today",
                        });
                </script>
                <div class="tickets row">
                    <label for="inputTickets" class="col-sm-9 col-form-label">Билеты</label>
                    <div id="tickets">
                        <input class="form-control my-2" type="text" value="" placeholder="Билет">
                    </div>
                    <div class="col-sm-6 mt-2">
                        <button type="button" id="add_ticket" class="form-control btn btn-primary"
                                id="inputTickets">Добавить билет
                        </button>
                    </div>
                </div>
                <div class="indicator row">
                    <label for="inputIndicator" class="col-sm-9 col-form-label">Критерии</label>
                    <div id="indicators">
                        <div class="input-group">
                            <input class="form-control my-2" id="indicator" type="text" value="" placeholder="Критерий">
                            <input class="form-control my-2" id="indicator_score" type="text" value=""
                                   placeholder="Баллы">
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <button type="button" id="add_indicator" class="form-control btn btn-primary mt-2"
                                id="inputIndicator">Добавить критерий
                        </button>
                    </div>
                </div>
                <button type="button" id="save" class="btn btn-primary my-3">Сохранить</button>
            </form>
        </div>
    </div>
    <script>
        // Список экзаменов
        let data = [];

        function insertControlsList(url, data, div_class) {
            $.ajax({
                // headers: {
                //     'Content-Type': 'application/json'
                // },
                type: 'POST',
                url: url,
                dataType: 'json',
                data: data,
                response: 'text',
                success: function (_data) {
                    data = _data;
                    $(div_class).html(_data);
                    console.log('ajax', _data);
                    data.forEach(el => {
                        document.getElementById('controls').innerHTML +=
                            `<li class="list-group-item">${el['DisciplineName']}</li>`;
                        // document.getElementById('name_disp').innerHTML +=
                        //     `<option value="${el['IDDiscipline']}">${el['DisciplineName']}</option>`;
                    })
                }
            })
        }

        insertControlsList('controllers/Controls.php', {'type': 'GetControlsTeacher'}, 'list-group-item');
    </script>
    <script>
        // Список дисциплин кафедры
        let data_select = [];

        function insertControlsSelect(url, data_select, div_class) {
            $.ajax({
                // headers: {
                //     'Content-Type': 'application/json'
                // },
                type: 'POST',
                url: url,
                dataType: 'json',
                data: data_select,
                response: 'text',
                success: function (data) {
                    data_select = data;
                    $(div_class).html(data_select);
                    console.log('ajax', data_select);
                    data_select.forEach(el => {
                        document.getElementById('name_disp').innerHTML +=
                            `<option value="${el['IDDiscipline']}">${el['DisciplineName']}</option>`;
                    })
                }
            })
        }

        insertControlsSelect('controllers/Controls.php', {'type': 'GetControlsSelectTeacher'}, 'list-group-item');
    </script>
    <script>
        // Список групп кафедры
        let data_groups = [];

        function insertControlsSelect(url, data_groups, div_class) {
            $.ajax({
                // headers: {
                //     'Content-Type': 'application/json'
                // },
                type: 'POST',
                url: url,
                dataType: 'json',
                data: data_groups,
                response: 'text',
                success: function (data) {
                    data_groups = data;
                    $(div_class).html(data_groups);
                    console.log('ajax', data_groups);
                    data_groups.forEach(el => {
                        document.getElementById('group_id').innerHTML +=
                            `<option value="${el['IDGroup']}">${el['GroupName']}</option>`;
                    })
                }
            })
        }

        insertControlsSelect('controllers/Controls.php', {'type': 'GetGroupsTeacher'}, 'list-group-item');
    </script>
    <script>
        let addticket = () => {
            $('#tickets').append(`
                <input class="form-control my-2"  type="text" value="" placeholder="Билет">
            `)
        }
        $(document).delegate('#add_ticket', 'click', addticket)

        let addIndicator = () => {
            $('#indicators').append(`
                <div class="input-group">
                    <input class="form-control my-2" id="indicator" type="text" value="" placeholder="Критерий">
                    <input class="form-control my-2" id="indicator_score"  type="text" value="" placeholder="Баллы">
                </div>
            `)
        }
        $(document).delegate('#add_indicator', 'click', addIndicator)
        let sendForm = () => {
            let formData = {
                type: 'insertControl',
                IDUser: '<?= $_SESSION['IDUser']?>',
                datetimePicker: $('#datetimePicker').val(),
                group: $('#group_id').val(),
                dsip: $('#name_disp').val(),
                tickets: [],
                indicators: [],
                indicators_score: []
            };
            let tickets_form = $('#tickets>input')
            $(tickets_form).each((index, element) => {
                formData.tickets.push($(element).val())
            })
            let indicators_form = $('#indicators>div>input[id=indicator]')
            $(indicators_form).each((index, element) => {
                formData.indicators.push($(element).val())
            })
            let indicators_score_form = $('#indicators>div>input[id=indicator_score]')
            $(indicators_score_form).each((index, element) => {
                formData.indicators_score.push($(element).val())
            })
            console.log(formData)
            $.ajax({
                // url: "test.php",
                url: "controllers/Controls.php",
                method: "POST",
                dataType: 'json',
                data: formData,
                success: (response) => {
                    console.log(response);
                }
            })
        }
        $(document).delegate('#save', 'click', sendForm)
    </script>
<?php endif; ?>
<?php
include_once 'footer.php';
?>
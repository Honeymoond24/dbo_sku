<?php
include_once 'header.php';
// require_once './controllers/Controls.php';
?>

<?php if (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'student') : ?>
    <h5>Список назначенных экзаменов</h5>
    <div class="row">
        <ul class="list-group col-4" id="controls">


            <!--            <li class="list-group-item active" aria-current="true">Управление IT-проектами</li>-->
            <!--            <li class="list-group-item">Программная инженерия</li>-->
            <!--            <li class="list-group-item">Инструментальные средства разработки</li>-->
        </ul>
        <div class="main card col-8 p-2 ml-2">
            <form action=""></form>
            <button type="button" class="btn btn-primary">Пройти экзамен</button>
        </div>
    </div>
    <script>
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
                success: function (data) {
                    $(div_class).html(data);
                    console.log('ajax', data);
                }
            })
        }

        insertHTML('controllers/Controls.php', {'type': 'GetControls'}, 'list-group-item');
        document.getElementById('controls').innerHTML = `<li class="list-group-item">${data}</li>`;

        // function insertHTML(url, data, div_class) {
        //     $.ajax({
        //         type: 'POST',
        //         url: url,
        //         data: data,
        //         response: 'text',
        //         success: function (data) {
        //             $(div_class).html(data);
        //             $(div_class).hide().fadeIn(700);
        //         }
        //     })
        // }

        // function sendRequest(method, url, body = null) {
        //     const headers = {
        //         'Content-Type': 'application/json'
        //     }
        //
        //     return fetch(url, {
        //         method: method,
        //         headers: headers,
        //         body: JSON.stringify(body)
        //     })
        // }

        // function sendRequestWithImage(url, body) {
        //     return fetch(url, {
        //         method: 'POST',
        //         body: body
        //     })
        // }
    </script>
<?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'teacher'): ?>
    <div class="row">
        <ul class="list-group col-4">
            
        </ul>
        <div class="main card col-8 p-2 ml-2">
            <!-- <div id="root_teacher"></div> -->
            <form id="teach_form" action="test.php" method="POST">
                <div class="disp form-group">
                    <label class="form-label" for="name_disp">Название дисциплины</label>
                    <input class="form-control" id="name_disp" name="name_disp" type="text">
                </div>
                <div class="group form-group">
                    <label class="form-label" for="group_id">Группа</label>
                    <input class="form-control" id="group_id" name="group_id" type="text">
                </div>
                <div class="tickets row">
                    <label for="inputTickets" class="col-sm-10 col-form-label">Билеты</label>
                    <div class="col-sm-2 mt-1">
                        <input type="button" id="add_ticket" class="form-control btn btn-primary" value="Добавить" id="inputTickets" />
                    </div>
                    <div id="tickets">

                    </div>
                </div>
                <div class="indicator row">
                    <label for="inputIndicator" class="col-sm-10 col-form-label">Критерии</label>
                    <div class="col-sm-2 mt-1">
                        <input type="button" id="add_indicator" class="form-control btn btn-primary" value="Добавить" id="inputIndicator" />
                    </div>
                    <div id="indicators">

                    </div>
                </div>
                <input id="save" class="btn btn-primary" value="Сохранить" />
            </form>
            <!-- <button type="button" class="btn btn-primary">Добавить экзамен</button> -->
        </div>
    </div>
<?php elseif (isset($_SESSION['IDUser']) and $_SESSION['usersType'] == 'head_teacher') : ?>
    <div class="row">
        <ul class="list-group col-4">
            <li class="list-group-item">Управление IT-проектами</li>
            <li class="list-group-item">Программная инженерия</li>
            <li class="list-group-item">Инструментальные средства разработки</li>
        </ul>
        <div class="main card col-8 p-2 ml-2">
            <form action=""></form>
            <button type="button" class="btn btn-primary">Подтвердить экзамен</button>
        </div>
    </div>
<?php endif; ?>

<?php
include_once 'footer.php';
?>